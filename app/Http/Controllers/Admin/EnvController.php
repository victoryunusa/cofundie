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
       

       
         $APP_NAME = Str::slug($request->APP_NAME);
$txt ="APP_NAME=".$APP_NAME."
APP_ENV=local
APP_KEY=base64:tpVfUhOZ9nzBiIBgGtSbZq7VVAYijPC62p1HlgxFaO4=
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

FILESYSTEM_DISK=".$request->FILESYSTEM_DISK."

LOG_CHANNEL=stack
LOG_LEVEL=debug
DEFAULT_LANG=".$request->DEFAULT_LANG."
TIMEZONE=".$request->TIMEZONE."
KYC_VERIFICATION=".$request->KYC_VERIFICATION."

AWS_ACCESS_KEY_ID=".$request->AWS_ACCESS_KEY_ID."
AWS_SECRET_ACCESS_KEY=".$request->AWS_SECRET_ACCESS_KEY."
AWS_DEFAULT_REGION=".$request->AWS_DEFAULT_REGION."
AWS_BUCKET=".$request->AWS_BUCKET."

WAS_ACCESS_KEY_ID=".$request->WAS_ACCESS_KEY_ID."
WAS_SECRET_ACCESS_KEY=".$request->WAS_SECRET_ACCESS_KEY."
WAS_DEFAULT_REGION=".$request->WAS_DEFAULT_REGION."
WAS_BUCKET=".$request->WAS_BUCKET."
WAS_ENDPOINT=".$request->WAS_ENDPOINT."

";

  File::put(base_path('.env'),$txt);
       return response()->json("System Updated");
    }
}

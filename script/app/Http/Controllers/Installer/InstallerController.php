<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Http;

class InstallerController extends Controller
{
    public function index()
    {
        try {

            $pdo = DB::connection()->getPdo();

            if($pdo)
            {
                return redirect('/404');
            } else {
                return view('installer.index');
            }

        } catch (\Exception $e) {
            return view('installer.index');
        }
    }

    public function configuration()
    {
        try {

            $pdo = DB::connection()->getPdo();

            if($pdo)
            {
                return redirect('/404');
            } else {
                return view('installer.configuration');
            }

        } catch (\Exception $e) {
            return view('installer.configuration');
        }
    }

    public function complete()
    {
    	return view('installer.complete');
    }


     public function send(Request $request)
    {

        $APP_NAME = Str::slug($request->app_name);
        $txt ="APP_NAME=".$APP_NAME."
APP_ENV=local
APP_KEY=base64:4bJgqF84pmtw3yxCywF+3hT2x9atO28O0RFq1ZTjkA8=
APP_DEBUG=true
APP_URL=".$request->app_url."\n

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug\n

DB_CONNECTION=mysql
DB_HOST=".$request->db_host."
DB_PORT=3306
DB_DATABASE=".$request->db_name."
DB_USERNAME=".$request->db_user."
DB_PASSWORD=".$request->db_pass."\n

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120\n

MEMCACHED_HOST=127.0.0.1\n

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379\n

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=".$APP_NAME."\n

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false\n

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1\n

VITE_PUSHER_APP_KEY=
VITE_PUSHER_HOST=
VITE_PUSHER_PORT=
VITE_PUSHER_SCHEME=
VITE_PUSHER_APP_CLUSTER=\n

EPISODE_UPLOAD_DISK=local";
       File::put(base_path('.env'),$txt);
       return "Sending Credentials";
    }


    public function check()
    {
        try {
          DB::connection()->getPdo();
            if(DB::connection()->getDatabaseName()){
                return "Database Installing";
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function verify_check(Request $request)
    {
        $url= url('/');
        $response = Http::post('https://helloapi.lpress.xyz/api/verify', [
                'p' => $request->key,
                't' => 'i',
                'u' => $url,
                'i' => '27861902',

        ]);
        $data= $response->json();
        if ($response->ok()) {
            return redirect()->route('install.configuration');
        }
        else{
            $request->session()->flash('error_msg', $data['error']);
            return back();
        }

    }

    public function verify()
    {
        return view('installer.verify');
    }

    public function migrate()
    {
        ini_set('max_execution_time', '0');
        \Artisan::call('migrate:fresh');
        return "Demo Importing";
    }

    public function seed()
    {
        ini_set('max_execution_time', '0');
        \Artisan::call('db:seed');
        return "Congratulations! Your site is ready";
    }
}

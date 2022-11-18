<?php

namespace App\Http\Controllers\Frontend;

use App\Rules\Phone;
use App\Models\Option;
use App\Models\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendContactMailToAdmin;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $headingData = Option::whereLang(current_locale())
            ->whereIn('key', [
                'heading.contacts',
            ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key] = $heading->value;
        }
        $data = [
            'headings' => $headings,
        ];

        return view('frontend.contact.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $mail = ContactMail::create($validated);

        if (config('system.queue.mail')){
            Mail::to(env('MAIL_TO'))->queue(new SendContactMailToAdmin($mail));
        }else{
            Mail::to(env('MAIL_TO'))->send(new SendContactMailToAdmin($mail));
        }

        return response()->json([
            'message' => __('Contact Mail Successfully Sent')
        ]);
    }
}

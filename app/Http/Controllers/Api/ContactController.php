<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function message(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'sender' => 'required|email',
                'subject' => 'required|string',
                'message' => 'required|string',
            ],
            [
                'sender.required' => 'Email obbligatoria',
                'sender.email' => 'Email non valida',
                'subject.required' => 'Oggetto email obbligatorio',
                'message.required' => 'Il messaggio della mail è obbligatorio',
            ]
        );

        if ($validator->fails()) {
            $errors = [];

            foreach ($validator->errors()->messages() as $field => $messages) {
                $errors[$field] = $messages[0];
            }
            return response()->json(compact('errors'), 422);
        }


        $mail = new ContactMessageMail(
            subject: $data['subject'],
            sender: $data['sender'],
            content: $data['message'],
        );


        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);
        return response(null);
    }
}

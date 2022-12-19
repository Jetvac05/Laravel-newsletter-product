<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Services\Newsletter;
use MailchimpMarketing\ApiClient;



class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {

        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
    
        } catch (\Exception $e)
         {
        throw  ValidationException::withMessages([
                'email' => 'this email could not be added to our newsletter list.'
            ]);
        }
    
        return redirect('/')
            ->with('succes', 'You are now signed up for our newsletter!');
    }
}

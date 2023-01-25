<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //contact
    public function contact(){
        return view('user.contact.contact');
    }

    //sendToAdmin
    public function sendToAdmin(ContactRequest $request){
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        toastr()->success('Thank You..Your message Recieve Successfully..');
        return back();
    }
}

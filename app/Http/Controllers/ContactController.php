<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    //admin
    //message
    public function message(){
        $messages = Contact::orderBy('created_at','desc')->paginate(10);
        return view('admin.contact.message',compact('messages'));
    }

    //deleteMessage
    public function deleteMessage($id){
        $message = Contact::where('id',$id)->first();
        $message->delete();
        toastr()->success('Message Deleted Success..');
        return back();
    }

    //contactDetails
    public function contactDetails($id){
        $message = Contact::where('id',$id)->first();

        return view('admin.contact.detail',compact('message'));
    }

    //deleteAllmessages
    public function deleteAllmessages(){
        $messages = Contact::select();
        $messages->delete();
        toastr()->success('Messages Inbox Clean Success..');
        return redirect()->route('admin#contactMessage');
    }












    //user
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

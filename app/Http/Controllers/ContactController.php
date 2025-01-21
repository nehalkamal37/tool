<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'msg' => 'required',
        ]);
        $data= Contact::create($request->all());

        return redirect()->route('welcome')->with('success','Message Sent Successfully');
    }

    public function all()
    {
        $contacts = Contact::all();
        return view('dashboard.contacts.index',compact('contacts'));
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('contacts')->with('success','Message Deleted Successfully');
    }
}

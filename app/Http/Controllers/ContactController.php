<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
    	return view('contact.index');
    }

    public function store()
    {
    	$this->validate(request(),[
    		'name' => 'required',
    		'email' => 'required|email',
    		// 'website' => 'url',
    		'message' => 'required'
    	]);
    	$data = request(['name', 'email', 'website', 'message']);
    	$data['user_id'] = \Auth::id() ?? 0;
    	
    	\App\Contact::create($data);
    	return back()->with('message', 'Message sent!');
    }
}

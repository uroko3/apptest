<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class FormController extends Controller
{
	public function index() {
		return view('form.index');
	}
	public function postValidates(PostRequest $request) {
				
		return view('form.confirm',['msg'=>'OK']);
	}
}

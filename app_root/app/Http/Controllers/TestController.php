<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

class TestController extends Controller
{
	public function __construct() {
		
	}
	
	public function form() {
		return view('form');
	}
	
	public function confirm(Request $request) {		
		$roules = [
			'name' => 'max:2',
		];
		
		$validator = Validator::make($request->all(), $roules);
		$validator->validate();
		
		return view('confirm');
	}
	
	public function complete() {
		throw ValidationException::withMessages(['name'=>'validation message']);
		
		//return redirect('/form')->withInput(['name'=>'return', 'name2'=>'return2'])->withErrors(['name'=>'exec_error']);
	}
}

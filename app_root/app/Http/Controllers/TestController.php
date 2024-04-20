<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;
use Exception;
use Throwable;

class TestController extends Controller
{
	public function __construct() {
		
	}
	
	public function form() {
		report("abc");
		throw ValidationException::withMessages(['a'=>'b']);
		
		return view('form');
	}
	
	public function confirm(Request $request) {
		$roules = [
			'name' => 'max:2',
		];
		
		try {
			$validator = Validator::make($request->all(), $roules);
			$validator->validate();
		}
		catch(ValidationException $e) {
			throw $e;
		}
		return view('confirm');
	}
	
	public function complete() {		
		throw ValidationException::withMessages(['name'=>'validation message']);
		
		//return redirect('/form')->withInput(['name'=>'return', 'name2'=>'return2'])->withErrors(['name'=>'exec_error']);
	}
}

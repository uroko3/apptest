<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\SoyamaService;

use Illuminate\Validation\ValidationException;
use App\Exceptions\TestException;
use App\Models\Soyama;
use Validator;
use Exception;
use Throwable;

class TestController extends Controller
{
	
	private $ss;
	
	public function __construct(SoyamaService $ss) {
		$this->ss = $ss;
	}
	
	public function form() {
		//abort(500);
		/*
		DB::transaction( function () {
			$data = Soyama::lockForUpdate()->find(1);
			
			print_r( $data->id );
			
			sleep(10);
		});
		*/
		
		$ff = $this->ss->getFilter();
		
		//$f = Soyama::filter()->get();
		
		$s = $this->ss->getData(9991);
		
		DB::beginTransaction();
		try {
			$data = Soyama::lockForUpdate()->find(1);
			print_r( $data->name . " 1" );
			
			$data->fill( ['name'=>'unko3333'] )->save();

			$x = Soyama::find(1);
			
			print_r( $x->name . " 2" );
			
			DB::rollback();
		}
		catch( Throwable $t ) {
			
			print_r( get_class( $t ) );
			
			DB::rollback();
		}
		
		
		
		//throw new TestException();
		
		//throw ValidationException::withMessages(['a'=>'b']);
		
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

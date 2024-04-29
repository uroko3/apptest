<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\ValidationException;
use App\Exceptions\TestException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * A list of exception types with their corresponding custom log levels.
	 *
	 * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
	 */
	protected $levels = [
		//
	];
	
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array<int, class-string<\Throwable>>
	 */
	protected $dontReport = [
		//
	];
	
	
	/**
	 * A list of the inputs that are never flashed to the session on validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];
	
	
	
	
	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		// これしないとValidationExceptionなどのreportが除外される
		$this->internalDontReport = [];
		
		$this->reportable(function (ValidationException $e) {
			//dd('reportable');
			Log::debug("hogehoge");
		});
		
		$this->reportable(function (HttpException $e) {
			Log::debug("http_exception desu");
		});
		
		$this->reportable(function (TestException $e) {
			dd('reportable TestException');
			Log::debug("hogehoge");
		});
		
		$this->renderable(function (Throwable $e, Request $request) {
			return response()->view('errors.500', ['url' => 'xxx'], 500);
		});

	}
}
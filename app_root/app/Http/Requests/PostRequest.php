<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	if ($this->path() == 'sample') {
    		return true;
    	}
    	return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        	'name' => 'required',
        	'age' => 'numeric | between:0,150',
        	'sex' => 'regex:/^[男|女]+$/u',
        ];
    }
    
    
    public function messages(){
    	return [
    		'name.required' => '名前を入力してください',
    		'age.numeric' => '整数で入力してください',
    		'age.between' => '0～150で入力してください',
    		'sex.regex' => '男か女で入力してください',
    	];
    }
}

<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'email' => ['required', 'string', 'email'],
			'password' => ['required', 'string'],
			'password_confirmation' => ['required', 'string']
		];
	}
}

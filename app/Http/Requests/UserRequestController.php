<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestController extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3', 
            'email' => 'required|email', 
            'password' => 'required|min:8', 
            'c_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            // 'body.required' => 'A message is required',
        ];
    }
}

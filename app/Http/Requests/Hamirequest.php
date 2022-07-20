<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Hamirequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'hamahang_id' => ['required'],
            'mobile' => [ 'required','min:9' , 'max:12', 'unique:hamis'],
            'mobile2' => [ 'required','min:9' , 'max:12', 'unique:hamis'],
        ];
    }
}

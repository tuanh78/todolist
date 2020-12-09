<?php

namespace App\Http\Requests;

use App\Rules\CharacterRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
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
            'name' => [
                'required',
                'min:5',
                'max: 100',
                new CharacterRule()
            ],

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'work'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlatRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
       $uniqueRule = Rule::unique('plats', 'date_menu');

        if ($this->route()->named('plats.update')) {
            $uniqueRule->ignore($this->route()->parameter('plat'));
        }

        return [
            'nom_menu' => 'required',
            'description_menu' => 'required',
            'date_menu' => [
                'date',
                'required',
                $uniqueRule,
                'after_or_equal:today'
            ],
            'image_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}

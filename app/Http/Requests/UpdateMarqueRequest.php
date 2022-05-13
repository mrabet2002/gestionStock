<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarqueRequest extends FormRequest
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
            "libele" => "required|max:255",
            "image" => "nullable|mimes:png,jped,jpg|max:2048",
            "descripiton" => "nullable|string|max:2000",
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Le champ ":attribute" ne peut pas être vide.',
            "mimes" => 'Le format du fichier choisi est invalide',
            "image.max" => 'Le fichier choisi est très volumineux.',
            'max' => "Le champ :attribute ne peut pas dépasser :max caractères.",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateproduitRequest extends FormRequest
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
            "categorie" => "required|integer",
            "marque" => "nullable|integer",
            "libele" => "required|max:255",
            "code_barre" => "nullable|regex:/^([0-9\(\)]*)$/|max:30",
            "descripiton" => "nullable|string|max:2000",
            "fournisseur" => "required|integer",
            "unite" => "nullable|string|max:20",
            "zone" => "nullable|string|max:200",
            "image"=> "image|mimes:png,jpg,jpeg,gif|max:2048",
            "prix_initial" => "nullable|regex:/^\d+(\.\d{1,2})?$/",
            "poids" => "nullable|regex:/^\d+(\.\d{1,2})?$/"
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
            'max' => "Le champ :attribute ne peut pas dépasser :max caractères.",
            "regex" => 'Le format du :attribute et invalide',
            'image.max' => 'Le fichier choisi est très volumineux.'
        ];
    }
}

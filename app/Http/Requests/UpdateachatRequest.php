<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateachatRequest extends FormRequest
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
            "fournisseur" => "required|integer",
            "devise" => "nullable|string|max:255",
            "remiseAchat" => "nullable|integer",
            "descripiton" => "nullable|string|max:2000",
            "remise" => "max:255",
            "lignesAchat.*.prix" => "nullable",
            "lignesAchat.*.devise" => "nullable",
            "lignesAchat.*.remise" => "nullable",
            "taxe" => "nullable",
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
            'fournisseur.required' => 'Le champ du fournisseur est obligatoire.',
            'fournisseur.integer' => 'Le nom du produit ne peut pas dépasser 255 caractères.',
            'descripiton.max' => 'La descripiton ne peut pas dépasser 2000 caractères.',
            'descripiton.string' => 'La descripiton est invalide.',
            'unite.max' => "L'unité ne peut pas dépasser 255 caractères.",
            'zone.max' => "L'emplacement ne peut pas dépasser 255 caractères.",
            'categorie.required' => 'Vous devez choisir une categorie.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreproduitRequest extends FormRequest
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
            "categorie" => "required",
            "libele" => "required|max:255",
            "code_barre" => "max:255",
            "descripiton" => "max:2000",
            "unite" => "max:255",
            "zone" => "max:200",
            "image"=> "image|mimes:png,jpg,jpeg,gif|max:2048",
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
            'libele.required' => 'Le nom du produit ne peut pas être vide.',
            'libele.max' => 'Le nom du produit ne peut pas dépasser 255 caractères.',
            'code_barre.max' => 'Le code barre ne peut pas dépasser 255 caractères.',
            'descripiton.max' => 'La descripiton ne peut pas dépasser 2000 caractères.',
            'unite.max' => "L'unité ne peut pas dépasser 255 caractères.",
            'zone.max' => "L'emplacement ne peut pas dépasser 255 caractères.",
            'categorie.required' => 'Vous devez choisir une categorie.',
        ];
    }
}

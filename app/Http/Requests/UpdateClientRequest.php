<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            "num_client" => "required|integer|unique:clients",
            "nom" => "required|max:255",
            "code_postal" => "nullable|regex:/^([0-9\s\-\+\(\)]*)$/|max:20",
            "descripiton" => "nullable|string|max:1000",
            "tel" => "nullable|regex:/^([0-9\s\-\+\(\)]*)$/|max:20",
            "site_web" => "nullable|max:255|url",
            "pays" => "nullable|string|max:255",
            "ville" => "nullable|string|max:255",
            "devise" => "nullable|string|max:20",
            "adresse" => "nullable|string|max:255",
            "fichier_attache"=> "mimes:png,jpg,jpeg,gif,pdf|max:2048",
            "email"=>"nullable|email|max:255",
            "statut" => "nullable|in:pp,pm"
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
            'nom.required'             => 'Le champ du nom ne peut pas être vide.',
            'nom.max'                  => 'Le nom du produit ne peut pas dépasser 255 caractères.',
            'code_postal.max'            => 'Le code postale ne peut pas dépasser 20 caractères.',
            'descripiton.max'           => 'La descripiton ne peut pas dépasser 1000 caractères.',
            'tel.max'                   => 'Le numero de téléphone ne peut pas dépasser 20 caractères.',
            'site_web.max'              => "L'URL du site web ne peut pas dépasser 255 caractères.",
            "site_web.url"              => "L'URL du site web et non valide",
            'num_client.required'  => 'Le champ "Numéro du client" ne peut pas être vide.',
            'num_client.integer'   => 'Le Numéro du client doit etre un nombre.',
            'num_client.unique'   => 'Le Numéro du client est déjà pris.',
            "pays"                      => 'Le champ "Pays" ne peut pas dépasser 255 caractères.',
            "ville"                     => 'Le champ "Ville" ne peut pas dépasser 255 caractères.',
            "devise"                    => 'Le champ "Devise" ne peut pas dépasser 255 caractères.',
            "adresse"                   => 'Le champ "Adresse" ne peut pas dépasser 255 caractères.',
            "fichier_attache.max"       => 'Le fichier choisi est très volumineux.',
            "email.email"               => "L'email et non valide",
            "email.max"                 => 'Le champ "E-mail" ne peut pas dépasser 255 caractères.',
        ];
    }
}

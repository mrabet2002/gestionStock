<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVenteRequest extends FormRequest
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
            "client" => "required|integer",
            "devise" => "nullable|string|max:20",
            "remiseVente" => "nullable|integer",
            "descripiton" => "nullable|string|max:2000",
            "remiseVente" => "max:255",
            "lignesVente.*.prix" => "nullable|numeric",
            "lignesVente.*.qte" => "nullable|string",
            "lignesVente.*.remise" => "nullable|integer",
            "lignesVente.*.date_expiration" => "nullable|date",
            "taxe" => "nullable|numeric",
            "cout_livraison" => "nullable|numeric",
            "adresse_livraison" => "nullable|string|max:255",
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
            'client.required' => 'Le champ du client est obligatoire.',
            'client.integer' => 'Le client est invalide.',
            'descripiton.max' => 'La descripiton ne peut pas dépasser 2000 caractères.',
            'descripiton.string' => 'La descripiton est invalide.',
        ];
    }
}

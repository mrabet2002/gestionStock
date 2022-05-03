<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecevoirProduitsRequest extends FormRequest
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
            'lignesAchat.*.qte_recu' => "nullable|integer",
            "date_reception" => "nullable|date"
        ];
    }
}

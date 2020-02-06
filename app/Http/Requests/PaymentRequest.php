<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'payer_name' => 'required',
            'payer_phone' => 'required',
            'country_id' => 'required',
            'amount' => 'required|numeric',
            'iban' => 'required|numeric',
            'recipier_name' => 'required',
            'recipier_bank' => 'required',
            'comision' => 'required',
            'conditions' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'object_uuid' => 'required|alpha_dash|exists:sport_objects,id',
            'card_uuid' => 'required|alpha_dash|exists:fit_cards,id',
        ];
    }
}

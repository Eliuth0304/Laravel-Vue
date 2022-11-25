<?php

namespace App\Http\Requests;

use App\Models\Weight;
use Illuminate\Foundation\Http\FormRequest;

class CreateWeightRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'weight_date' => 'required|date',
            'weight' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'comment' => 'required|string|max:2000'
        ];
    }

    public function getWeight() : Weight
    {
        return new Weight([
            'weight_date' => $this->weight_date,
            'weight' => $this->weight,
            'comment' => $this->comment
        ]);
    }
}

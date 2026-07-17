<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'sometimes|string',
            'priority' => 'sometimes|string',
            'cycle_status' => 'sometimes|boolean',
            'cycle_priority' => 'sometimes|boolean',
        ];
    }
}

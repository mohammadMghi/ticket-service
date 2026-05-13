<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApprovalBulkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ticket_ids' => ['required', 'array'],

            'ticket_ids.*' => [
                'integer',
                Rule::exists('tickets', 'id')->where(function ($query) {
                    $query->whereNull('status')
                        ->orWhere('status', '!=', 'approved');
                }),
            ],
            'comment' => 'required|string'
        ];
    }
}

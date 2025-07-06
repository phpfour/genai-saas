<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'topic' => ['required', 'string', 'min:2'],
        ];
    }
}

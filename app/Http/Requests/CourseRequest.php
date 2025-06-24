<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow all users (not login implementation)
    }

    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,archived'],
            'is_premium' => ['required', 'boolean'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:50'],
        ];

        if ($this->isMethod('patch')) {
            foreach ($rules as $field => &$rule) {
                array_unshift($rule, 'sometimes');
            }
        }

        return $rules;
    }

}

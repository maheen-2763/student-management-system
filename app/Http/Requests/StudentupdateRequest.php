<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use function Symfony\Component\Translation\t;

class StudentupdateRequest extends FormRequest
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
            'name' => 'bail|required|string|max:255',
            'email' => [
                'bail',
                'required',
                'email',
                Rule::unique('students')->ignore($this->student),
            ],
            'age' => 'bail|required|integer|min:5|max:100',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the student\'s name.',
            'email.required' => 'Please enter the student\'s email.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already associated with another student.',
            'age.required' => 'Please enter the student\'s age.',
            'age.integer' => 'Age must be a number.',
            'age.min' => 'Age must be at least 5 years.',
            'age.max' => 'Age must not exceed 100 years.',
            'image.image' => 'The uploaded file must be an image (jpg, png, webp, etc.).',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }
}

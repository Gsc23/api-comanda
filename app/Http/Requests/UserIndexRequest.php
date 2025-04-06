<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'per_page' => 'sometimes|integer|min:1',
            'page' => 'sometimes|integer|min:1'];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('per_page') && !$this->has('page')) {
                $validator->errors()->add('page', 'O parâmetro "page" é obrigatório quando "per_page" está presente.');
            }
        });
    }

}

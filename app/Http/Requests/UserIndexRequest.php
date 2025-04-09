<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserIndexRequest extends FormRequest
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
                $validator->errors()->add('message', 'O parâmetro "page" é obrigatório quando "per_page" está presente.');
                $validator->errors()->add('code', 400);
            }
        });
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}

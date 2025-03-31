<?php

namespace App\Http\Requests;

use App\Http\Resources\ErrorResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'regex:/^(\p{L}\w*\s+\p{L}\w*)+(\s+\p{L}\w*)*$/iu', function ($attribute, $value, $fail) {
                $nameParts = array_values(array_filter(explode(' ', trim($value))));
                if (count($nameParts) < 2) {
                    $fail('O nome deve conter nome e sobrenome.');
                    return;
                }
            }],
            'role' => 'required',
            'birthdate' => 'size:10|regex:/^\d{2}\/\d{2}\/\d{4}$/',
            'email' => 'required|email',
            'password' => 'required',
            'cpf' => ['required', function ($attribute, $value, $fail) {
                if (
                    strlen($value) !== 11 or
                    preg_match('/^(\d)\1{10}$/', $value) or
                    !preg_match('/^[0-9]+$/', $value)
                ) {
                    $fail("Ih, deu ruim... CPF deve ter exatamente 11 dígitos diferentes, sem pontos ou traço.");
                    return;
                }

                for ($t = 9; $t < 11; $t++) {
                    $d = 0;
                    for ($c = 0; $c < $t; $c++) {
                        $d += (int) $value[$c] * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;

                    if ((int) $value[$t] !== $d) {
                        $fail("Cpf inválido!");
                        return;
                    }
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.regex' => 'O nome deve conter nome e sobrenome.',
            'role.required' => 'O campo função é obrigatório.',
            'birthdate.size' => 'A data de nascimento deve ter 10 caracteres (DD/MM/AAAA).',
            'birthdate.regex' => 'Formato de data de nascimento inválido (DD/MM/AAAA).',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email informado não é válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $resource = new ErrorResource([
            'message' => $validator->errors()->first(),
            'status' => 422,
        ]);

        $response = $resource->response();
        $response->setStatusCode(422);

        throw new HttpResponseException($response);
    }
}

<?php
namespace App\DTO;

use App\Http\Requests\StoreUserRequest;

class UserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $cpf,
        public readonly string $role,
        public readonly string $birthdate,
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function factory()
    {
        app()->make(UserDTO::class);
    }

    public function toArray()
    {
        return array_merge(
            ['name' => $this->name],
            ['cpf' => $this->cpf],
            ['role' => $this->role],
            ['birthdate' => $this->birthdate],
            ['email' => $this->email],
            ['password' => $this->password],
        );
    }

    public static function fromRequest(StoreUserRequest $request)
    {
        return new UserDTO(
            name: $request->name,
            cpf: $request->cpf,
            role: $request->role,
            birthdate: $request->birthdate,
            email: $request->email,
            password: $request->password
        );
    }

    public static function fromArray($data)
    {
        return new UserDTO(
            name: $data['name'],
            cpf: $data['cpf'],
            role: $data['role'],
            birthdate: $data['birthdate'],
            email: $data['email'],
            password: $data['password']
        );
    }
}

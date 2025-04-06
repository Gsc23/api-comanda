<?php
namespace App\Repository;

use App\DTO\UserDTO;
use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = User::factory();
    }

    public static function factory()
    {
        app()->make(self::class);
    }

    public function getList($perPage)
    {
        return $this->model::paginate($perPage);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(UserDTO $userData)
    {
        if ($this->model->where('cpf', $userData->cpf)->exists()) {
            return null;
        }

        $user = User::factory()->populate($userData);
        return $user;
    }

    public function update($id, UserDTO $userData)
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user->update($userData->toArray());
        }
        return null;
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}

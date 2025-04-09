<?php

namespace App\Http\Services;

use App\DTO\UserDTO;
use App\Exceptions\RepositoryException;
use App\Http\Requests\StoreUserRequest;
use App\Repository\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public static function factory()
    {
        app()->make(self::class);
    }

    public function list($paginate)
    {
        $list = $this->repository->getList($paginate);
        if ($list->count() > 0) {
            return $list;
        }

        throw new RepositoryException('Nenhum usuário encontrado.', 404);
    }

    public function listAll()
    {
        $list = $this->repository->getAll();
        if ($list->count() > 0) {
            return $list;
        }

        throw new RepositoryException('Nenhum usuário encontrado.', 404);
    }

    public function handle(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $userDTO = UserDTO::fromArray($validatedData);

        $user = $this->repository->create($userDTO);
        if ($user) {
            $user->save();
            return $user;
        }
        throw new RepositoryException('Usuário com o cpf: ' . $userDTO->cpf . ' - já existe no sistema.', 409);
    }

    public function findUser($id)
    {
        $user = $this->repository->getById($id);
        if ($user) {
            return $user;
        }
        throw new RepositoryException('Usuário com id: ' . $id . ' não existe', 404);
    }

    public function changeUser(StoreUserRequest $request, $id)
    {
        $validatedData = $request->validated();
        $userDTO = UserDTO::fromArray($validatedData);

        $user = $this->repository->update($id, $userDTO);
        if ($user) {
            return $user;
        }
        throw new RepositoryException('Alteração não executada: Usuário com id: ' . $id . ' não existe', 404);
    }

    public function destroy($id)
    {
        $return = $this->repository->delete($id);
        if ($return) {
            return;
        }
        throw new RepositoryException('Usuário com id: ' . $id . ' não existe', 404);
    }
}

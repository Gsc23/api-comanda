<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserIndexRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

class UserController extends Controller
{

    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function index(UserIndexRequest $request)
    {
        log::info('Listando usuários');
        try {
            $handler = $this->indexHandler($request);
            $code = $this->codeHandler($handler);

            log::debug('Usuários listados com sucesso');
            return new SuccessResource([
                'user' => $handler,
                'code' => $code,
            ]);
        } catch (Throwable $e) {
            $response = new ErrorResource([
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            ]);

            $response = $response->response();
            $response->setStatusCode($e->getCode());

            log::error('Erro ao listar usuários: ' . $e->getMessage() . ' - ' . $e->getCode());
            return $response;
        }
    }

    public function store(StoreUserRequest $request)
    {
        log::info('Criando usuário');
        try {
            $user = $this->service->handle($request);
            $response = new SuccessResource([
                'user' => $user,
                'code' => 201,
            ]);

            $response = $response->response();
            $response->setStatusCode(201);

            log::debug('Usuário criado com sucesso');
            return $response;
        } catch (Throwable $e) {
            $response = new ErrorResource([
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            ]);

            $response = $response->response();
            $response->setStatusCode($e->getCode());

            Log::error('Erro ao criar usuário: ' . $e->getMessage() . ' - ' . $e->getCode());
            return $response;
        }
    }

    public function show($id)
    {
        log::info('Localizando usuário');
        try {
            $user = $this->service->findUser($id);
            $response = new SuccessResource([
                'user' => $user,
                'code' => 200,
            ]);

            $response = $response->response();
            $response->setStatusCode(200);

            log::debug('Usuário localizado com sucesso');
            return $response;
        } catch (Throwable $e) {
            $response = new ErrorResource([
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            ]);

            $response = $response->response();
            $response->setStatusCode($e->getCode());

            Log::error('Erro ao localizar usuário: ' . $id . ' - ' . $e->getMessage()) . ' - ' . $e->getCode();
            return $response;
        }
    }

    public function update(StoreUserRequest $request, $id)
    {
        log::info('Editando usuário');
        try {
            $user = $this->service->changeUser($request, $id);
            $response = new SuccessResource([
                'user' => $this->service->findUser($id),
                'code' => 200,
            ]);

            $response = $response->response();
            $response->setStatusCode(200);

            log::debug('Usuário editado com sucesso');
            return $response;
        } catch (Throwable $e) {
            $response = new ErrorResource([
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            ]);

            $response = $response->response();
            $response->setStatusCode($e->getCode());

            Log::error('Erro ao editar dados do usuário: ' . $id . ' - ' . $e->getMessage() . ' - ' . $e->getCode());
            return $response;
        }
    }

    public function delete($id)
    {
        log::info('Deletando usuário');
        try {
            $this->service->destroy($id);
            $response = new SuccessResource([
                'user' => 'Usuário: ' . $id . ' - Deletado com sucesso',
                'code' => 200,
            ]);

            $response = $response->response();
            $response->setStatusCode(200);

            log::debug('Usuário deletado com sucesso');
            return $response;
        } catch (Throwable $e) {
            $response = new ErrorResource([
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            ]);

            $response = $response->response();
            $response->setStatusCode($e->getCode());

            Log::error('Erro ao deletar usuário: ' . $id . ' - ' . $e->getMessage() . ' - ' . $e->getCode());
            return $response;
        }
    }

    private function listAll(UserIndexRequest $request)
    {
        $user = $this->service->listAll();
        if (empty($user)) {
            throw new InvalidArgumentException('Nenhum usuário encontrado', 404);
        }

        return $user;
    }

    private function listPagination(UserIndexRequest $request)
    {
        $user = $this->service->list($request->get('per_page', 10));
        if (empty($user)) {
            throw new InvalidArgumentException('Nenhum usuário encontrado', 404);
        }

        return $user;
    }

    private function indexHandler(UserIndexRequest $request)
    {

        if (($request->has('all') && $request->boolean('all')) || empty($request->query())) {
            return $this->listAll($request);
        }

        return $this->listPagination($request);
    }

    private function codeHandler($handler)
    {
        if (
            method_exists($handler, 'currentPage') &&
            method_exists($handler, 'lastPage') &&
            $handler->currentPage() != $handler->lastPage()
        ) {
            return 206;
        }

        return 200;
    }
}

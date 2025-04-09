<?php

namespace App\Docs;

/**
 * @OA\Info(
 *     title="API Comanda - Usuários",
 *     version="1.0.0",
 *     description="API para gerenciamento de usuários"
 * )
 * @OA\Get(
 *     path="/api/users",
 *     summary="Listar usuários",
 *     description="Retorna uma lista de usuários com opção de paginação",
 *     operationId="indexUser",
 *     tags={"Usuários"},
 *     @OA\Parameter(
 *         name="all",
 *         in="query",
 *         description="Retornar todos os usuários sem paginação",
 *         required=false,
 *         @OA\Schema(type="boolean")
 *     ),
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Quantidade de registros por página",
 *         required=false,
 *         @OA\Schema(type="integer", default=10)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de usuários retornada com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="array", @OA\Items(type="object")),
 *                 @OA\Property(property="code", type="integer", example=200)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=206,
 *         description="Lista parcial de usuários retornada com sucesso (paginada)",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="object"),
 *                 @OA\Property(property="code", type="integer", example=206)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Nenhum usuário encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Nenhum usuário encontrado"),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/users",
 *     summary="Criar usuário",
 *     description="Cria um novo usuário no sistema",
 *     operationId="storeUser",
 *     tags={"Usuários"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Dados do usuário",
 *         @OA\JsonContent(
 *             required={"name", "email", "password", "role"},
 *             @OA\Property(property="name", type="string", example="João Silva"),
 *             @OA\Property(property="email", type="string", format="email", example="joao@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="senha123"),
 *             @OA\Property(property="role", type="string", example="admin")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Usuário criado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="object"),
 *                 @OA\Property(property="code", type="integer", example=201)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Os dados fornecidos são inválidos"),
 *             @OA\Property(property="status", type="integer", example=422)
 *         )
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/users/{id}",
 *     summary="Buscar usuário",
 *     description="Retorna os dados de um usuário específico",
 *     operationId="showUser",
 *     tags={"Usuários"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do usuário",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuário encontrado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="object"),
 *                 @OA\Property(property="code", type="integer", example=200)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuário não encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Usuário não encontrado"),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     )
 * )
 *
 * @OA\Put(
 *     path="/api/users/{id}",
 *     summary="Atualizar usuário",
 *     description="Atualiza os dados de um usuário existente",
 *     operationId="updateUser",
 *     tags={"Usuários"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do usuário",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Dados do usuário",
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="João Silva Atualizado"),
 *             @OA\Property(property="email", type="string", format="email", example="joao.atualizado@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="novaSenha123"),
 *             @OA\Property(property="role", type="string", example="manager")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuário atualizado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="object"),
 *                 @OA\Property(property="code", type="integer", example=200)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuário não encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Usuário não encontrado"),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Os dados fornecidos são inválidos"),
 *             @OA\Property(property="status", type="integer", example=422)
 *         )
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/api/users/{id}",
 *     summary="Excluir usuário",
 *     description="Remove um usuário do sistema",
 *     operationId="deleteUser",
 *     tags={"Usuários"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do usuário",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuário excluído com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="string", example="Usuário: 1 - Deletado com sucesso"),
 *                 @OA\Property(property="code", type="integer", example=200)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuário não encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Usuário não encontrado"),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     )
 * )
 */
class UserControllerDocs
{
    // Este arquivo é apenas para documentação Swagger
}

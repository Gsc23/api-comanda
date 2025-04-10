<?php

namespace App\Docs;

/**
 * @OA\Info(
 *     title="API Comanda - Usuários",
 *     version="1.0.0",
 *     description="API para gerenciamento de usuários"
 * )
 *
 * @OA\Get(
 *     path="/api/user",
 *     summary="Listar usuários",
 *     description="Retorna uma lista paginada de usuários. Os parâmetros per_page e page são obrigatórios.",
 *     operationId="indexUser",
 *     tags={"Usuários"},
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Quantidade de registros por página",
 *         required=true,
 *         @OA\Schema(type="integer", default=10)
 *     ),
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Número da página",
 *         required=true,
 *         @OA\Schema(type="integer", default=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista completa de usuários",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="array", @OA\Items(type="object")),
 *                 @OA\Property(property="status", type="integer", example=200)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=206,
 *         description="Lista parcial de usuários (paginada)",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="object"),
 *                 @OA\Property(property="status", type="integer", example=206)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Erro de validação nos parâmetros",
 *         @OA\JsonContent(
 *             @OA\Property(property="per_page", type="array", @OA\Items(type="string", example="O campo per_page é obrigatório.")),
 *             @OA\Property(property="page", type="array", @OA\Items(type="string", example="O campo page é obrigatório."))
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Nenhum usuário encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Nenhum usuário encontrado"),
 *                 @OA\Property(property="status", type="integer", example=404)
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/user",
 *     summary="Criar usuário",
 *     description="Cria um novo usuário no sistema",
 *     operationId="storeUser",
 *     tags={"Usuários"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
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
 *                 @OA\Property(property="status", type="integer", example=201)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string"),
 *                 @OA\Property(property="status", type="integer", example=422)
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/user/{id}",
 *     summary="Obter usuário",
 *     description="Retorna os dados de um usuário específico",
 *     operationId="showUser",
 *     tags={"Usuários"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do usuário",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dados do usuário",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="object"),
 *                 @OA\Property(property="status", type="integer", example=200)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuário não encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Usuário não encontrado"),
 *                 @OA\Property(property="status", type="integer", example=404)
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Put(
 *     path="/api/user/{id}",
 *     summary="Atualizar usuário",
 *     description="Atualiza os dados de um usuário existente",
 *     operationId="updateUser",
 *     tags={"Usuários"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do usuário",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="João Silva Atualizado"),
 *             @OA\Property(property="email", type="string", format="email", example="joao.novo@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="novaSenha123"),
 *             @OA\Property(property="role", type="string", example="user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuário atualizado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="object"),
 *                 @OA\Property(property="status", type="integer", example=200)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuário não encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Usuário não encontrado"),
 *                 @OA\Property(property="status", type="integer", example=404)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string"),
 *                 @OA\Property(property="status", type="integer", example=422)
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/api/user/{id}",
 *     summary="Excluir usuário",
 *     description="Remove um usuário do sistema",
 *     operationId="deleteUser",
 *     tags={"Usuários"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do usuário",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuário excluído com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user", type="string", example="Usuário: 123 - Deletado com sucesso"),
 *                 @OA\Property(property="status", type="integer", example=200)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuário não encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Usuário não encontrado"),
 *                 @OA\Property(property="status", type="integer", example=404)
 *             )
 *         )
 *     )
 * )
 */
class UserControllerDocs
{
    // Este arquivo é apenas para documentação Swagger
}

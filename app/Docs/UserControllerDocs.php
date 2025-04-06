<?php

namespace App\Docs;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API Comanda Eletrônica",
 *     description="Documentação da API de Comanda usando Swagger",
 *     @OA\Contact(
 *         email="gsdacosta.24@gmail.com"
 *     )
 * )
 * @OA\Get(
 *     path="/api/user",
 *     operationId="getUsers",
 *     tags={"Usuários"},
 *     summary="Listar usuários",
 *     description="Retorna uma lista paginada de usuários com o paramêtro 'per_page' ou todos com 'all=true'",
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Número de usuários por página",
 *         required=false,
 *         @OA\Schema(type="integer", default=10)
 *     ),
 *     @OA\Parameter(
 *         name="all",
 *         in="query",
 *         description="Se 'true', retorna todos os usuários sem paginação",
 *         required=false,
 *         @OA\Schema(type="boolean")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de usuários paginada retornada com sucesso",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user", type="array", @OA\Items(ref="#/components/schemas/User")),
 *             @OA\Property(property="code", type="integer", example=200)
 *         )
 *      ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de usuários retornada com sucesso",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user", type="array", @OA\Items(ref="#/components/schemas/User")),
 *             @OA\Property(property="code", type="integer", example=200)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Nenhum usuário encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Nenhum usuário encontrado."),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     )
 * )
 */
class UserControllerDocs
{
    // Este arquivo é apenas para documentação Swagger
}

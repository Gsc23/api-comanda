<?php

namespace App\Docs\Schemas;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="Usuário",
 *     required={"id", "name", "username", "cpf", "role", "birthdate", "email"},
 *
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         example="21bc300c-558a-4d35-b6c5-7b4df6c3ff53",
 *         description="UUID único do usuário"
 *     ),
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Gustavo Almeida",
 *         description="Nome completo (nome e sobrenome)"
 *     ),
 *
 *     @OA\Property(
 *         property="username",
 *         type="string",
 *         example="g.almeida",
 *         description="Gerado automaticamente a partir do nome"
 *     ),
 *
 *     @OA\Property(
 *         property="cpf",
 *         type="string",
 *         example="12345678900",
 *         description="CPF sem pontos e traços"
 *     ),
 *
 *     @OA\Property(
 *         property="role",
 *         type="string",
 *         example="admin",
 *         description="Função do usuário no sistema"
 *     ),
 *
 *     @OA\Property(
 *         property="birthdate",
 *         type="string",
 *         example="05/04/1995",
 *         description="Data de nascimento no formato DD/MM/AAAA"
 *     ),
 *
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         example="gustavo@example.com",
 *         description="Endereço de e-mail do usuário"
 *     ),
 *
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2024-04-01T12:00:00Z",
 *         description="Data de criação do registro"
 *     ),
 *
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2024-04-01T12:00:00Z",
 *         description="Data da última atualização do registro"
 *     )
 * )
 */
class UserSchema
{}

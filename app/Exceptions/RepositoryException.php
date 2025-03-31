<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RepositoryException extends Exception
{
    public function __construct(String $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public function render(): JsonResponse
    {
        $return = ["mensagem" => $this->message];

        return response()->json($return, $this->getCode());
    }
}

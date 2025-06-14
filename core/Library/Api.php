<?php

namespace Core\Library;

use Core\Library\Response;
use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Api extends ControllerMain
{
    private static $encrypt_type = 'HS256';
    private static $token_expiration = 180; // segundos

    /**
     * generateToken
     *
     * @return void
     */
    public static function generateToken()
    {
        $headers    = getallheaders();
        $authBasic  = explode(":", str_replace("Basic ", "", $headers['Authorization'] ?? ''));

        if (empty($authBasic)) {
            $authBasic  = explode(":", str_replace("basic ", "", $headers['authorization'] ?? ''));
        }

        $user_id    = $authBasic[0] ?? '';
        $user_nome  = $authBasic[1] ?? '';

        if (($user_id !== $_ENV['API_USER_ID']) || ($user_nome !== $_ENV['API_USER_NOME'])) {
            return Response::json([
                'status' => 401,
                'message' => "Key inválido ou ausente." . json_encode($authBasic),
            ]);
        } 

        $payload = [
            "iss" => "https://suaapi.com",
            "aud" => "https://cliente.suaapi.com",
            'iat' => time(),
            'exp' => time() + (self::$token_expiration * 60),
            "user_id" => $user_id,
            "user_nome" => $user_nome
        ];

        return Response::json([
            'status' => 201,
            'message' => "Token gerado com sucesso.",
            'data' => [
                'token' => JWT::encode($payload, $_ENV['API_SECRET_KEY'], self::$encrypt_type),
                "expires_in" => (3 * 60),
                "token_type" => "Bearer",
                "issued_at" => $payload['iat'],
                "expires_at" => $payload['exp'],
            ],
        ]);
    }

    /**
     * validateToken
     *
     * @return json
     */
    public static function validateToken()
    {
        $headers    = getallheaders();
        $token      = $headers['Authorization'] ?? '';
        $token      = str_replace("Bearer ", "", $headers['authorization'] ?? '');

        if (empty($token)) {
            $token        = str_replace("Bearer ", "", $headers['Authorization'] ?? '');
        }
        
        try {
            return JWT::decode($token, new Key($_ENV['API_SECRET_KEY'], self::$encrypt_type));
        } catch (Exception $e) {

            return Response::json([
                'status' => 401,
                'message' => "Token inválido ou ausente.",
            ]);
        }
    }

    /**
     * getMessageValidationRules
     *
     * @return string
     */
    protected function getMessageValidationRules()
    {
        $msgError = "";

        foreach(Session::getDestroy("errors") as $key => $value) {
            $msgError = ($msgError != "" ? substr($msgError, 0 , strlen($msgError) - 1) . ', ' : "") .  strip_tags($value);
        }

        return $msgError;
    }
}

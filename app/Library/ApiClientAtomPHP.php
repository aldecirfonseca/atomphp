<?php

namespace App\Library;

class ApiClientAtomPHP
{
    private string $baseUrl;
    private ?string $token;

    public function __construct(string $baseUrl, ?string $token = null)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->token = $token;
    }

    /**
     * gerarToken
     *
     * @param string $method 
     * @return void
     */
    public function gerarToken(string $method = "GET")
    {
        $url = "{$this->baseUrl}/generateToken";

        $headers = [
            'Content-Type: application/json',
            'Authorization: Basic ' . $_ENV['API_USER_ID'] . ":" . $_ENV['API_USER_NOME'],
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 60,
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        return [
            'status' => $httpCode,
            'body' => json_decode($response, true),
            'error' => $error
        ];
    }

    /**
     * setToken
     *
     * @param string $token 
     * @return void
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * request
     *
     * @param string $method 
     * @param string $resource 
     * @param array $data 
     * @return array
     */
    public function request(string $method, string $resource, array $data = []): array
    {
        $url = "{$this->baseUrl}/{$resource}";

        $headers = [
            'Content-Type: application/json',
        ];

        if ($this->token) {
            $headers[] = 'Authorization: ' . $this->token;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 30,
        ]);

        if (in_array(strtoupper($method), ['POST', 'PUT']) && !empty($data)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        return [
            'status' => $httpCode,
            'body' => json_decode($response, true),
            'error' => $error
        ];
    }
}
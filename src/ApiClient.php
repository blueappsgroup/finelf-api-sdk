<?php

namespace Finelf_Api_Sdk;

use Eljam\GuzzleJwt\JwtMiddleware;
use Eljam\GuzzleJwt\Manager\JwtManager;
use Finelf_Api_Sdk\Strategies\AuthStrategy;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class ApiClient {
    private $username;
    private $password;
    private $uri;

    public function __construct(array $authData) {
        $this->username     = $authData['username'];
        $this->password     = $authData['password'];
        $this->uri          = $authData['uri'];
    }

    public function createApiClient(): Client {
        $jwtManager = $this->createJwtManager();
        $stack      = HandlerStack::create();
        $stack->push(new JwtMiddleware($jwtManager));

        return new Client([
            'handler'  => $stack,
            'base_uri' => $this->uri,
        ]);
    }

    private function createJwtManager(): JwtManager {
        $authClient          = $this->createClient();
        $authStrategy        = $this->createAuthStrategy();
        $persistenceStrategy = null;

        return new JwtManager($authClient, $authStrategy, $persistenceStrategy, ['token_url' => '/api/auth/login', 'token_key' => 'token']);
    }

    private function createClient(): Client {
        return new Client(['base_uri' => $this->uri]);
    }

    private function createAuthStrategy(): AuthStrategy {
        return new AuthStrategy([
            'username'      => $this->username,
            'password'      => $this->password,
        ]);
    }
}

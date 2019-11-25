<?php
namespace Ranking;
namespace Eljam\GuzzleJwt;
namespace Eljam\GuzzleJwt\Manager;
namespace Eljam\GuzzleJwt\Strategy\Auth\;
namespace GuzzleHttp;

require_once 'vendor/autoload.php';

use Eljam\GuzzleJwt\JwtMiddleware;
use Eljam\GuzzleJwt\Manager\JwtManager;
use Eljam\GuzzleJwt\Strategy\Auth\QueryAuthStrategy;
//use GuzzleHttp\Client;
//use GuzzleHttp\HandlerStack;

class apiClient{

    private $username;
    private $password;
    private $uri;

    public function __construct(array $authData){
        $this->username = $authData['username'];
        $this->password = $authData['password'];
        $this->uri = $authData['uri'];
    }

    public function createApiClient(){
        $jwtManager = $this->createJwtManager();
        $stack = HandlerStack::create();
        $stack->push(new JwtMiddleware($jwtManager));

        return new Client(['handler' => $stack, 'base_uri' => $this->uri]);
    }

    private function createAuthStrategy(){
        return new QueryAuthStrategy(['username' => $this->username, 'password' => $this->password]);
    }

    private function createClient(){
        return new Client(['base_uri' => $this->uri]);
    }

    private function createJwtManager(){
        $authClient = $this->createClient();
        $authStrategy = $this->createAuthStrategy();
        $persistenceStrategy = null;

        return new JwtManager( $authClient, $authStrategy, $persistenceStrategy, ['token_url' => '/auth/login',]);
    }
}
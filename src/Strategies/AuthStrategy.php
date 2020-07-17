<?php

namespace Finelf_Api_Sdk\Strategies;

use Eljam\GuzzleJwt\Strategy\Auth\AbstractBaseAuthStrategy;
use GuzzleHttp\RequestOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthStrategy extends AbstractBaseAuthStrategy {
    public function configureOptions(OptionsResolver $resolver) {
        parent::configureOptions($resolver);

        $fields = ['username', 'password'];

        $resolver->setDefaults($fields);
        $resolver->setRequired($fields);
    }

    public function getRequestOptions(): array {
        return [
            RequestOptions::JSON    => [
                'username'      => $this->options['username'],
                'password'      => $this->options['password'],
            ],
            RequestOptions::HEADERS => [
                'Content-type' => 'application/json;charset=UTF-8',
            ],
        ];
    }
}

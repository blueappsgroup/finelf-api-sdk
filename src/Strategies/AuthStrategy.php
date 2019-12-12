<?php

namespace Finelf\Strategies;

use Eljam\GuzzleJwt\Strategy\Auth\AbstractBaseAuthStrategy;
use GuzzleHttp\RequestOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthStrategy extends AbstractBaseAuthStrategy {
    public function configureOptions(OptionsResolver $resolver) {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'username',
            'password',
            'client_id',
            'client_secret',
        ]);

        $resolver->setRequired(['username', 'password', 'client_id', 'client_secret']);
    }

    public function getRequestOptions(): array {
        return [
            RequestOptions::JSON    => [
                'username'      => $this->options['username'],
                'password'      => $this->options['password'],
                'client_id'     => $this->options['client_id'],
                'client_secret' => $this->options['client_secret'],
            ],
            RequestOptions::HEADERS => [
                'Content-type' => 'application/json;charset=UTF-8',
            ],
        ];
    }
}

<?php

if (!function_exists('user')) {
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function user(): ?App\Models\User
    {
        return session()->get('user');
    }
}

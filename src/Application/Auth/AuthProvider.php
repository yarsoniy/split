<?php

namespace Company\Split\Application\Auth;

interface AuthProvider
{
    /**
     * @param $id
     * @param string $username
     * @param string $password
     * @throws UsernameIsNotUnique
     */
    public function register($id, string $username, string $password);
}
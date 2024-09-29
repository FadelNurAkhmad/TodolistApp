<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        "parjo" => "rahasia"
    ];

    function login(string $user, string $password): bool
    {
        // Mengecek apakah nama pengguna yang diberikan ada dalam array $users.
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password == $correctPassword;
    }
}

<?php

namespace App\Domain\UseCase;

use App\Service\User;

class UserUseCase {
    private User $userService;

    public function __construct() {
        $this->userService = new User();
    }


    public function createUser($data) {
        [
            'username'=>$username,
            'email'=>$email,
            'password'=>$password
        ] = $data;
        
        $this->userService->getUserByUserName($username);   
        $this->userService->getEmail($email);
        $this->userService->createUser($data);

    }

}
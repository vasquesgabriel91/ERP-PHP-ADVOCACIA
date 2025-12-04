<?php

namespace App\Service\User;
use App\Repository\UserRepository;

class UserService {
    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    public function getUserByUsername(string $username) {
        $user = $this->userRepository->findByUsername($username);

        if (!$user) throw new \Exception("User not found");
        
        return $user;
    }

    public function getEmail(string $email) {
        $email = $this->userRepository->findByEmail($email);

        if (!$email) throw new \Exception("Email not found");   

        return $email;
    }
    public function createUser($data) {
        [
            'username'=>$username,
            'email'=>$email,
            'password'=>$password
        ] = $data;
         
        $this->userRepository->createUser($username, $email, $password);
        
    }
}
<?php
namespace App\Controller;

use App\Core\UserService;

class UserController {

    private UserService $userService;

    public function __construct() {
        $this->userService = new UserService();
    }
    
    public function store() {
        $this->userService->createUser($_POST);
        redirect()->toRoute('user.list');
    }
}
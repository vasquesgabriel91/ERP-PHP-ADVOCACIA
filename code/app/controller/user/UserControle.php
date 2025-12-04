<?php
namespace App\Controller;

use App\Core\UserService;
use App\Core\Request;

class UserController {

    private UserService $userService;

    public function __construct() {
        $this->userService = new UserService();
    }
    
    public function store(Request $request) {
        $data = $request->body();
        $this->userService->createUser($data);
        redirect()->toRoute('user.list');
    }
}
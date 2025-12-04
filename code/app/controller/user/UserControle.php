<?php
namespace App\Controller;

use App\Domain\UseCase;
use App\Core\Request;

class UserController {

    private UserUseCase $userUseCase;

    public function __construct() {
        $this->userUseCase = new UserUseCase();
    }
    
    public function store(Request $request) {
        $data = $request->body();

        if(!$data) throw new \Exception("No Data in Body");


        $this->userUseCase->createUser($data);
        redirect()->toRoute('user.list');
    }
}
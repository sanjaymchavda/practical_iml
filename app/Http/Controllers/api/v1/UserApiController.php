<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    protected $userRepository = "";

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listEducations()
    {
        return $this->userRepository->listEducationsApi();
    }

    public function listCompanies()
    {
        return $this->userRepository->listCompaniesApi();
    }

    public function listUsers()
    {
        return $this->userRepository->listUsersApi();
    }

    public function addUser(Request $request){
        return $this->userRepository->addUserApi($request);
    }

    public function findUser(Request $request){
        return $this->userRepository->findUserApi($request);
    }

    public function updateUser(Request $request){
        return $this->userRepository->updateUserApi($request);
    }

    public function deleteUser(Request $request){
        return $this->userRepository->deleteUserApi($request);
    }
}

<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface UserRepositoryInterface {

    public function updateUser($array,$id);

    public function addUser($array);

    public function getAjaxUserData(Request $request);

    public function deleteUser($id);

    public function getSingleUser($id);

    public function listEducationsApi();

    public function listCompaniesApi();

    public function listUsersApi();

    public function addUserApi(Request $request);

    public function findUserApi(Request $request);

    public function updateUserApi(Request $request);

    public function deleteUserApi(Request $request);
}

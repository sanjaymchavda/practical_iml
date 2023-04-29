<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Company;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

class UserController extends Controller
{
    protected $userRepository = "";

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $education = Education::get();
        $company = Company::get();
        return view('welcome', compact('education','company'));
    }

    public function loadUserData(Request $request)
    {
        $users = $this->userRepository->getAjaxUserData($request);
        return response()->json(['users' => $users]);
    }

    public function addUserData(Request $request)
    {
        $array = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "education_id" => $request->education_id,
            "company_id" => $request->company_id,
            "hobby" => $request->hobby,
            "experience" => $request->experience,
            "message" => $request->message,
        ];
        if ($request->action == "add") {
            $user =  $this->userRepository->addUser($array);
            if ($request->hasfile('image')) {
                if (File::exists(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'jpg')) || File::exists(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'jpeg')) || File::exists(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'gif')) ||  File::exists(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'png'))) {
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'jpg'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'jpeg'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'gif'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'png'));
                }
                $imageName = 'USER_IMAGE' . '_' . $user->id . '.' . $request->image->getClientOriginalExtension();
                $path = 'uploads/';
                $request->image->move(public_path($path), $imageName);
                $this->userRepository->updateUser(["image"=>$path . $imageName],$user->id);
            }

            return response()->json(["user" => "add"]);
        }

        if ($request->action == "update") {
            $user = $this->userRepository->updateUser($array,$request->id);
            if ($request->hasfile('image')) {
                if (File::exists(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'jpg')) || File::exists(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'jpeg')) || File::exists(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'gif')) ||  File::exists(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'png'))) {
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'jpg'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'jpeg'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'gif'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $user->id . '.' . 'png'));
                }
                $imageName = 'USER_IMAGE' . '_' . $user->id . '.' . $request->image->getClientOriginalExtension();
                $path = 'uploads/';
                $request->image->move(public_path($path), $imageName);
                $this->userRepository->updateUser(["image"=>$path . $imageName],$user->id);
            }

            return response()->json(["user" => "update"]);
        }
    }

    public function edit($id){
        return $this->userRepository->getSingleUser($id);
    }

    public function destroy($id){
        return $this->userRepository->deleteUser($id);
    }
}

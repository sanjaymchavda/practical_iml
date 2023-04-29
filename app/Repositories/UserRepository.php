<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Company;
use App\Models\Education;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserRepository implements UserRepositoryInterface
{
    protected $successStatus = 200;
    protected $validationErrorStatus = 400;

    public function updateUser($array, $id)
    {
        $post = User::find($id);
        $post->update($array);
        return $post;
    }

    public function addUser($array)
    {
        $post = User::create($array);
        return $post;
    }

    public function getAjaxUserData(Request $request)
    {
        if ($request->search) {
            $user = User::where("name", "LIKE", "%" . $request->search . "%")->orWhere("email", "LIKE", "%" . $request->search . "%")->latest()->paginate(3);
        } else {
            $user = User::latest()->paginate(3);
        }
        return $user;
    }

    public function deleteUser($id)
    {
        return User::find($id)->delete();
    }

    public function getSingleUser($id)
    {
        return User::find($id);
    }

    public function listEducationsApi()
    {
        $users = Education::select('id','name')->latest()->get();

        return response()->json(['message' => "education list", 'status' => 1, 'data' => $users], $this->successStatus);
    }

    public function listCompaniesApi(){
        $users = Company::select('id','name')->latest()->get();

        return response()->json(['message' => "company list", 'status' => 1, 'data' => $users], $this->successStatus);
    }

    public function listUsersApi()
    {
        $users = User::with(["education:id,name", "company:id,name"])->latest()->select('id', 'education_id', 'company_id', 'name', 'email', 'phone', 'gender', 'hobby', 'experience', 'image', 'message')->get();

        return response()->json(['message' => "user list", 'status' => 1, 'data' => $users], $this->successStatus);
    }

    public function addUserApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>     'required|regex:/^[a-zA-Z ]+$/u',
            'email'         =>     'required|email',
            'education_id'  =>     'required|numeric',
            'company_id'    =>     'required|numeric',
            'phone'         =>     'required|digits:10',
            'gender'        =>     'required|digits_between:1,2',
            'hobby'         =>     'required',
            'experience'    =>     'required',
            'message'       =>     'required',
            'image'         =>     'required|mimes:jpeg,jpg,png,gif'
        ]);

        if ($validator->fails()) {
            return response()->json(['messge' => $validator->errors()->all()[0], 'status' => 0, 'data' => array()], $this->validationErrorStatus);
        } else {
            $addUser = [
                'name'          =>     $request->name,
                'email'         =>     $request->email,
                'education_id'  =>     $request->education_id,
                'company_id'    =>     $request->company_id,
                'phone'         =>     $request->phone,
                'gender'        =>     $request->gender,
                'hobby'         =>     $request->hobby,
                'experience'    =>     $request->experience,
                'message'       =>     $request->message,
            ];

            $user = User::create($addUser);

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

                User::where('id', $user->id)->update(["image" => $path . $imageName]);
            }

            if ($user) {
                return response()->json(['message' => "user created successfully", 'status' => 1, 'data' => array($user)], $this->successStatus);
            } else {
                return response()->json(['message' => "failed to create user", 'status' => 1, 'data' => array($user)], $this->validationErrorStatus);
            }
        }
    }

    public function findUserApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'          =>     'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['messge' => $validator->errors()->all()[0], 'status' => 0, 'data' => array()], $this->validationErrorStatus);
        } else {
            $user = User::with(["education:id,name", "company:id,name"])->find($request->user_id);

            if ($user) {
                return response()->json(['message' => "user", 'status' => 1, 'data' => array($user)], $this->successStatus);
            } else {
                return response()->json(['message' => "failed to find user", 'status' => 1, 'data' => array()], $this->validationErrorStatus);
            }
        }
    }

    public function updateUserApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       =>     'required|numeric',
            'name'          =>     'required|regex:/^[a-zA-Z ]+$/u',
            'email'         =>     'required|email',
            'education_id'  =>     'required|numeric',
            'company_id'    =>     'required|numeric',
            'phone'         =>     'required|digits:10',
            'gender'        =>     'required|digits_between:1,2',
            'hobby'         =>     'required',
            'experience'    =>     'required',
            'message'       =>     'required',
            'image'         =>     'mimes:jpeg,jpg,png,gif'
        ]);

        if ($validator->fails()) {
            return response()->json(['messge' => $validator->errors()->all()[0], 'status' => 0, 'data' => array()], $this->validationErrorStatus);
        } else {
            $updateUser = [
                'name'          =>     $request->name,
                'email'         =>     $request->email,
                'education_id'  =>     $request->education_id,
                'company_id'    =>     $request->company_id,
                'phone'         =>     $request->phone,
                'gender'        =>     $request->gender,
                'hobby'         =>     $request->hobby,
                'experience'    =>     $request->experience,
                'message'       =>     $request->message,
            ];

            if ($request->hasfile('image')) {
                if (File::exists(public_path('uploads\USER_IMAGE' . '_' . $request->user_id . '.' . 'jpg')) || File::exists(public_path('uploads\USER_IMAGE' . '_' . $request->user_id . '.' . 'jpeg')) || File::exists(public_path('uploads\USER_IMAGE' . '_' . $request->user_id . '.' . 'gif')) ||  File::exists(public_path('uploads\USER_IMAGE' . '_' . $request->user_id . '.' . 'png'))) {
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $request->user_id . '.' . 'jpg'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $request->user_id . '.' . 'jpeg'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $request->user_id . '.' . 'gif'));
                    File::delete(public_path('uploads\USER_IMAGE' . '_' . $request->user_id . '.' . 'png'));
                }
                $imageName = 'USER_IMAGE' . '_' . $request->user_id . '.' . $request->image->getClientOriginalExtension();
                $path = 'uploads/';
                $request->image->move(public_path($path), $imageName);

                $updateUser["image"] = $path . $imageName;
            }

            $user = User::where("id", $request->user_id)->update($updateUser);

            if ($user) {
                return response()->json(['message' => "user updated successfully", 'status' => 1, 'data' => array(User::with(["education:id,name", "company:id,name"])->find($request->user_id))], $this->successStatus);
            } else {
                return response()->json(['message' => "failed to update user", 'status' => 1, 'data' => array(User::with(["education:id,name", "company:id,name"])->find($request->user_id))], $this->validationErrorStatus);
            }
        }
    }

    public function deleteUserApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'          =>     'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['messge' => $validator->errors()->all()[0], 'status' => 0, 'data' => array()], $this->validationErrorStatus);
        } else {
            $user = User::find($request->user_id)->delete();

            if ($user) {
                return response()->json(['message' => "user deleted successfully", 'status' => 1, 'data' => array()], $this->successStatus);
            } else {
                return response()->json(['message' => "failed to delete user", 'status' => 1, 'data' => array()], $this->validationErrorStatus);
            }
        }
    }
}

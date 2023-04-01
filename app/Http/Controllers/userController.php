<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\userResource;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return userResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Department $department)
    {

        $request->validate(
            [
                'depart_Id' => 'required|max:8|numeric|exists:departments,depart_Id',
                'gender' => 'required|max:6|alpha',
                'firstname' => 'required|max:70|alpha',
                'lastname' => 'required|max:70|alpha',
                'username' => 'required|max:70|regex:/^[a-zA-Z0-9]+$/u',
                'email' => 'required|max:255|email',
                'password' => 'required|max:70|regex:/^[a-zA-Z0-9@$!%*#?&]+$/u',
                'status' => 'required|max:50|regex:/^[a-zA-Z]+$/u',
                'image' => "required|max:5120"


            ],
            [
                'depart_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'depart_Id.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ໃຫ້ກາຍ 8',
                'depart_Id.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕເລກ',

                'gender.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'gender.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 6 ໂຕອັກສອນ',
                'gender.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',

                'firstname.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'firstname.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 70 ໂຕອັກສອນ',
                'firstname.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',

                'lastname.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'lastname.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 70 ໂຕອັກສອນ',
                'lastname.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',

                'username.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'username.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 70 ໂຕອັກສອນ',
                'username.regex' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື ແລະ ໂຕເລກ',

                'email.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'email.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 255 ໂຕອັກສອນ',
                'email.email' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນອີເມວ',

                'password.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'password.max' => 'ກະລຸນາປ້ອນລະຫັດບໍ່ກາຍ 50 ໂຕອັກສອນ',
                'password.regex' => 'ກະລຸນາປ້ອນລະຫັດເປັນໂຕໜັງສື, ໂຕເລກ ແລະ ສັນຍາລັກພິເສດ',

                'status.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'status.max' => 'ກະລຸນາປ້ອນລະຫັດບໍ່ກາຍ 50 ໂຕອັກສອນ',
                'status.regex' => 'ກະລຸນາປ້ອນລະຫັດເປັນໂຕໜັງສື',

                'image.required' => 'ກະລຸນາໃສ່ຮູບ',
                'image.max' => 'ຮູບຂະໜາດໃຫຍ່ເກີນໄປ'

            ]
        );
        $user = new User();
        $user->depart_Id = $request->depart_Id;
        $user->gender = $request->gender;

        $imageName = time().'.'.$request->image->extension();
        $user->image = $request->image->storeAs('public/images', $imageName);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->save();
        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'data' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'data' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'depart_Id' => 'required|max:8|numeric|exists:departments,depart_Id',
                'gender' => 'required|max:6|alpha',
                'firstname' => 'required|max:70|alpha',
                'lastname' => 'required|max:70|alpha',
                'username' => 'required|max:70|regex:/^[a-zA-Z0-9]+$/u',
                'email' => 'required|max:255|email',
                'password' => 'required|max:70|regex:/^[a-zA-Z0-9@$!%*#?&]+$/u',
                'status' => 'required|max:50|regex:/^[a-zA-Z]+$/u',
                'image' => "required|max:5120"

            ],
            [
                'depart_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'depart_Id.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ໃຫ້ກາຍ 8',
                'depart_Id.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕເລກ',

                'gender.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'gender.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 6 ໂຕອັກສອນ',
                'gender.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',

                'firstname.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'firstname.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 70 ໂຕອັກສອນ',
                'firstname.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',

                'lastname.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'lastname.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 70 ໂຕອັກສອນ',
                'lastname.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',

                'username.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'username.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 70 ໂຕອັກສອນ',
                'username.regex' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື ແລະ ໂຕເລກ',

                'email.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'email.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 255 ໂຕອັກສອນ',
                'email.email' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນອີເມວ',

                'password.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'password.max' => 'ກະລຸນາປ້ອນລະຫັດບໍ່ກາຍ 50 ໂຕອັກສອນ',
                'password.regex' => 'ກະລຸນາປ້ອນລະຫັດເປັນໂຕໜັງສື, ໂຕເລກ ແລະ ສັນຍາລັກພິເສດ',

                'status.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'status.max' => 'ກະລຸນາປ້ອນລະຫັດບໍ່ກາຍ 50 ໂຕອັກສອນ',
                'status.regex' => 'ກະລຸນາປ້ອນລະຫັດເປັນໂຕໜັງສື',

                'image.required' => 'ກະລຸນາໃສ່ຮູບ',
                'image.max' => 'ຮູບຂະໜາດໃຫຍ່ເກີນໄປ'
            ]
        );

        

        $user->depart_Id = $request->depart_Id;
        $user->gender = $request->gender;
        $imageName = time().'.'.$request->image->extension();
        $user->image = $request->image->storeAs('public/images', $imageName);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->save();
        return response()->json([
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(
            [
                'message' => 'ລຶບຂໍ້ມູນສຳເລັດ'
            ]
        );
    }
}

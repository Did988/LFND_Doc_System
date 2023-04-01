<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class AuthenController extends Controller
{
    public function authenticate(Request $request)
    {
        //dd($request->email,$request->password);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'ປ້ອນຊື່ຜູ້ໃຊ້ກ່ອນ!',
            'password.required' => 'ປ້ອນລະຫັດຜ່ານກ່ອນ!',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {

            //dd($user->password,$request->password);
            if (Hash::check($request->password, $user->password)) {
                $id = $user->user_Id;
                $username = $user->username;
                $name = $user->firstname." ".$user->lastname;
                $password = $user->password;
                $status = $user->status;
                $imagename = $user->image;
                session()->put('id', $id);
                session()->put('name', $name);
                session()->put('username',$username);
                session()->put('password', $password);
                session()->put('status', $status);
                session()->put('image', $imagename);

                $value = session()->all();

                return response()->json([
                    'message' => 'ເຂົ້າລະບົບສຳເລັດ',
                    'value' => $value,
                ]);
            } else {
                return response()->json([
                    'message' => 'ອີເມວ ແລະ ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'ບໍ່ສາມາດຊອກຫາບັນຊີຂອງທ່ານໄດ້ໃນລະບົບ'
            ]);
        }
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ], [
            'oldpassword.required' => 'ປ້ອນລະຫັດຜ່ານໃໝ່',
            'newpassword.required' => 'ປ້ອນລະຫັດຜ່ານໃໝ່',
        ]);

        $changepassword = User::where('user_Id', $request->user_Id)->first();
        //dd($request->oldpassword,$changepassword->password);
        if (Hash::check($request->oldpassword, $changepassword->password)) {
            $changepassword->password = Hash::make($request->newpassword);
            $changepassword->save();
            return response()->json([
                'message' => 'ປ່ຽນລະຫັດຜ່ານສຳເລັດ'
            ]);
        } else {
            return response()->json([
                'message' => 'ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ'
            ]);
           
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return response()->json([
            'message' => 'ທ່ານອອກຈາກລະບົບສຳເລັດ'
        ]);
       
    }
}

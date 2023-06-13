<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\userResource;
use Illuminate\Support\Facades\File;
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
    public function update(Request $request, $userId)
    {
      

        $user = User::find($userId);

      

        $user->depart_Id = $request->depart_Id;
        $user->gender = $request->gender;
        
        if ($request->hasFile('image')) {

            $destination = 'storage/images/' . $user->image;
            
            // dd($destination);
            if (File::exists($destination)) {

                File::delete($destination);
            }

            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $filename);
            $user->image = $filename;
        }

        


        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
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

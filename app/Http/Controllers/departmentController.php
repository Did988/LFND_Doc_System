<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\departmentResource;

class departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('departments')
        ->selectRaw('depart_Id,department_Name')
        ->get();

        return response($data);
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'department_Name' => 'required|max:70|alpha_dash',
            ],
            [
                'department_Name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'department_Name.max' => 'ຊື່ຍາວເກີນໄປ',
                
                'department_Name.alpha_dash' => 'ຊື່ກົມຄວນເປັນຕົວໜັງສື'
            ]
        );
        $department = new Department;
        $department->department_Name = $request->department_Name;
        $department->save();
        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */

    public function show(Department $department)
    {
        return response()->json($department);
    }

    public function update(Request $request, Department $department)
    {
        $request->validate(
            [
                'department_Name' => 'required|max:70|unique:departments|alpha_dash',
            ],
            [
                'department_Name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'department_Name.max' => 'ຊື່ຍາວເກີນໄປ',
                'department_Name.unique' => 'ກົມນີ້ມີໃນລະບົບແລ້ວ',
                'department_Name.alpha_dash' => 'ຊື່ກົມຄວນເປັນຕົວໜັງສື'
            ]
        );

        $department->department_Name = $request->department_Name;


        $department->save();
        return response()->json([
            'message' => "ອັບເດຂໍ້ມູນສຳເລັດ",
            'data' => $department
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json([
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ'
        ]);
    }
}

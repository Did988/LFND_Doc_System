<?php

namespace App\Http\Controllers;

use App\Http\Resources\document_CategoryResource;
use App\Models\Document_Category;
use Illuminate\Http\Request;

class document_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return document_CategoryResource::collection(Document_Category::all());
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
                'category_Name' => 'required|unique:document__categories|max:70|alpha',
            ],
            [
                'category_Name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'category_Name.max' => 'ຊື່ຍາວເກີນໄປ',
                'category_Name.unique' => 'ປະເພດເອກະສານນີ້ມີໃນລະບົບແລ້ວ',
                'category_Name.alpha' => 'ຊື່ປະເພດເອກະສານຄວນເປັນຕົວໜັງສື'
            ]
        );

        $document_Category = new Document_Category;

        $document_Category->category_Name = $request->category_Name;

        $document_Category->save();
        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'data' => $document_Category,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document_Category  $document_Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document_Category $document_Category)
    {

        $last_data = $request->category_Name;
        $request->validate(
            [
                'category_Name' => 'required|unique:document__categories|max:70|alpha',
            ],
            [
                'category_Name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'category_Name.max' => 'ຊື່ຍາວເກີນໄປ',
                'category_Name.unique' => 'ປະເພດເອກະສານນີ້ມີໃນລະບົບແລ້ວ',
                'category_Name.alpha' => 'ຊື່ປະເພດເອກະສານຄວນເປັນຕົວໜັງສື'
            ]
        );


        
        $new_Data = $document_Category->category_Name = $request->category_Name;

        $document_Category->save();
        return response()->json(
            [
                'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
                'newData' => $new_Data,
            ],
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document_Category  $document_Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document_Category $document_Category)
    {
        $document_Category->delete();
        return response()->json(
            ['message' => 'ລົບຂໍ້ມູນສຳເລັດ']
        );
    }
}

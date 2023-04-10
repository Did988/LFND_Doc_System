<?php

namespace App\Http\Controllers;

use App\Models\Doc_Inbound;
use Illuminate\Http\Request;
use App\Models\Document_Category;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\doc_inboundResource;

class doc_inboundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return doc_inboundResource::collection(Doc_Inbound::all());
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
                'doc_Id' => 'required|max:4',
                'title' => 'required|max:70|alpha',
                'date' => 'required|date',
                'from' => 'required|max:70|alpha',
                'send_to' => 'required|max:70|alpha',
                'file' => 'required|mimes:pdf',
                'doc_Category_Id' => 'required|exists:document__categories,doc_Category_Id|integer',
                'ex_doc_id' => 'required'
            ],
            [
                'doc_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'doc_Id.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',

                'title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'title.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'title.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',

                'date.required' =>  'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'date.date' => 'ຂໍ້ມູນວັນທີບໍ່ຖືກຕ້ອງ',

                'from.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'from.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'from.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',

                'send_to.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'send_to.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'send_to.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',

                'file.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'file.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'file.mimes' => 'ຊະນິດເອກະສານບໍ່ຖືກຕ້ອງ',

                'doc_Category_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'depart_Id.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ໃຫ້ກາຍ 8',
                'doc_Category_Id.integer' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕເລກ',
            ]
        );

        $doc_inbound = new Doc_Inbound();
        $doc_inbound->doc_id = $request->doc_Id;
        $doc_inbound->title = $request->title;
        $doc_inbound->date = $request->date;
        $doc_inbound->from = $request->from;
        $doc_inbound->send_to = $request->send_to;
        $file = $request->file('file')->store('docs');
        $doc_inbound->file = $file;
        $doc_inbound->doc_Category_Id = $request->doc_Category_Id;
        $doc_inbound->ex_doc_id = $request->ex_doc_id;
        $doc_inbound->save();

        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doc_Inbound  $doc_Inbound
     * @return \Illuminate\Http\Response
     */
    public function show(Doc_Inbound $doc_Inbound)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doc_Inbound  $doc_Inbound
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doc_Inbound $doc_Inbound)
    {
        $request->validate(
            [

                'title' => 'required|max:70|alpha',
                'date' => 'required|date',
                'from' => 'required|max:70|alpha',
                'send_to' => 'required|max:70|alpha',
                'file' => 'required|max:5120|mimes:pdf',
                'doc_Category_Id' => 'required|exists:document__categories,doc_Category_Id|integer'
            ],
            [


                'title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'title.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'title.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',

                'date.required' =>  'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'date.date' => 'ຂໍ້ມູນວັນທີບໍ່ຖືກຕ້ອງ',

                'from.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'from.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'from.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',

                'send_to.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'send_to.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'send_to.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',

                'file.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'file.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'file.mimes' => 'ຊະນິດເອກະສານບໍ່ຖືກຕ້ອງ',

                'doc_Category_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'depart_Id.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ໃຫ້ກາຍ 8',
                'doc_Category_Id.integer' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕເລກ',
            ]
        );



        $doc_Inbound->title = $request->title;
        $doc_Inbound->date = $request->date;
        $doc_Inbound->from = $request->from;
        $doc_Inbound->send_to = $request->send_to;


        
        $file = $request->file('file')->store('docs');
        

        $doc_Inbound->file = $request->file;
        $doc_Inbound->doc_Category_Id = $request->doc_Category_Id;

        $doc_Inbound->save();

        return response()->json([
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
        ]);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doc_Inbound  $doc_Inbound
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doc_Inbound $doc_Inbound)
    {
        $doc_Inbound->delete();

        return response()->json(
            [
                'message' => 'ລຶບຂໍ້ມູນສຳເລັດ'
            ]
        );
    }

    public function depart_doc($depart){
        

        
        $depart_doc = DB::table('doc__inbounds')
        ->where('send_to', $depart)
        ->get();

        
        return response()->json([
            'data' => $depart_doc
        ],200);
    }
}

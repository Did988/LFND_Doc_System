<?php

namespace App\Http\Controllers;

use App\Models\Doc_Inbound;
use Illuminate\Http\Request;
use App\Models\Document_Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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
        $doc_Value = DB::table('doc__inbounds as docIn')
        ->join('departments','departments.depart_Id','=','docIn.depart_Id')
        ->join('document__categories','document__categories.doc_Category_Id','=','docIn.doc_Category_Id')
        ->selectRaw("docIn.doc_Id,docIn.ex_doc_id,docIn.title,docIn.date,docIn.from,docIn.file,departments.department_Name,document__categories.category_Name")
        ->get();
        return response()->json([
            'data' => $doc_Value
        ]);
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
                
                'title' => 'required',
                'date' => 'required|date',
                'from' => 'required',
                'depart_Id' => 'required',
                'file' => 'required',
                'doc_Category_Id' => 'required',
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

                'depart_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'depart_Id.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'depart_Id.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',

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
        $doc_inbound->depart_Id = $request->depart_Id;

        $filename = time() . '.' . $request->file->extension();
        $request->file->storeAs('public/doc_inbound', $filename);
        $doc_inbound->file = $filename;




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
    public function show($doc_Inbound)
    {
       

        $doc_Value = DB::table('doc__inbounds as docIn')
        ->join('departments','departments.depart_Id','=','docIn.depart_Id')
        ->join('document__categories','document__categories.doc_Category_Id','=','docIn.doc_Category_Id')
        ->selectRaw("docIn.doc_Id,docIn.ex_doc_id,docIn.title,docIn.date,docIn.from,docIn.file,departments.department_Name,document__categories.category_Name")
        ->where('docIn.doc_Id','=',$doc_Inbound)
        ->get();
        return response()->json([
            'data' => $doc_Value
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doc_Inbound  $doc_Inbound
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $doc_Inbound)
    {      
        $doc_Inbounds = Doc_Inbound::find($doc_Inbound);
        if ($request->hasFile('file')) {

            $destination = 'storage/doc_inbound/' . $doc_Inbounds->file;
            
            // dd($destination);
            if (File::exists($destination)) {

                File::delete($destination);
            }

            $filename = time() . '.' . $request->file->extension();
            $request->file->storeAs('public/doc_inbound', $filename);
            $doc_Inbounds->file = $filename;
        }





        $doc_Inbounds->title = $request->title;
        $doc_Inbounds->date = $request->date;
        $doc_Inbounds->from = $request->from;
        $doc_Inbounds->depart_Id = $request->depart_Id;
        $doc_Inbounds->doc_Category_Id = $request->doc_Category_Id;

        $doc_Inbounds->update();

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

    public function depart_doc($depart)
    {

        $doc_Value = DB::table('doc__inbounds as docIn')
        ->join('departments','departments.depart_Id','=','docIn.depart_Id')
        ->join('document__categories','document__categories.doc_Category_Id','=','docIn.doc_Category_Id')
        ->selectRaw("docIn.doc_Id,docIn.ex_doc_id,docIn.title,docIn.date,docIn.from,docIn.file,departments.department_Name,document__categories.category_Name")
        ->where('departments.department_Name', $depart)
        ->get();



        return response()->json([
            'data' => $doc_Value
        ], 200);
    }

    public function getFilePath($fileName){
        // $file = DB::table('doc__inbounds as docIn')
        // ->selectRaw('docIn.file')
        // ->where('docIn.doc_Id','=',$doc_Id)
        // ->get();
        $url = storage_path('storage/doc_inbound/1682178421.pdf');
        
        return response()->json([
            'message' => 'ດຶງໄຟສຳເລັດ',
            'url'   => $url,
        ]);
    }

    public function viewPdf($docId){
       $doc_file = DB::table('doc__inbounds')
       ->selectRaw('doc__inbounds.file')
       ->where('doc__inbounds.doc_Id','=',$docId)
       ->get();
      
        // return view('docInbound.viewDocin',compact('doc_file'));
        
        $path = public_path("/storage/doc_inbound/").$doc_file[0]->file;

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
    
        ]);
    }
}

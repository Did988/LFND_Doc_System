<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doc_Inbound;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Inbound_to_Department;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\inbound_to_departResource;

class inbound_to_departController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inbound_to_departResource::collection(Inbound_to_Department::all());
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
               'doc_Id' =>'required',
                'dear' => 'required',
                'date' => 'required',
                'title' => 'required',
                
                
                
            ],
           
        );

        $ITD = new Inbound_to_Department();
        $ITD->dear = $request->dear;
        $ITD->date = $request->date;
        $ITD->doc_Id = $request->doc_Id;
        $ITD->title = $request->title;
        $ITD->save();

        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'data' => $ITD
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inbound_to_Department  $inbound_to_Department
     * @return \Illuminate\Http\Response
     */
    public function show(Inbound_to_Department $inbound_to_Department)
    {
       
        return response()->json([
            'data' => $inbound_to_Department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inbound_to_Department  $inbound_to_Department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbound_to_Department $inbound_to_Department)
    {
        $request->validate(
            [
                'form_name' => 'required|max:70|alpha',
                'send_to' => 'required|max:255',
                'title' => 'required|max:255|alpha',
                'comment' => 'required'
            ],
            [
                'form_name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'form_name.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 70 ໂຕອັກສອນ',
                'form_name.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',
                'send_to.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'send_to.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 255 ໂຕອັກສອນ',
                'send_to.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',
                'title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'title.max' => 'ກະລຸນາປ້ອນຂໍ້ມູນບໍ່ກາຍ 255 ໂຕອັກສອນ',
                'title.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື',
                'comment.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'comment.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນໂຕໜັງສື'
            ]
        );

        $inbound_to_Department->form_name = $request->form_name;
        $inbound_to_Department->send_to = $request->send_to;
        $inbound_to_Department->title = $request->title;
        $inbound_to_Department->comment = $request->comment;
        $inbound_to_Department->save();

        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'data' => $inbound_to_Department
        ]);
    }


    public function insert_file(Request $request, Inbound_to_Department $inbound_to_Department){

       
        $request->validate(
            [
                'file' => 'required|max:5120|mimes:pdf'
            ],
            [
                'file.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບ',
                'file.max' => 'ຂໍ້ມູນຫຼາຍເກີນໄປ',
                'file.mimes' => 'ຊະນິດເອກະສານບໍ່ຖືກຕ້ອງ',
            ]
        );

        $file = $request->file('file')->store('docs/itd');
        $inbound_to_Department->file = $request->file;
        $inbound_to_Department->save();

        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'data' => $inbound_to_Department
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inbound_to_Department  $inbound_to_Department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inbound_to_Department $inbound_to_Department)
    {
        $inbound_to_Department->delete();
        return response()->json(
            [
                'message' => 'ລຶບຂໍ້ມູນສຳເລັດ'
            ]
        );
    }

    public function makeForm($docInId){

        $data = DB::table('inbound_to__departments as folDoc')
        ->where('folDoc.doc_Id','=',$docInId)->get();
        $info = $data;
        
        // dd($info);
        $path = base_path('laoLogo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);
// dd($info);
        $pdf = Pdf::setOption(['isHtml5ParserEnabled' => true, 'isRemoteEnable' => true, 'fontHeightRatio' => 0.7])->loadView('docInbound.followDocForm', compact('info','pic'));
        set_time_limit(300);


        return $pdf->stream();

    }

   
}

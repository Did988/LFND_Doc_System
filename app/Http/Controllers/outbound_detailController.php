<?php

namespace App\Http\Controllers;

use App\Models\refer;
use App\Models\Doc_Outbound;
use Illuminate\Http\Request;
use App\Models\Outbound_Detail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\outbound_detailResource;

class outbound_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return outbound_detailResource::collection(Outbound_Detail::all())->sortDesc();
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
                'user_id' => 'required|numeric',
                'send_to' => 'required|alpha|max:70',
                'doc_NO' => 'required|max:50',
                'doc_Quantity' => 'required|numeric',
                'note' => 'alpha',
                'purpose' => 'required',
            ],
            [
                'user_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'user_id.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວເລກ',
                'send_to.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'send_to.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',
                'send_to.max' => 'ຂໍ້ຄວາມຍາວເກີນໄປ',
                'title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'title.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',
                'title.max' => 'ຂໍ້ຄວາມຍາວເກີນໄປ',
                'doc_NO.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'doc_NO.max' => 'ຂໍ້ຄວາມຍາວເກີນໄປ',
                'doc_Title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'doc_Title.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',
                'doc_Title.max' => 'ຂໍ້ຄວາມຍາວເກີນໄປ',
                'doc_Quantity.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'doc_Quantity.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວເລກ',
                'note.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື'

            ]
        );

        $out_de = new Outbound_Detail();
        $out_de->user_id = $request->user_id;
        $out_de->send_to = $request->send_to;
        $out_de->doc_NO = $request->doc_NO;
        $out_de->doc_Quantity = $request->doc_Quantity;
        $out_de->note = $request->note;
        $out_de->purpose = $request->purpose;

        $out_de->save();

        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'value' => $out_de,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outbound_Detail  $outbound_Detail
     * @return \Illuminate\Http\Response
     */
    public function show(Outbound_Detail $outbound_Detail)
    {
        return response()->json($outbound_Detail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outbound_Detail  $outbound_Detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outbound_Detail $outbound_Detail)
    {
        $request->validate(
            [
                'user_id' => 'required|numeric',
                'send_to' => 'required|alpha|max:70',

                'doc_NO' => 'required|max:50',

                'doc_Quantity' => 'required|numeric',
                'note' => 'alpha',
                'purpose' => 'alpha',
            ],
            [
                'user_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'user_id.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວເລກ',
                'send_to.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'send_to.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',
                'send_to.max' => 'ຂໍ້ຄວາມຍາວເກີນໄປ',
                'title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'title.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',
                'title.max' => 'ຂໍ້ຄວາມຍາວເກີນໄປ',
                'doc_NO.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'doc_NO.max' => 'ຂໍ້ຄວາມຍາວເກີນໄປ',
                'doc_Title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'doc_Title.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື',
                'doc_Title.max' => 'ຂໍ້ຄວາມຍາວເກີນໄປ',
                'doc_Quantity.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
                'doc_Quantity.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວເລກ',
                'note.alpha' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວໜັງສື'

            ]
        );

        $outbound_Detail->user_id = $request->user_id;
        $outbound_Detail->send_to = $request->send_to;
        $outbound_Detail->doc_NO = $request->doc_NO;
        $outbound_Detail->doc_Quantity = $request->doc_Quantity;
        $outbound_Detail->note = $request->note;
        $outbound_Detail->purpose = $request->purpose;

        $outbound_Detail->save();

        return response()->json([
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outbound_Detail  $outbound_Detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outbound_Detail $outbound_Detail)
    {
        $outbound_Detail->delete();
        return response()->json([
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ'
        ]);
    }

    public function insert_file(Request $request, Outbound_Detail $outbound_Detail)
    {


        $request->validate([
            'file' => 'required|mimes:pdf'
        ]);


        $filename = time() . '.' . $request->file->extension();
        $outbound_Detail->file = $request->file->storeAs('public/outbound_details', $filename);
        $outbound_Detail->save();

        return response()->json([
            'message' => 'ເພີ່ມໄຟລ໌ສຳເລັດ',
            'file' => $outbound_Detail
        ]);
    }


    public function print_Out_De_form(Request $request)
    {



        // $request->validate([
        //     'user_Id' => 'required'
        // ]);

        $out_de = new Outbound_Detail();
        $out_de->user_Id = $request->user_Id;
        $out_de->save();

        // $check_id = outbound_detailResource::collection(Outbound_Detail::all())->last()->outbound_Detail_Id;

        // session()->put('outbound_detail_id',$check_id+1);


        return response()->json([
            'message' => 'ສ້າງສະໂນດສະເລັດ',
            'data' => $out_de,
        ], 201);
    }

    public function delete_form(Outbound_Detail $outbound_Detail)
    {
        $outbound_Detail->delete();
        return response()->json([
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ'
        ]);
    }


    public function insert_Out_De_form(Request $request)
    {
        $request->validate([
            'user_Id' => 'required',
            'date' => 'required',
            'send_to' => 'required',
            'title' => 'required',

            //note
        ]);

        $out_de = new Outbound_Detail();
        $out_de->user_Id = $request->user_Id;
        $out_de->date = $request->date;
        $out_de->send_to = $request->send_to;
        $out_de->title = $request->title;

        $out_de->save();


        return response()->json([
            'message' => 'ສ້າງສະໂນດສະເລັດ',
            'data' => $out_de
        ]);
    }

    public function make_Out_De_form(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'user_Id' => 'required',
            'date' => 'required',
            'send_to' => 'required',
            'title' => 'required',
        ]);

        $out_de = new Outbound_Detail();
        $out_de->user_Id = $data['user_Id'];
        $out_de->date = $data['date'];
        $out_de->send_to = $data['send_to'];
        $out_de->title = $data['title'];
        $out_de->save();




        foreach ($data['refer'] as $key => $refers) {
            $refer = new refer;
            $refer->detail = $refers['detail'];
            $refer->outbound_Detail_Id = $out_de->outbound_Detail_Id;

            $refer->save();
        }


        foreach ($data['doc_out'] as $key => $doc_outs) {

            $doc_out = new Doc_Outbound;

            $doc_out->outbound_Detail_Id = $out_de->outbound_Detail_Id;

            $doc_out->title = $doc_outs['doc_title'];
            $doc_out->doc_C_Id = $doc_outs['doc_C_Id'];
            $doc_out->user_Id = $out_de->user_Id;
            $doc_out->date = $out_de->date;
            $doc_out->from = $doc_outs['from'];
            $doc_out->doc_quantity = $doc_outs['quantity'];
            $doc_out->doc_purpose = $doc_outs['purpose'];

            $doc_out->save();
        }

        return response()->json([
            'message' => 'ສ້າງໃບສະໂນດສຳເລັດ',
            'data' => $data
        ]);
    }
    public function ViewOutDetail($outDocId)
    {
        $outDocDetail = DB::table('outbound__details as outDe')
            ->where('outDe.outbound_Detail_Id', '=', $outDocId)
            ->selectRaw('outDe.*')
            ->get();

        $userId = $outDocDetail[0]->user_Id;


        $depart = DB::table('users')
            ->join('departments as depart', 'depart.depart_Id', '=', 'users.depart_Id')
            ->where('users.user_Id', '=', $userId)
            ->selectRaw('depart.department_Name')
            ->get();



        if ($depart[0]->department_Name == 'ຫ້ອງການ') {
            $sortDepart = 'ຫກ';
        } else if ($depart[0]->department_Name == 'ກົມກວດກາ') {
            $sortDepart = 'ກກ';
        } else if ($depart[0]->department_Name == 'ກົມຈັດຕັ້ງພະນັກງານ') {
            $sortDepart = 'ຈຕພນງ';
        } else if ($depart[0]->department_Name == 'ກົມສາສະໜາ') {
            $sortDepart = 'ສສໜ';
        } else if ($depart[0]->department_Name == 'ກົມຊັ້ນຄົນການຈັດຕັ້ງສັງຄົມ') {
            $sortDepart = 'ຊຄ';
        } else if ($depart[0]->department_Name == 'ກົມໂຄສະນາ') {
            $sortDepart = 'ຄສນ';
        } else if ($depart[0]->department_Name == 'ສູນຝຶກອົບຮົມ') {
            $sortDepart = 'ສຝອຮ';
        }




        $docOut = DB::table('doc__outbounds as docOut')
            ->selectRaw('docOut.doc_C_Id,docOut.title,docOut.doc_quantity,docOut.doc_purpose')
            ->where('docOut.outbound_Detail_Id', '=', $outDocId)
            ->get();


        // $pdf = Pdf::loadView('OutboundDetail.OutDetail', compact('docDe', 'outDocDetail', 'depart', 'sortDepart'));
        // return $pdf->download();
        // return view('OutboundDetail.OutDetail', compact('docDe', 'outDocDetail', 'depart', 'sortDepart'));
        $path = base_path('laoLogo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = Pdf::setOption(['isHtml5ParserEnabled' => true, 'isRemoteEnable' => true, 'fontHeightRatio' => 0.7])->loadView('OutboundDetail.OutDetail', compact('pic', 'docOut', 'outDocDetail', 'depart', 'sortDepart'));
        set_time_limit(300);


        return $pdf->stream();

        // return response()->json([
        //     'data' => [
        //         'logo' => $pic,
        //         'docOut' => $docOut,
        //         'outDocDetail' => $outDocDetail,
        //         'depart' => $depart,
        //         'sortDepart' => $sortDepart,

        //     ]
        //     ]);
    }
    public function testPdf($outDocId)
    {
        $outDocDetail = DB::table('outbound__details as outDe')
            ->where('outDe.outbound_Detail_Id', '=', $outDocId)
            ->selectRaw('outDe.*')
            ->get();

        $userId = $outDocDetail[0]->user_Id;


        $depart = DB::table('users')
            ->join('departments as depart', 'depart.depart_Id', '=', 'users.depart_Id')
            ->where('users.user_Id', '=', $userId)
            ->selectRaw('depart.department_Name')
            ->get();



        if ($depart[0]->department_Name == 'ຫ້ອງການ') {
            $sortDepart = 'ຫກ';
        } else if ($depart[0]->department_Name == 'ກົມກວດກາ') {
            $sortDepart = 'ກກ';
        } else if ($depart[0]->department_Name == 'ກົມຈັດຕັ້ງພະນັກງານ') {
            $sortDepart = 'ຈຕພນງ';
        } else if ($depart[0]->department_Name == 'ກົມສາສະໜາ') {
            $sortDepart = 'ສສໜ';
        } else if ($depart[0]->department_Name == 'ກົມຊັ້ນຄົນການຈັດຕັ້ງສັງຄົມ') {
            $sortDepart = 'ຊຄ';
        } else if ($depart[0]->department_Name == 'ກົມໂຄສະນາ') {
            $sortDepart = 'ຄສນ';
        } else if ($depart[0]->department_Name == 'ສູນຝຶກອົບຮົມ') {
            $sortDepart = 'ສຝອຮ';
        }




        $docOut = DB::table('doc__outbounds as docOut')
            ->selectRaw('docOut.doc_C_Id,docOut.title,docOut.doc_quantity,docOut.doc_purpose')
            ->where('docOut.outbound_Detail_Id', '=', $outDocId)
            ->get();


        // $pdf = Pdf::loadView('OutboundDetail.OutDetail', compact('docDe', 'outDocDetail', 'depart', 'sortDepart'));
        // return $pdf->download();
        // return view('OutboundDetail.OutDetail', compact('docDe', 'outDocDetail', 'depart', 'sortDepart'));
        $path = base_path('laoLogo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // $pdf = Pdf::setOption(['isHtml5ParserEnabled' => true, 'isRemoteEnable' => true,'dpi' => 150, 'defaultFont' => 'Phetsarath_OT'])->loadView('OutboundDetail.OutDetail', compact('pic','docOut', 'outDocDetail', 'depart', 'sortDepart'));
        // set_time_limit(300);
        // return $pdf->stream();

        return view('OutboundDetail.OutDetail', compact('pic','docOut', 'outDocDetail', 'depart', 'sortDepart'));
        // return response()->json([
        //     'data' => [
        //         'logo' => $pic,
        //         'docOut' => $docOut,
        //         'outDocDetail' => $outDocDetail,
        //         'depart' => $depart,
        //         'sortDepart' => $sortDepart,

        //     ]
        // ]);
    }
    

}

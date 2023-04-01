<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outbound_Detail;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\outbound_detailResource;
use App\Models\Doc_Outbound;
use App\Models\refer;

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
            'file' => 'required|max:5120|mimes:pdf'
        ]);


        $filename = time() . '.' . $request->file->extension();
        $outbound_Detail->file = $request->file->storeAs('public/doc_outbound', $filename);
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
}

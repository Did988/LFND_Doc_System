<?php

namespace App\Http\Controllers;

use App\Models\Doc_Outbound;
use Illuminate\Http\Request;
use App\Models\Outbound_Detail;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\doc_outboundResource;
use App\Http\Resources\outbound_detailResource;

class doc_outboundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('doc__outbounds')
        ->join('users','users.user_Id','=','doc__outbounds.user_Id')
        ->join('document__categories as docCate','docCate.doc_Category_Id','=','doc__outbounds.doc_Category_Id')
        ->selectRaw('doc__outbounds.*,users.firstname,users.lastname,users.gender as gender,docCate.category_Name')
        ->get();
        
        return response()->json([
            'data' => $data,
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
        $request->validate([
            'outbound_Detail_Id' => 'numeric',
            'title' => 'required|max:70',
            'doc_C_Id' => 'required',
            'date' => 'required',
            'from' => 'required|max:70',
            'send_to' => 'required|max:70',
            'user_id' => 'required|numeric|max:4',
            'doc_quantity' => 'required',
            'doc_purpose' => 'required',
        ], [
            'outbound_Detail_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'outbound_Detail_Id.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວເລກ',
            'title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'title.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'date.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'from.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'from.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'send_to.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'send_to.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'user_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'user_id.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
        ]);



        $doc_out = new Doc_Outbound();

        $doc_out->outbound_Detail_Id = $request->outbound_Detail_Id;

        $doc_out->title = $request->title;
        $doc_out->doc_C_Id = $request->doc_C_Id;

        $doc_out->date = $request->date;
        $doc_out->from = $request->from;
        $doc_out->send_to = $request->send_to;

        // $filename = time().'.'.$request->file->extension();
        // $doc_out->file = $request->file->storeAs('public/doc_outbound', $filename);

        $doc_out->user_id = $request->user_id;
        $doc_out->doc_quantity = $request->doc_quantity;
        $doc_out->doc_purpose = $request->doc_purpose;
        //dd($doc_out);
        $doc_out->save();

        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'value' => $doc_out,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doc_Outbound  $doc_Outbound
     * @return \Illuminate\Http\Response
     */
    public function show(Doc_Outbound $doc_Outbound)
    {
        return response()->json($doc_Outbound);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doc_Outbound  $doc_Outbound
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doc_Outbound $doc_Outbound)
    {
        $request->validate([
            'outbound_Detail_Id' => 'required|numeric',
            'title' => 'required|max:70',
            'date' => 'required',
            'from' => 'required|max:70',
            'send_to' => 'required|max:70',
            'user_id' => 'required|numeric|max:4'
        ], [
            'outbound_Detail_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'outbound_Detail_Id.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວເລກ',
            'title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'title.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'date.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'from.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'from.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'send_to.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'send_to.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'user_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'user_id.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
        ]);




        $doc_Outbound->outbound_Detail_Id = $request->outbound_Detail_Id;

        $doc_Outbound->title = $request->title;
        $doc_Outbound->date = $request->date;
        $doc_Outbound->from = $request->from;
        $doc_Outbound->send_to = $request->send_to;

        // $filename = time().'.'.$request->file->extension();
        // $doc_out->file = $request->file->storeAs('public/doc_outbound', $filename);

        $doc_Outbound->user_id = $request->user_id;
        $doc_Outbound->save();

        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'value' => $doc_Outbound,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doc_Outbound  $doc_Outbound
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doc_Outbound $doc_Outbound)
    {
        $doc_Outbound->delete();
        return response()->json([
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ'
        ]);
    }

    public function make_out_doc(Request $request)
    {
        $request->validate([
            'outbound_Detail_Id' => 'numeric',
            'title' => 'required|max:70',
            'doc_C_Id' => 'required',
            'date' => 'required',
            'from' => 'required|max:70',
            'send_to' => 'required|max:70',
            'user_id' => 'required|numeric|max:4',
        ], [
            'outbound_Detail_Id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'outbound_Detail_Id.numeric' => 'ກະລຸນາປ້ອນຂໍ້ມູນເປັນຕົວເລກ',
            'title.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'title.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'date.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'from.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'from.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'send_to.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'send_to.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
            'user_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນ',
            'user_id.max' => 'ຂໍ້ມູນຍາວເກີນໄປ',
        ]);


        //$out_de_id = outbound_detailResource::collection(Outbound_Detail::all())->last()->outbound_Detail_Id;

        $out_de_id = $request->outbound_Detail_Id;


        $doc_out = new Doc_Outbound();

        $doc_out->outbound_Detail_Id = $out_de_id;
        $doc_out->title = $request->title;
        $doc_out->doc_C_Id = $request->doc_C_Id;

        $doc_out->date = $request->date;
        $doc_out->from = $request->from;
        $doc_out->send_to = $request->send_to;

        // $filename = time().'.'.$request->file->extension();
        // $doc_out->file = $request->file->storeAs('public/doc_outbound', $filename);

        $doc_out->user_id = $request->user_id;

        //dd($doc_out);
        $doc_out->save();

        return response()->json([
            'message' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ',
            'value' => $doc_out,
        ]);
    }

    public function insert_file(Request $request, Doc_Outbound $doc_Outbound)
    {
        $request->validate([
            'file' => 'required',
            'doc_Category_Id' => 'required',
        ]);

        //dd($doc_outbound->doc_Id);

        $doc_Outbound->doc_Category_Id = $request->doc_Category_Id;
        $filename = time() . '.' . $request->file->extension();
        $doc_Outbound->file = $request->file->storeAs('public/doc_outbound', $filename);
        $doc_Outbound->save();
        return response()->json([
            'message' => 'ບັນທຶກໄຟລ໌ເອກະສານສຳເລັດ',
            'value' => $doc_Outbound,
        ]);
    }

    public function depart_out_doc($depart)
    {

        $depart_out_doc = DB::table('doc__outbounds')
            ->join('users','doc__outbounds.user_Id','=','users.user_Id')
            ->join('departments','users.depart_Id','=','departments.depart_Id')
            ->selectRaw("doc__outbounds.*,departments.department_Name")
            ->where('department_Name',$depart)
            ->get();

        return response()->json([
            'data' => $depart_out_doc
        ], 200);
    }

    public function show_by_out_de($outbound_Detail_Id){

        $data = DB::table('doc__outbounds')
        ->where('outbound_Detail_Id','=',$outbound_Detail_Id)
        ->get();

        return response()->json([
            'data' => $data
        ], 200);
    }
}

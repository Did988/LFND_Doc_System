<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function docSearch(Request $request)
    {

        $docType = $request->docType;
        $docId = $request->docId;

        if ($docType == "docInbound") {

            $doc_Value = DB::table('doc__inbounds as docIn')
                ->join('departments', 'departments.depart_Id', '=', 'docIn.depart_Id')
                ->join('document__categories', 'document__categories.doc_Category_Id', '=', 'docIn.doc_Category_Id')
                ->selectRaw("docIn.doc_Id,docIn.ex_doc_id,docIn.title,docIn.date,docIn.from,docIn.file,departments.department_Name,document__categories.category_Name")
                ->where('doc_Id', '=', $docId)
                ->orWhere('title', 'like', $docId)
                ->get();
            return response()->json([
                'data' => $doc_Value
            ]);
        } else if ($docType == "docOutbound") {
            $data = DB::table('doc__outbounds')
                ->join('users', 'users.user_Id', '=', 'doc__outbounds.user_Id')
                ->join('document__categories as docCate', 'docCate.doc_Category_Id', '=', 'doc__outbounds.doc_Category_Id')
                ->selectRaw('doc__outbounds.*,users.firstname,users.lastname,users.gender as gender,docCate.category_Name')
                ->where('doc_Id', '=', $docId)
                ->orWhere('title', 'like', $docId)
                ->get();

            return response()->json([
                'data' => $data,
            ]);
        } else if ($docType == "outDetail") {
        }
    }
}

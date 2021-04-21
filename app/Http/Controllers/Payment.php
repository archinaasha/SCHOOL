<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

class Payment extends Controller
{
	
	public function __construct()
	{
		$this->middleware('admin');
	}

	function addpayment_category(Request $req)
	{
		$data['student_id'] = $req->student_id;
		$data['category'] = trim($req->category);
		$data['amount'] = trim($req->amount);
		$data['created_by'] = session('id');


		$editId = $req->edit_id;

		if($editId == ""){
			

			$result = DB::table('payment')->insert($data);
			if($result){
				return response()->json(array("result" => "success", "message" => "Data saved successfully"));
			}else{
				return response()->json(array("result" => "error", "message" => "Something went wrong"));
			}

		}

	}

	function payment_categoryListDataTable(Request $request)
	{
		if ($request->ajax()) {
			$data = DB::table('payment')
			->select('payment.id','payment.student_id','payment.category','payment.amount')
			->where('payment.activation_status', 'active')
			->get();

			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){
				$btn = '<i title="Delete" data-id="'.$row->id.'"  class="deleteData fas fa-trash" style="font-size:18px;color:red" data-target="#deleteModal"></i> &emsp; ';				
				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
			return $data;
		} 
	}
	public function payment_categoryItemDelete(Request $req)
	{

		$ccObj = new CommonController();
		$tableName = 'payment';
		$columnName = 'id';
		$id = $req->id;

		$result = $ccObj->dataDeletion($tableName, $columnName, $id);

		if($result > 0){
			return response()->json(array("result" => "success", "message" => "Data deleted successfully"));

		}else{
			return response()->json(array("result" => "fail", "message" => "Something went wrong"));
		}

	}

	public function index()
	{
		return view('fees/payment');
	}
}
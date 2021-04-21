<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

class StudentsManag extends Controller
{

	function index(){
		return view('students_manag');
	}

	function addStudent(Request $req)
	{

		$data['student_id'] = $req->student_id;
		$data['fname'] = trim($req->fname);
		$data['lname'] = trim($req->lname);
		$data['gender'] = trim($req->gender);
		$data['date_of_birth'] = trim($req->date_of_birth);
		$data['address'] = trim($req->address );
		$data['sms'] = $req->sms;
		$data['session'] = trim($req->session);
		$data['class'] = trim($req->class);
		$data['s_group'] = trim($req->s_group);
		$data['section'] = trim($req->section);
		$data['roll'] = $req->roll;
		$data['created_by'] = session('id');


		$editId = $req->edit_id;

		if($editId == ""){
			$tc_count = DB::table('student')
			->count();
			$nubRow = $tc_count+1;
			if($nubRow < 10){
				$student_id=date('Y')."".date('m')."000".$nubRow;
			}
			elseif ($nubRow >= 10 && $nubRow <100 ) {
				$student_id=date('Y')."".date('m')."00".$nubRow;
			}
			elseif($nubRow >= 100 && $nubRow <1000){
				$student_id=date('Y')."".date('m')."0".$nubRow;
			}
			elseif($nubRow >= 1000){
				$student_id=date('Y')."".date('m')."".$nubRow;
			}

			//dd($student_id);

			$data['student_id']=$student_id;

			$result = DB::table('student')->insert($data);
			if($result){
				return response()->json(array("result" => "success", "message" => "Data saved successfully"));
			}else{
				return response()->json(array("result" => "error", "message" => "Something went wrong"));
			}

		}else{
			$data['updated_by'] = session('id');
			$result = DB::table('student')->where('id',$editId)->update($data);
			if($result){
				return response()->json(array("result" => "success", "message" => "Data updated successfully"));
			}else{
				return response()->json(array("result" => "error", "message" => "Something went wrong"));
			}
		}

	}

	
	function studentListDataTable(Request $request)
	{
		if ($request->ajax()) {
			$data = DB::table('student')
			->select('student.id','student.student_id','student.fname','student.lname','student.gender','student.date_of_birth','student.address','student.sms','student.session','student.class','student.s_group','student.section','student.roll')
			->where('student.activation_status', 'active')
			->get();

			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){
				$btn = '<i title="Delete" data-id="'.$row->id.'"  class="deleteData fas fa-trash" style="font-size:18px;color:red" data-target="#deleteModal"></i> &emsp; ';

				$btn = $btn.'<i title="Edit" data-id="'.$row->id.'"  class="editData fa fa-edit" style="font-size:18px;color:teal" data-target="#editModal"></i>';
				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
			return $data;
		} 
	}




	public function getStudentById($id)
	{
		$data = DB::table('student')
		->select('student.id','student.student_id','student.fname','student.lname','student.gender','student.date_of_birth','student.address','student.sms','student.session','student.class','student.s_group','student.section','student.roll')
		->where('student.id', $id)
		->where('student.activation_status', 'active')
		->limit(1)
		->get();
		echo json_encode($data);
	}



	public function studentItemDelete(Request $req)
	{

		$ccObj = new CommonController();
		$tableName = 'student';
		$columnName = 'id';
		$id = $req->id;

		$result = $ccObj->dataDeletion($tableName, $columnName, $id);

		if($result > 0){
			return response()->json(array("result" => "success", "message" => "Data deleted successfully"));

		}else{
			return response()->json(array("result" => "fail", "message" => "Something went wrong"));
		}

	}


}
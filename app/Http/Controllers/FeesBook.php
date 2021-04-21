<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

class FeesBook extends Controller
{
	
	public function __construct()
	{
		$this->middleware('admin');
	}

	public function getFeesBookById($id)
	{
		$returnArray = array();
		$student = DB::table('student')
		->select('id','student_id','fname','lname','gender','session','class','s_group','section')
		->where('student_id', $id)
		->where('activation_status', 'active')
		->limit(1)
		->get();
		//return $student;
		if(count($student)>0){
			$payment =DB::table('payment')
			->select('category','amount')
			->where('student_id',$id)
			->get();

			foreach ($student as $value) {
				$returnArray[] = array(
					'id'=>$value->id,
					'student_id'=>$value->student_id,
					'name'=>$value->fname." ".$value->lname,
					'gender'=>$value->gender,
					'session'=>$value->session,
					'class'=>$value->class,
					's_group'=>$value->s_group,
					'section'=>$value->section,
					'payment'=>$payment
				);
			}
		}

		echo json_encode($returnArray);
	}


	public function index()
	{
		return view('fees/fees_book');
	}
}
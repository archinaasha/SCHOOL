<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
	public function index()
	{
		return view('login');
	}

	public function loginCheck(Request $req)
	{
	

		$email = trim($req->email);
		$password = trim($req->password);

		if($email == "" || $password == ""){
			echo 'empty';
		}else{
			$password = md5($password);
			if(is_numeric($email)){
				$result = DB::table('users')
				->select('id','name','department')
				->where('phone', $email)
				->where('password', $password)
				->where('activation_status', 'active')
				->first();
			}else{
				$result = DB::table('users')
				->select('id','name','department')
				->where('email', $email)
				->where('password', $password)
				->where('activation_status', 'active')
				->first();
			}

			if($result){
				session()->put('id',$result->id);
				session()->put('name',$result->name);
				return response()->json(array("result" => "success", "id_dept" => $result->department));
			}else{
				return response()->json(array("result" => "fail"));
			}
		}
	}


	public function logout()
	{
		session()->flush();
		return redirect('/login');
	}

	public function frontendtestget($data)
	{
		echo "<pre>";
		print_r($data);
	}

	public function frontendtestpost(Request $req)
	{
		echo "<pre>";
		print_r($req->all());
	}
}

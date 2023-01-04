<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use Input;
use Redirect;
use Session;
use Alert;
use HelperData;

class LoginController extends Controller
{

	public function viewLogin()
	{
		if(!session('id_user')){
  			return view("application.login");
		}else{
      		return redirect()->route('viewDataParkir');
			// echo "Login Success";
		}
	}

	public function prosesLogin(Request $request)
	{
		$user = @$_GET['email'];
		$pass = @$_GET['pass'];

		$cekUsers = DB::table('users as u')
  			->join('role as rl','u.id_role','=','rl.id_role')
  			->where('u.email', $user)
  			->where('u.password', md5($pass))
  			// ->where('u.password', $pass)
  			   ->get();

		if(count($cekUsers) > 0) {
			foreach($cekUsers as $users)
			{
				session()->put('id_user',$users->id);
				session()->put('name',$users->nama);
				session()->put('role',$users->nama_role);
				$data = array("fullname" => $users->nama, "role"=>$users->nama_role);
				return response()->json($data);
			}
		} else {
			echo "Failed";
		}
	}

	public function prosesLogout()
	{

		if(session('id_user')) {
			session()->forget('id_user');
			session()->forget('name');
			session()->forget('role');
			return redirect('/');
		} else {
			echo 'Unkwon Session';
			return redirect('/');
		}
	}
}

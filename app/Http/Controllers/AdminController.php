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
use PDF;


class AdminController extends Controller
{
    public function viewUser()
    {
    	$viewPage = "application.admin.user.index";
		$page	= ["Home","Daftar User"];
		$data = DB::table('users as u')
			->join('role as rl','u.id_role','=','rl.id_role')
				->get();

		return view($viewPage,array(
			'pageNow' 	 	=> $page,
			'data' 	 		=> $data,
			'menuActive' 	=> "daftaruser"
		));
    }

    public function actionCUUser(Request $request, $id=null)
    {
    	$email 		= $request->txtEmail;
    	$password 	= md5($request->txtPassword);
    	$nama 		= $request->txtNama;
    	$id_role 	= $request->txtRole;

		$dataUpdate = [
			'email'=>$email,
			'password'=>$password,
			'nama'=>$nama,
			'id_role'=>$id_role,
			"createdDate"=>date("Y-m-d h:i:s")
		];

		$proses = DB::table('users');
		if($id){
			$proses->where('id',$id)
				->update($dataUpdate);		
		}else{
			$proses->insert($dataUpdate);
		}

		if($proses){
    		return redirect()->route('viewUser')->with('message', 'Successfully')->with('message_status', 'success');
		} else {
			return redirect()->back()->with('message', 'Failed')->with('message_status', 'failed');
		}
    }

    public function DeleteUser($id=null)
    {
    	$prosesDelete = DB::table('users')
    					->where('id',$id)
    						->delete();

    	if($prosesDelete){
    		return redirect()->back()->with('message', 'Successfully')->with('message_status', 'success');
		} else {
			return redirect()->back()->with('message', 'Failed')->with('message_status', 'failed');
		}
    }

    public function viewKendaraan()
    {
    	$viewPage = "application.admin.kendaraan.index";
		$page	= ["Home","Daftar Kendaraan"];
		$data = DB::table('kendaraan')->get();

		return view($viewPage,array(
			'pageNow' 	 	=> $page,
			'data' 	 		=> $data,
			'menuActive' 	=> "daftarkendaraan"
		));
    }

    public function actionCUKendaraan(Request $request, $id=null)
    {
    	$nama 		= $request->txtNama;
    	$biaya 	= $request->txtBiaya;

		$dataUpdate = [
			'jenis_kendaraan'=>$nama,
			'biaya'=>$biaya,
		];

		$proses = DB::table('kendaraan');
		if($id){
			$proses->where('id_kendaraan',$id)
				->update($dataUpdate);		
		}else{
			$proses->insert($dataUpdate);
		}

		if($proses){
    		return redirect()->back()->with('message', 'Successfully')->with('message_status', 'success');
		} else {
			return redirect()->back()->with('message', 'Failed')->with('message_status', 'failed');
		}
    }

    public function DeleteKendaraan($id=null)
    {
    	$prosesDelete = DB::table('kendaraan')
    					->where('id_kendaraan',$id)
    						->delete();

    	if($prosesDelete){
    		return redirect()->back()->with('message', 'Successfully')->with('message_status', 'success');
		} else {
			return redirect()->back()->with('message', 'Failed')->with('message_status', 'failed');
		}
    }

    public function viewDataParkir()
    {
    	$viewPage = "application.admin.parkir.index";
		$page	= ["Home","Data Parkir"];
		$data = DB::table('parkir as p')
				->leftjoin('kendaraan as k','p.id_kendaraan','=','k.id_kendaraan')
					->orderBy('tgl','asc')
						->get();

		$dataUser = DB::table('users as u')
					->join('role as rl','u.id_role','=','rl.id_role')
						->get();
		return view($viewPage,array(
			'pageNow' 	 	=> $page,
			'data' 	 		=> $data,
			'dataUser' 	 	=> $dataUser,
			'dtfrom' 	 	=> null,
			'dtto' 	 		=> null,
			'menuActive' 	=> "dataparkir"
		));
    }

    public function viewDataParkirDateRange()
	{

		$viewPage = "application.admin.parkir.index";
		$page	= ["Home","Data Parkir"];

		$date_from = $_GET['dtFrom'];
		$from = date("Y-m-d",strtotime($date_from));
		$date_to = $_GET['dtTo'];
		$to = date("Y-m-d",strtotime($date_to));
		$role = $_GET['role'];

		$data = DB::table('parkir as p')
				->join('kendaraan as k','p.id_kendaraan','=','k.id_kendaraan')
				 	->whereBetween('p.tgl', [$from, $to])
					 	->where('p.addedby',$role)
							->orderBy('tgl','asc')
								->get();

		$dataUser = DB::table('users as u')
					->join('role as rl','u.id_role','=','rl.id_role')
						->get();

		return view($viewPage,array(
			'pageNow' 	 	=> $page,
			'data' 	 		=> $data,
			'dataUser' 	 	=> $dataUser,
			'dtfrom' 	 	=> $from,
			'dtto' 	 		=> $to,
			'menuActive' 	=> "dataparkir"
		));
	}

	public function getDataParkir()
	{

		$date_from = $_GET['dtFrom'];
		$from = date("Y-m-d",strtotime($date_from));
		$date_to = $_GET['dtTo'];
		$to = date("Y-m-d",strtotime($date_to));
		$role = $_GET['role'];

		$data = DB::table('parkir as p')
				->join('kendaraan as k','p.id_kendaraan','=','k.id_kendaraan')
				 	->whereBetween('p.tgl', [$from, $to])
					 	->where('p.addedby',$role)
							->orderBy('tgl','asc')
								->get();

		$total = 0;					
		foreach ($data as $tmp) {
			// Code Here
			$total += $tmp->biaya;
		}						

		// return response()->json($data);
		$pdf = PDF ::loadview("application.admin.print", ['data' => $data, 'total'=> number_format($total,2,',','.'),'menuActive'=> "dataparkir"])->setpaper('A4','potrait');
		return $pdf->stream("Laporan_Parkir.pdf");
		// $viewPage = "application.admin.print";
		// return view($viewPage,array(
		// 	'data' 	 		=> $data,
		// 	'total' 	 	=> number_format($total,2,',','.'),
		// 	'menuActive' 	=> "dataparkir"
		// ));
		
	}

}

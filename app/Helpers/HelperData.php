<?php

use Illuminate\Support\Str;
use Carbon\Carbon;
/**
*
*/
class HelperData
{

	public static function testHelper()
	{
		$data = "hai, i'll help you";

		return $data;
	}

	public static function getDataUser($nik="",$get,$id="")
	{
		if ($get == "all") { #SALAH LOGIC ANYING AWKOAWKAOW
			
			$dataUser = DB::table("users as u")
			->join('role as rl','u.id_role','=','rl.id_role')
					->where("u.id",$nik)
						->get();
		} else {

			if ($get == "fullname")
				$get = 'nama';

			if ($get == 'rolename')
				$get = 'nama_role';

			$dataUser = DB::table("users as u")
			->join('role as rl','u.id_role','=','rl.id_role')
					->where("u.id",$nik)
						->first()->{$get};
		}
		$response = $dataUser;
		// foreach ($dataUser as $tmp) {
		// 	if ($get == "all") {
		// 		$response = $dataUser;
		// 	} else if ($get == "fullname") {
		// 		$response = $tmp->nama;
		// 	} else if ($get == "rolename") {
		// 		$response = $tmp->nama_role;
		// 	} else {
		// 		$response = "";
		// 	}
		// }
		return $response;
	}

	public static function getDay($language = 'IND',$date)
	{
		$d = date('D', strtotime($date));
		switch ($language) {
			case 'IND':
				switch ($d) {
					case 'Mon':
						$newDay = 'Senin';
						break;
					case 'Tue':
						$newDay = 'Selasa';
						break;
					case 'Wed':
						$newDay = 'Rabu';
						break;
					case 'Thu':
						$newDay = 'Kamis';
						break;
					case 'Fri':
						$newDay = 'Jumat';
						break;
					case 'Sat':
						$newDay = 'Sabtu';
						break;
					case 'Sun':
						$newDay = 'Minggu';
						break;

					default:
						break;
				}
				break;

			case 'ENG':
				switch ($d) {
					case 'Mon':
						$newDay = 'Monday';
						break;
					case 'Tue':
						$newDay = 'Tuesday';
						break;
					case 'Wed':
						$newDay = 'Wednesday';
						break;
					case 'Thu':
						$newDay = 'Thursday';
						break;
					case 'Fri':
						$newDay = 'Friday';
						break;
					case 'Sat':
						$newDay = 'Saturday';
						break;
					case 'Sun':
						$newDay = 'Sunday';
						break;

					default:
						break;
				}
				break;
			default:
				break;
		}
		return $newDay;
	}

	public static function getMonthName($language = 'IND',$date,$type="month")
	{
		$day = date('d',strtotime($date));
		$year = date('Y',strtotime($date));
		$newDate = date('M',strtotime($date));
		switch ($language) {
			case 'IND':
				switch ($newDate) {
					case 'Jan':
						$date = 'Januari';
						break;
					case 'Feb':
						$date = 'Februari';
						break;
					case 'Mar':
						$date = 'Maret';
						break;
					case 'Apr':
						$date = 'April';
						break;
					case 'May':
						$date = 'Mei';
						break;
					case 'Jun':
						$date = 'Juni';
						break;
					case 'Jul':
						$date = 'Juli';
						break;
					case 'Aug':
						$date = 'Agustus';
						break;
					case 'Sep':
						$date = 'September';
						break;
					case 'Oct':
						$date = 'Oktober';
						break;
					case 'Nov':
						$date = 'November';
						break;
					case 'Dec':
						$date = 'Desember';
						break;
					default:
						$date = 'Unknown';
						break;
				}
				break;
			case 'ENG':
				switch ($newDate) {
					case 'Jan':
						$date = 'January';
						break;
					case 'Feb':
						$date = 'February';
						break;
					case 'Mar':
						$date = 'March';
						break;
					case 'Apr':
						$date = 'April';
						break;
					case 'May':
						$date = 'May';
						break;
					case 'Jun':
						$date = 'June';
						break;
					case 'Jul':
						$date = 'July';
						break;
					case 'Aug':
						$date = 'August';
						break;
					case 'Sep':
						$date = 'September';
						break;
					case 'Oct':
						$date = 'October';
						break;
					case 'Nov':
						$date = 'November';
						break;
					case 'Dec':
						$date = 'December';
						break;
					default:
						$date = 'Unknown';
						break;
				}
				break;
			default:
				break;
		}
		if($type == 'full') {
			return $day.' '.$date.' '.$year;
		} else if($type == 'xday') {
				return $date.' '.$year;
		} else {
			return $date;
		}
	}

	public static function changeNumberToRoman($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
      foreach ($map as $roman => $int) {
        if($number >= $int) {
          $number -= $int;
          $returnValue .= $roman;
          break;
        }
      }
    }

    return $returnValue;
	}

	public static function geocodeFullAddress($address1,$address2,$id)
	{

		$API = array(
			'AIzaSyAOiVUskIMhtW0F-iuUdIZB5BlCcCv15L0',
			'AIzaSyARRoRCq1MhYM75binMUr1yrHL6dCMP1M4',
			'AIzaSyBxxg7GU970GNltY8nKbDBfHBwupPCxilw',
			'AIzaSyBOl44-_pE5C_iJqkG92-ZgvLG1qR-2s_8',
			'AIzaSyBoI_HtUeYAAD54BztKOcNCzBxMrjVuesI',
			'AIzaSyBVnrDPRsyvdQ5EDLGgxAHsoOKYKPWzxwQ',
			'AIzaSyACTKWr3kPIOnE0NvroZt4apoI-UC_jxYw',
			'AIzaSyD9tMCzv7Dwan8ALr_3fXLkEds1QR8zaOc',
			'AIzaSyDeaJmIyw2gnwRXTiFdVRIDXrpSp7x7WBY',
			'AIzaSyDtx1Uyl4wIx7NHywHiAcaD0_R853PAnPQ',
			'AIzaSyCHqPlwwWPm9u0imL0mx_np6ynPGKarNsE'
		);

		do {
			$address1 = urlencode($address1);
			$address2 = urlencode($address2);
		    // google map geocode api url
		    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=".$API[rand(0,count($API)-1)]."&address=".$address1.','.$address2.'&sensor=true';

		    // get the json response
		    $resp_json = file_get_contents($url);

		    // decode the json
		    $resp = json_decode($resp_json, true);

		    // response status will be 'OK', if able to geocode given address
		    if($resp['status']=='OK'){

		        // get the important data
		        $lati = $resp['results'][0]['geometry']['location']['lat'];
		        $longi = $resp['results'][0]['geometry']['location']['lng'];
		        $formatted_address = $resp['results'][0]['formatted_address'];

		        // verify if data is complete
		        if($lati && $longi && $formatted_address){
		     		$save = DB::table('t_message')
		     			->where('id',$id)
		     			->update([
		     				'alamat' => $formatted_address
		     			]);
		            return $formatted_address;

		        }else{
		            return false;
		        }

		    }else{
		        return false;
		    }

		}while ($resp['status'] != 'OK');
	}

	public static function geocodeAddress($address1,$address2,$id)
	{

     	$API = array(
			'AIzaSyAOiVUskIMhtW0F-iuUdIZB5BlCcCv15L0',
			'AIzaSyARRoRCq1MhYM75binMUr1yrHL6dCMP1M4',
			'AIzaSyBxxg7GU970GNltY8nKbDBfHBwupPCxilw',
			'AIzaSyBOl44-_pE5C_iJqkG92-ZgvLG1qR-2s_8',
			'AIzaSyBoI_HtUeYAAD54BztKOcNCzBxMrjVuesI',
			'AIzaSyBVnrDPRsyvdQ5EDLGgxAHsoOKYKPWzxwQ',
			'AIzaSyACTKWr3kPIOnE0NvroZt4apoI-UC_jxYw',
			'AIzaSyD9tMCzv7Dwan8ALr_3fXLkEds1QR8zaOc',
			'AIzaSyDeaJmIyw2gnwRXTiFdVRIDXrpSp7x7WBY',
			'AIzaSyDtx1Uyl4wIx7NHywHiAcaD0_R853PAnPQ',
			'AIzaSyCHqPlwwWPm9u0imL0mx_np6ynPGKarNsE'
		);

		do {
			$address1 = urlencode($address1);
			$address2 = urlencode($address2);
			    // google map geocode api url
			    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=".$API[rand(0,count($API)-1)]."&address=".$address1.','.$address2.'&sensor=true';

		    // get the json response
		    $resp_json = file_get_contents($url);

		    // decode the json
		    $resp = json_decode($resp_json, true);

		    // response status will be 'OK', if able to geocode given address
		    if($resp['status']=='OK'){

		        // get the important data
		        $lati = $resp['results'][0]['geometry']['location']['lat'];
		        $longi = $resp['results'][0]['geometry']['location']['lng'];
		        $formatted_address = $resp['results'][0]['formatted_address'];
		        $pieces = explode(",", $formatted_address);

		        // verify if data is complete
		        if($lati && $longi && $formatted_address){
		        	$save = DB::table('t_message')
		     			->where('id',$id)
		     			->update([
		     				'alamat_pendek' => $pieces[0]
		     			]);
		            return $formatted_address;

		        }else{
		            return false;
		        }

		    }else{
		        return false;
		    }
		}while ($resp['status'] != 'OK');
	}

	public static function geocode($address1,$address2)
	{

     	$API = array(
			'AIzaSyAOiVUskIMhtW0F-iuUdIZB5BlCcCv15L0',
			'AIzaSyARRoRCq1MhYM75binMUr1yrHL6dCMP1M4',
			'AIzaSyBxxg7GU970GNltY8nKbDBfHBwupPCxilw',
			'AIzaSyBOl44-_pE5C_iJqkG92-ZgvLG1qR-2s_8',
			'AIzaSyBoI_HtUeYAAD54BztKOcNCzBxMrjVuesI',
			'AIzaSyBVnrDPRsyvdQ5EDLGgxAHsoOKYKPWzxwQ',
			'AIzaSyACTKWr3kPIOnE0NvroZt4apoI-UC_jxYw',
			'AIzaSyD9tMCzv7Dwan8ALr_3fXLkEds1QR8zaOc',
			'AIzaSyDeaJmIyw2gnwRXTiFdVRIDXrpSp7x7WBY',
			'AIzaSyDtx1Uyl4wIx7NHywHiAcaD0_R853PAnPQ',
			'AIzaSyCHqPlwwWPm9u0imL0mx_np6ynPGKarNsE'
		);

		do {
			$address1 = urlencode($address1);
			$address2 = urlencode($address2);
			    // google map geocode api url
			    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=".$API[rand(0,count($API)-1)]."&address=".$address1.','.$address2.'&sensor=true';

		    // get the json response
		    $resp_json = file_get_contents($url);

		    // decode the json
		    $resp = json_decode($resp_json, true);

		    // response status will be 'OK', if able to geocode given address
		    if($resp['status']=='OK'){

		        // get the important data
		        $lati = $resp['results'][0]['geometry']['location']['lat'];
		        $longi = $resp['results'][0]['geometry']['location']['lng'];
		        $formatted_address = $resp['results'][0]['address_components'][1]['long_name'];

		        // verify if data is complete
		        if($lati && $longi && $formatted_address){

		            return $formatted_address;

		        }else{
		            return false;
		        }

		    }else{
		        return false;
		    }
		} while ($resp['status'] != 'OK');
	}

}
?>

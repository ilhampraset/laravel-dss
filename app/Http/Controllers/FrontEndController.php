<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\Sub_kriteria;
use DB;
use DataTables;
class FrontEndController extends Controller
{
    public function index() {

    	$kriteria = Kriteria::all();
    	$sub_kriteria = Sub_kriteria::all();
    	$profil = DB::table('profile')->get();
    	return view('user/perhitungan', compact('kriteria', 'sub_kriteria', 'profil'));

    }

    public function save(Request $r) {
 		$id = DB::table('profile')->insertGetId(
        	array('nama_lokasi' => $r->nama, 'user_id' => $r->user)
    	);

    	  $data = array();
        for($i=0; $i<count($r->nilai); $i++){
        	$ex = explode(' ', $r->nilai[$i]);
        	$id_sub_kriteria = $ex[0];
        	$id_kriteria = $ex[1];
            $a = array();
            $a['kriteria_id'] = $id_kriteria;
            $a['sub_kriteria_id']= $id_sub_kriteria;
            $a['profile_id']= $id;
            $data[] = $a ;

        }
     	
        DB::table('profile_detail')->insert($data);
      
       return response()->json(['message' => 'success']);

    }

    public function getProfile() {

    	$profile = DB::table('profile')->get();

    	return $profile;
    }



    public function getProfileDetail($id) {

    	
    	$profile_detail = DB::table('profile_detail')
       			->select('kriteria.nama AS kriteria', 'sub_kriteria.nama AS nama_sub_kriteria', 'sub_kriteria.nilai', 'profile_detail.profile_id')
                ->join('sub_kriteria', 'sub_kriteria.id', '=', 'profile_detail.sub_kriteria_id')
                ->join('kriteria', 'kriteria.id', '=', 'profile_detail.kriteria_id')
                ->where('profile_id', $id)
                ->get();

    	return $profile_detail;
    }

    public function getDataProfile() {
        
        $no = 1;
        $data = array();
        $i = 1; 
        foreach ($this->getProfile() as $p) {
        	$pd = $this->getProfileDetail($p->id);
        	$arr =  array();
        	$arr[] = $no++;
        	$arr[] = $p->nama_lokasi;
       		foreach ($pd as $key => $value) {
       			$arr[] = $pd[$key]->nama_sub_kriteria;
       		}
        	$arr[] = "<div align='center'>
            <button id='btn-ubah' type='button' onclick='edit(" .$p->id. ")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></button>
            <button id='btn-ubah' type='button' onclick='delete_merk(" .$p->id. ")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>
                    </div>";
        	$arr2 = array();
        
        
        	$data[] = $arr;
        }

    	
        return DataTables::of($data)->escapeColumns([])->make(true);

        
    }


}

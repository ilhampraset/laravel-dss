<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\Sub_kriteria;
use App\Profile;
use DB;
use DataTables;

class ProfileAcuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // private $profile;
    // public function __construct()
    // {
    //     $this->foo = new Profile();
    // }
    public function index()
    {
        $kriteria = Kriteria::all();
        $sub_kriteria = Sub_kriteria::all();
        //$profil =  $this->profile->all();

        return view('user/kriteria', compact('kriteria', 'sub_kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $r)
    {
        $id = DB::table('profile')->insertGetId(
            array('nama_coffeeshop' => $r->nama_coffeeshop,
                  'nama_lokasi' => $r->nama,
                  'user_id' => $r->user,
                  'status'=> $r->status)
        );

        $data = array();
        for ($i=0; $i<count($r->nilai); $i++) {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profil = Profile::where('id', $id)->get();

        /*  $kriteria = Kriteria::all();
          $sub_kriteria = Sub_kriteria::all();
          $profil = DB::table('profile')->get();
          */

        $detail = Profile::getProfileDetail($profil[0]->id);

        for ($i=0;$i<count($detail);$i++) {
            $nilai[] = $detail[$i]->id_sub_kriteria.' '.$detail[$i]->id_kriteria;
        }

        return response()->json(['id'=>$profil[0]->id,'nama_coffeeshop' =>$profil[0]->nama_coffeeshop,'nama_lokasi' =>$profil[0]->nama_lokasi,'nilai' => $nilai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $res = DB::table('profile')->where('id', $id)->get();

        // $id = DB::table('profile')->insertGetId(
        //     array('nama_coffeeshop' => $r->nama_coffeeshop, 'nama_lokasi' => $r->nama, 'user_id' => $r->user, 'status'=> $r->status)
        // );
        //

        DB::table('profile')->where('id', $id)->update(
            array('nama_coffeeshop' => $r->nama_coffeeshop, 'nama_lokasi' => $r->nama, 'user_id' => $r->user, 'status'=> $r->status)
        );
        $data = array();
        for ($i=0; $i<count($r->nilai); $i++) {
            $ex = explode(' ', $r->nilai[$i]);
            $id_sub_kriteria = $ex[0];
            $id_kriteria = $ex[1];

            $a = array();
            $a['kriteria_id'] = $id_kriteria;
            $a['sub_kriteria_id'] = $id_sub_kriteria;
            $data[] = $a ;
        }

        // echo count($data);

        for ($a=0;$a<count($data);$a++) {
            DB::table('profile_detail')->where('profile_id', $id)->where('kriteria_id', '=', $data[$a]['kriteria_id'])->update(['sub_kriteria_id' => $data[$a]['sub_kriteria_id'] ]);
        }


        // for ($a=0;$a<count($data);$a++) {
        //     DB::table('profile_detail')
        //   ->where('profile_id', $id)
        //   ->update(['sub_kriteria_id' => $data[$a]['sub_kriteria_id'], 'kriteria_id'=>$data[$a]['kriteria_id']]);
        // }
        //dd($data);
        //
        //$da = DB::table('profile_detail')->where('profile_id', $id)->get();
        //dd($da);
        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = DB::table('profile')->where('status', 'acuan')->where('id', $id)->delete();
        return response()->json(['message' => 'success']);
    }

    public function getDataProfileReference()
    {
        $no = 1;
        $data = array();
        $i = 1;
        foreach (Profile::profileStatus('acuan')->get() as $p) {
            $pd = Profile::getProfileDetail($p->id);
            $arr =  array();
            $arr[] = $no++;
            $arr[] = $p->nama_coffeeshop;
            $arr[] = $p->nama_lokasi;
            foreach ($pd as $key => $value) {
                $arr[] = $pd[$key]->nama_sub_kriteria.'('.$pd[$key]->nilai.')';
            }
            $arr[] = "<div align='center' class='btn-group'>
            <button id='btn-ubah' type='button' onclick='edit(" .$p->id. ")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></button>
            <button id='btn-ubah' type='button' onclick='delete_merk(" .$p->id. ")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>
                    </div>";
            $arr2 = array();


            $data[] = $arr;
        }


        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function getDataProfileReferenceDetail($id)
    {
        foreach (Profile::profileStatus('acuan')->where('id', $id)->get() as $p) {
            $pd = Profile::getProfileDetail($p->id);


            // $arr['nama_coffeeshop'] = $p->nama_coffeeshop;
            // $arr['nama_lokasi'] = $p->nama_lokasi;
            foreach ($pd as $key => $value) {
                $arr[$key]['label'] =  $pd[$key]->kriteria  ;
                $arr[$key]['desc'] = $pd[$key]->nama_sub_kriteria;
            }




            $data[] = $arr;
        }


        return response()->json($data[0]);
    }
}

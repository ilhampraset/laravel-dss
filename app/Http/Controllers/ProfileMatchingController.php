<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ProfileMatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profileAcuan = Profile::where('status', 'acuan')->get();

        return view('profile-matching.index', compact('profileAcuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ['nama_coffeeshop'=>$request->nama_coffeeshop, 'id_acuan'=> $request->acuan, 'user_id' => $request->user_id];

        \DB::table('profile_matching')->insert($data);
        return response()->json(['message' => 'success']);
    }

    public function storeDetail(Request $r)
    {
        $id = DB::table('profile')->insertGetId(
            array('nama_coffeeshop' => $r->nama_coffeeshop,
                'nama_lokasi' => $r->nama,
                'user_id' => $r->user,
                'status'=> $r->status,
                'profile_matching_id' => $r->profile_matching_id
              )
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
        $data = DB::table('profile_matching')->where('id', $id)->get();

        return response()->json($data[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ['nama_coffeeshop'=>$request->nama_coffeeshop, 'id_acuan'=> $request->acuan, 'user_id' => $request->user_id];

        \DB::table('profile_matching')->where('id', $id)->update($data);
        return response()->json(['message' => 'success']);
    }


    public function updateDetail(Request $r, $id)
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
        \DB::table('profile_matching')->where('id', $id)->delete();
        return response()->json(['message' => 'success']);
    }


    public function getDataProfileMatching()
    {
        $no = 1;
        $data = array();
        $i = 1;
        $pf = \DB::table('profile_matching as a')
        ->select('a.id', 'a.nama_coffeeshop as coffeeshop', 'b.nama_coffeeshop as acuan')
        ->join('profile as b', 'a.id_acuan', '=', 'b.id')
        ->where('b.status', 'acuan')
        ->where('a.user_id', Auth::user()->id)
        ->get();

        foreach ($pf as $p) {
            $arr =  array();
            $arr[] = $no++;
            $arr[] = $p->coffeeshop;
            $arr[] = $p->acuan;
            $arr[] = "<div align='center' class='btn-group'>
              <button id='btn-ubah' type='button' onclick='detail_profile(" .$p->id. ")' class='btn btn-success btn-xs'>detail</button>
          <button id='btn-ubah' type='button' onclick='edit(" .$p->id. ")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></button>
          <button id='btn-ubah' type='button' onclick='delete_merk(" .$p->id. ")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>
                  </div>";
            $arr2 = array();
            $data[] = $arr;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }
}

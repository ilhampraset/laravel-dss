<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\Sub_kriteria;
use DB;
use DataTables;
use Lib\ProfileMatching;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    //private $kriteria = array(5, 1, 2, 3);

    public function index()
    {
        $kriteria = Kriteria::all();
        $sub_kriteria = Sub_kriteria::all();
        $profil = DB::table('profile')->get();
        return view('user/perhitungan', compact('kriteria', 'sub_kriteria', 'profil'));
    }

    public function edit($id)
    {
        $profil = DB::table('profile')->where('id', $id)->get();

        /*  $kriteria = Kriteria::all();
          $sub_kriteria = Sub_kriteria::all();
          $profil = DB::table('profile')->get();
          */
        $detail = $this->getProfileDetail($profil[0]->id);

        for ($i=0;$i<count($detail);$i++) {
            $nilai[] = $detail[$i]->id_sub_kriteria.' '.$detail[$i]->id_kriteria;
        }

        return response()->json(['id'=>$profil[0]->id,'nama_coffeeshop' =>$profil[0]->nama_coffeeshop,'nama_lokasi' =>$profil[0]->nama_lokasi,'nilai' => $nilai]);
    }

    public function profileAcuan()
    {
        $kriteria = Kriteria::all();
        $sub_kriteria = Sub_kriteria::all();
        $profil = DB::table('profile')->get();

        return view('user/kriteria', compact('kriteria', 'sub_kriteria'));
    }



    public function perangkingan($id)
    {
        $kriteria = Kriteria::all();
        $sub_kriteria = Sub_kriteria::all();
        $profil = DB::table('profile')->get();
        $pf = \DB::table('profile_matching as a')
        ->select('a.id', 'a.nama_coffeeshop as coffeeshop', 'b.nama_coffeeshop as acuan')
        ->join('profile as b', 'a.id_acuan', '=', 'b.id')
        ->where('b.status', 'acuan')
        ->where('a.user_id', Auth::user()->id)
        ->where('a.id', $id)
        ->get();
        
        // $result = $this->resultprofilematching(\Request::segment(2));
        return view('user/perangkingan', compact('kriteria', 'sub_kriteria', 'pf'));
    }

    public function rankJson($id)
    {
        $kriteria = Kriteria::all();
        $sub_kriteria = Sub_kriteria::all();
        $profil = DB::table('profile')->get();
        $result = $this->resultprofilematching($id);
        return response()->json([$result]);
    }

    public function save(Request $r)
    {
        $id = DB::table('profile')->insertGetId(
            array('nama_coffeeshop' => $r->nama_coffeeshop, 'nama_lokasi' => $r->nama, 'user_id' => $r->user, 'status'=> $r->status)
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
            $a['profile_matching_id']= $r->profile_matching_id;
            $data[] = $a ;
        }

        DB::table('profile_detail')->insert($data);

        return response()->json(['message' => 'success']);
    }

    public function getProfile($id)
    {
        $profile = DB::table('profile')->where('status', 'diinginkan')
        ->where('profile_matching_id', $id)
        ->where('user_id', \Auth::user()->id)
        ->get();

        return $profile;
    }

    public function getProfileReference()
    {
        $profile = DB::table('profile')->where('status', 'acuan')->get();

        return $profile;
    }



    public function getProfileDetail($id)
    {
        $profile_detail = DB::table('profile_detail')
                   ->select('kriteria.nama AS kriteria', 'kriteria.faktor', 'sub_kriteria.nama AS nama_sub_kriteria', 'kriteria.id AS id_kriteria', 'sub_kriteria.id as id_sub_kriteria', 'sub_kriteria.nilai', 'profile_detail.profile_id')
                ->join('sub_kriteria', 'sub_kriteria.id', '=', 'profile_detail.sub_kriteria_id')
                ->join('kriteria', 'kriteria.id', '=', 'profile_detail.kriteria_id')
                ->where('profile_id', $id)
                ->get();

        return $profile_detail;
    }

    public function getDataProfile($id)
    {
        $no = 1;
        $data = array();
        $i = 1;
        $profile = DB::table('profile')->where('status', 'diinginkan')
        ->where('profile_matching_id', $id)
        ->where('user_id', Auth::user()->id)
        ->get();
        foreach ($profile as $p) {
            $pd = $this->getProfileDetail($p->id);
            $arr =  array();
            $arr[] = $no++;
            // $arr[] = $p->nama_coffeeshop;
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

    // public function getDataProfileReference()
    // {
    //     $no = 1;
    //     $data = array();
    //     $i = 1;
    //     foreach ($this->getProfileReference() as $p) {
    //         $pd = $this->getProfileDetail($p->id);
    //         $arr =  array();
    //         $arr[] = $no++;
    //         $arr[] = $p->nama_coffeeshop;
    //         $arr[] = $p->nama_lokasi;
    //         foreach ($pd as $key => $value) {
    //             $arr[] = $pd[$key]->nama_sub_kriteria.'('.$pd[$key]->nilai.')';
    //         }
    //         $arr[] = "<div align='center' class='btn-group'>
    //         <button id='btn-ubah' type='button' onclick='edit(" .$p->id. ")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></button>
    //         <button id='btn-ubah' type='button' onclick='delete_merk(" .$p->id. ")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>
    //                 </div>";
    //         $arr2 = array();
    //
    //
    //         $data[] = $arr;
    //     }
    //
    //
    //     return DataTables::of($data)->escapeColumns([])->make(true);
    // }

    private function getDataProfileReferenceValue()
    {
        $no = 1;
        $data = array();
        $i = 1;
        foreach ($this->getProfileReference() as $p) {
            $pd = $this->getProfileDetail($p->id);
            foreach ($pd as $key => $value) {
                $data[] = $pd[$key]->nilai;
            }
        }
        return $data;
    }

    protected function nilaiBobot($nilai)
    {
        if ($nilai == 0) {
            $n = 5;
        } elseif ($nilai == 1) {
            $n = 4.5;
        } elseif ($nilai == -1) {
            $n = 4;
        } elseif ($nilai == 2) {
            $n = 3.5;
        } elseif ($nilai == -2) {
            $n = 3;
        } elseif ($nilai == 3) {
            $n = 2.5;
        } elseif ($nilai == -3) {
            $n = 2;
        } elseif ($nilai == 4) {
            $n = 1.5;
        } elseif ($nilai == -4) {
            $n = 1;
        }


        return $n;
    }


    protected function getFactor($factor)
    {
        $factor = DB::table('kriteria')->where('faktor', $factor)->get();

        return $factor;
    }

    public function nilaiTotal($cf, $sf)
    {
        $total = (0.6 * $cf) + (0.4 * $sf);

        return $total;
    }

    public function resultProfileMatching($id)
    {
        $no = 1;
        $data= [];

        foreach ($this->getProfile($id) as $k => $p) {
            $cf = 0;
            $sf = 0;
            $pd = $this->getProfileDetail($p->id);
            $arr =  array();
            $arr[$p->nama_lokasi] = $p->nama_lokasi;
            $ao = array();

            foreach ($pd as $key => $value) {
                $factor = $pd[$key]->faktor;
                $nilai =  $pd[$key]->nilai - $this->getDataProfileReferenceValue()[$key];
                $n = $this->nilaiBobot($nilai);
                if ($factor == 'cf') {
                    $cf =  $cf + $n / count($this->getFactor('cf'))  ;
                } else {
                    $sf = $sf + $n / count($this->getFactor('sf'));
                }

                $total = $this->nilaiTotal($cf, $sf);
            }
            $data[$k]['label'] = $p->nama_lokasi;
            $data[$k]['nilai'] = $total;
        }
        // arsort($data);
        return  $data;
    }

    public function gapMapping()
    {
        $no = 1;
        $data = array();
        foreach ($this->getProfile() as $p) {
            $cf = 0;
            $sf = 0;
            $pd = $this->getProfileDetail($p->id);
            $arr =  array();
            $arr[] = $no++;
            $arr[] = $p->nama_lokasi;
            $ao = array();

            foreach ($pd as $key => $value) {
                $factor = $pd[$key]->factor;
                $nilai =  $pd[$key]->nilai - $this->kriteria[$key];
                $arr[] = $pd[$key]->nilai .' - '. $this->kriteria[$key].' = '.$nilai;
            }
            $data[] = $arr;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function coreFactor($nilai)
    {
        $sum = 0;

        for ($i=0; $i < count($nilai); $i++) {
            $sum = $sum + $nilai[$i];
        }

        return $sum;
    }

    public function secondaryFactor($n)
    {
        $cf =  $cf + $n / 2  ;
        return $cf;
    }
}

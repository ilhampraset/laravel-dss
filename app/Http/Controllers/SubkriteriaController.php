<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\Sub_kriteria;
use DataTables;
use Validator;
use DB;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listData()
    {
        //$sub_kriteria = Sub_kriteria::all();

        $sub_kriteria = DB::table('sub_kriteria')
                ->join('kriteria', 'sub_kriteria.id_kriteria', '=', 'kriteria.id')
                ->select('sub_kriteria.id AS subandkriteria1','sub_kriteria.nama AS subandkriteria','kriteria.id','kriteria.nama')
                ->get();

        
        $no = 1;
        $data = array();
        foreach($sub_kriteria as $list){
          
          $row = array();
        
         
          $row[] = $no++;
          $row[] = $list->subandkriteria;
          $row[] = $list->nama;
          
           $row[] = "<div align='center'>
            <button id='btn-ubah' type='button' onclick='edit(" .$list->subandkriteria1. ")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></button>
            <button id='btn-ubah' type='button' onclick='delete_merk(" .$list->subandkriteria1. ")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>
                    </div>";
          
          /*$row[] = "<div class='btn-group'>
                   <a onclick='editForm(".$list->id_supplier.")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>
                  <a onclick='deleteData(".$list->id_supplier.")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></div>";
          */
                  $data[] = $row;
        }
    
        return DataTables::of($data)->escapeColumns([])->make(true);
        //return response()->json($data);

    }

    public function index()
    {
        $sub_kriteria = Kriteria::all();

        return view('sub_kriteria.index', ['sub_kriteria'=>$sub_kriteria]);
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
        $validator = Validator::make($request->all(), [
           
            'nama' => 'required',
            'id_kriteria1'   => 'required',
        ],[
        
                
            
        ]);
         
           
        if ($validator->fails()) {
            return response()->json($validator->errors());
                  
            }else{
                $sub_kriteria = new Sub_kriteria();
                $sub_kriteria->nama          =   $request->nama;
                $sub_kriteria->id_kriteria   =   $request->id_kriteria1;
                $sub_kriteria->save();
                return response()->json(['message'=>'success']);  
            }
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
        $sub_kriteria = Sub_kriteria::find($id);
        
        return response()->json($sub_kriteria);
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
        $sub_kriteria = Sub_kriteria::find($id);
        
        $validator = Validator::make($request->all(), [
            'nama'           => 'required',
            'id_kriteria1'   => 'required',
        ],[
        
               
            
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
        else
        {
            $sub_kriteria->nama         = $request->nama;
            $sub_kriteria->id_kriteria  = $request->id_kriteria1;
            $sub_kriteria->update();
            return response()->json(['message'=>'success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_kriteria = Sub_kriteria::find($id);
        
        $sub_kriteria->delete();
        return response()->json(['message' => 'success']);
    }
}

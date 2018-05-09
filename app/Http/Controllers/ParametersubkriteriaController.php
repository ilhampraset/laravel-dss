<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parameter_sub_kriteria;
use App\Sub_kriteria;
use DataTables;
use Validator;
use DB;

class ParametersubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function listData()
    {
        //$sub_kriteria = Sub_kriteria::all();

        $parameter_sub_kriteria = DB::table('parameter_sub_kriteria')
                ->join('sub_kriteria', 'parameter_sub_kriteria.id_subkriteria', '=', 'sub_kriteria.id')
                ->select('parameter_sub_kriteria.id AS prmsubandkriteria1','parameter_sub_kriteria.nama_parameter AS prmsubandkriteria','parameter_sub_kriteria.nilai','sub_kriteria.id','sub_kriteria.nama','sub_kriteria.id_kriteria')
                ->orderBy('prmsubandkriteria1')
                ->get();

        
        $no = 1;
        $data = array();
        foreach($parameter_sub_kriteria as $list){
          
          $row = array();
        
          $row[] = $no++;
          $row[] = $list->prmsubandkriteria;
          $row[] = $list->nama;
          $row[] = $list->nilai;

        //   $row[] = "<div align='center'>
        //   <button id='btn-ubah' type='button' class='btn btn-warning btn-xs' data-subandkriteria='" . $list->subandkriteria . "'
        //   data-nama='" . $list->nama . "' data-id_kriteria='". $list->id ."'><i class='fa fa-edit'></i></button>
        //  <button id='btn-ubah' type='button' onclick='delete_merk(" .$list->subandkriteria1. ")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>
        // </div>";
          
          $row[] = "<div align='center'>
            <button id='btn-ubah' type='button' onclick='edit(" .$list->prmsubandkriteria1. ")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></button>
            <button id='btn-ubah' type='button' onclick='delete_merk(" .$list->prmsubandkriteria1. ")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>
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
        $parameter_sub_kriteria = Sub_kriteria::all();

        return view('parameter_sub_kriteria.index', ['parameter_sub_kriteria'=>$parameter_sub_kriteria]);
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
           
            'nama_parameter'    => 'required',
            'nilai'             => 'required',
            'id_subkriteria1'   => 'required',
        ],[
        
                
            
        ]);
         
           
        if ($validator->fails()) {
            return response()->json($validator->errors());
                  
            }else{
                $parameter_sub_kriteria = new Parameter_sub_kriteria();
                $parameter_sub_kriteria->nama_parameter =   $request->nama_parameter;
                $parameter_sub_kriteria->nilai          =   $request->nilai;
                $parameter_sub_kriteria->id_subkriteria =   $request->id_subkriteria1;
                $parameter_sub_kriteria->save();
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
        $parameter_sub_kriteria = Parameter_sub_kriteria::find($id);
        
        return response()->json($parameter_sub_kriteria);
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
        $parameter_sub_kriteria = Parameter_sub_kriteria::find($id);

        $validator = Validator::make($request->all(), [
           
            'nama_parameter'    =>  'required',
            'nilai'             =>  'required',
            'id_subkriteria1'   =>  'required',
        ],[
        
                
            
        ]);
         
           
        if ($validator->fails()) 
        {
            return response()->json($validator->errors());           
        }
        else
        {
            $parameter_sub_kriteria->nama_parameter =   $request->nama_parameter;
            $parameter_sub_kriteria->nilai          =   $request->nilai;
            $parameter_sub_kriteria->id_subkriteria =   $request->id_subkriteria1;
            $parameter_sub_kriteria->update();
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
        $parameter_sub_kriteria = Parameter_sub_kriteria::find($id);
        
        $parameter_sub_kriteria->delete();
        return response()->json(['message' => 'success']);
    }
}

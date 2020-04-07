<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Individu;
use DataTables;

use Validator;

class IndividuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listData()
    {
        $individu = Individu::all();


        $no = 0;
        $data = array();
        foreach ($individu as $list) {
            $row = array();


            $row[] = $no++;
            $row[] = $list->nama;

            $row[] = "<div align='center'>
          <button id='btn-ubah' type='button' onclick='edit(" .$list->id. ")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></button>
         <button id='btn-ubah' type='button' onclick='delete_merk(" .$list->id. ")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>
        </div>";

            /*$row[] = "<div class='btn-group'>
                     <a onclick='editForm(".$list->id_supplier.")' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>
                    <a onclick='deleteData(".$list->id_supplier.")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></div>";
            */
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
        //return response()->json($data[0]);
    }


    public function index()
    {
        return view('individu.index');
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

            'nama'=> 'required',
        ], [



        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $individu = new Individu();
            $individu->nama= $request->nama;
            $individu->save();
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
        $individu = Individu::find($id);

        return response()->json($individu);
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
        $individu = Individu::find($id);

        $validator = Validator::make($request->all(), [
            'nama'=> 'required',
        ], [



        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $individu->nama= $request->nama;
            $individu->update();
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
        $individu = Individu::find($id);

        $individu->delete();
        return response()->json(['message' => 'success']);
    }
}

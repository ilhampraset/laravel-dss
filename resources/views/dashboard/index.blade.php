@extends('layouts.dashboard')



@section('content')


 <div class="x_panel">
        <div class="x_title">
            <h2>
                <a href="">
                    <i class="fa fa-home"></i>
                </a>  
                <a href="">
                    Data Layanan
                </a>
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                    <li>
                       
                        <button type="button" id="btn-tambah" onclick='add()' class="btn btn-primary">Tambah</button>
                        
                    </li>
                   
                </ul>
                <div class="clearfix"></div>
        </div>
                <div class="x_content">
                    <table id="tabel-data" class="table table-bordered table-striped table-hover dataTable no-footer" role="grid" aria-describedby="tabel-data_info">
                        <thead>
                         <tr role="row">
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 303px;">Nama Layanan</th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Deskripsi Layanan</th>
                             <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 216px;">Action</th>
                         </tr>
                        </thead>
                </table>
              

                </div>
            </div>
                
@endsection



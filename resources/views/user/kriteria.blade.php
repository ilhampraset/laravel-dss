@extends('layouts.dashboard')

@section('css')

<style type="text/css">

    th {
        text-align: center;
    }

</style>

@endsection

@section('content')


<!-- <div class="x_panel">
     <h1 style="text-align: center;">Sistem Pendukung Keputusan Investasi Pendirian Coffee Shop</h1>
</div> -->

 <div class="x_panel">

        <div class="x_title">
            <h2>
                <a href="">
                    <i class="fa fa-home"></i>
                </a>
                 <a class="collapse-link">Data Profile Acuan</a>



            </h2>

            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <button type="button" id="btn-tambah" onclick='add()' class="btn btn-primary">Tambah Profile Coffee Shop</button>
                </li>

                <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
            </ul>


                <div class="clearfix"></div>
                </div>

                <div class="x_content">



                     <table id="tabel-data" class="table table-responsive table-bordered table-striped table-hover dataTable no-footer" role="grid" aria-describedby="tabel-data_info" style="text-align: center; width: 100%; overflow-x:auto;" >
                            <thead>
                             <tr role="row">
                                <th class="sorting_disabled" rowspan="1" colspan="1"  style="width: 100px;">No</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Nama Cofeeshop</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Alamat</th>
                                @foreach($kriteria as $kt)
                                     <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">{{$kt->nama}}</th>
                                @endforeach

                                <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 216px;">Action</th>
                             </tr>
                            </thead>


                    </table>

                </div>

                @include('user.modal-input-acuan')
        </div>


</div>
@endsection

@section('js')
<script src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script>


var table, save_method;

$(function(){


table = $('#tabel-data').DataTable({
     "processing" : true,
     "ajax" : {
       "url" : "{{ url('dataprofileacuan') }}",
       "type" : "GET"
     }
   });

table2 = $('#tabel2').DataTable({
     "processing" : true,
     "ajax" : {
       "url" : "{{ url('resultprofilematching') }}",
       "type" : "GET"
     }
   });

table2 = $('#tabel3').DataTable({
     "processing" : true,
     "ajax" : {
       "url" : "{{ url('gapmapping') }}",
       "type" : "GET"
     }
   });
/*table =  $('#table-data').DataTable();*/

    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

  $('#form-tambah').on('submit', function(e){
       if(!e.isDefaultPrevented()){

        var id = $('#id').val();

         if(save_method == "add") url = "{{url('profile-acuan')}}";
         else url = "profile-acuan/"+id;


         $.ajax({
            url : url,
            type : "POST",
            data : $('#form-tambah').serialize(),
            dataType: 'JSON',

           success : function(data){


               if((data.message)){

               $('body').css('padding-right','0');
                $('#modal-tambah').modal('hide');
                swal('Good job!','Berhasil Menyimpan Data','success');

                 table.ajax.reload();

               }
               else{


                        $.each( data, function( key, value ) {


                        $('[name="'+key+'"]').parent().parent().addClass('has-error');
                        $('[name="'+key+'"]').next().text(value);



                        });
                        swal('Oops...','Gagal Menyimpan!','error');
                    }
           }

         });
         return false;
     }
  });

});

function add()
{
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('.form-group').removeClass('has-error');
    $('#form-tambah')[0].reset();
    $('.help-block').empty();
    $('#modal-tambah').modal('show');
}

function edit(id){
   save_method = "edit";
   $('input[name=_method]').val('PATCH');
   $('.form-group').removeClass('has-error');
   $('.help-block').empty();
   $('#modal-tambah').modal('show');
   $('.modal-title').text('Edit Data');

   $.ajax({
     url : "profile-acuan/"+id+"/edit",
     type : "GET",
     dataType : "JSON",
     success : function(data){
       $('#id').val(data.id);
       $('#nama').val(data.nama_lokasi);
       $('#nama_coffeeshop').val(data.nama_coffeeshop);
       let len = $('select#nilai').length ;
       for(let i=0;i<len;i++){
         $('select#nilai').find(`option[value="${data.nilai[i]}"]`).prop('selected', true);
       }



     },
     error : function(){
       swal('Oops...','Gagal Menampilkan Data!','error');
     }
   });




}

function delete_merk(id)
{

    swal({
        title: 'Are you sure?',
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",

        })
        .then(result => {
    if (result.value) {

            $.ajax({
                url : "profile-acuan/"+id,
                type: "POST",
                data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                success: function(data)
                {
                    table.ajax.reload();
                    swal('Good job!','Berhasil Mengapus Data','success');


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal('Oops...','Gagal Menghapus Data!','error');
                }
            });
    }
});

}


</script>
@endsection

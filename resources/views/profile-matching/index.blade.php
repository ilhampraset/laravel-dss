@extends('layouts.dashboard')

@section('css')

<style type="text/css">

    th {
        text-align: center;
    }

</style>

@endsection

@section('content')


<div class="x_panel">

</div>

 <div class="x_panel">

        <div class="x_title">
            <h2>
                <a href="">
                    <i class="fa fa-home"></i>
                </a>
                 <a class="collapse-link">Profile Matching</a>



            </h2>

            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <button type="button" id="btn-tambah" onclick='add()' class="btn btn-primary">Tambah Profile Matching</button>
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

                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Nama Coffeeshop</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Nama Coffeeshop Acuan</th>

                                <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 216px;">Action</th>
                             </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>

                    </table>

                </div>

                @include('profile-matching.modal-profile')
        </div>


</div>
@endsection

@section('js')
<script src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script>


var table, save_method;

function appendForm(arr){
  let formdetail = `<div class="form-group" id="childDetail">
      <label class="col-md-4 col-sm-4 col-xs-12 control-label">${arr[0]}</label>
      <div class="col-md-8 col-sm-8 col-xs-12">
          <textarea class="form-control" readonly>${arr[1]}</textarea
      </div>
  </div>`;

  return formdetail
}
$(function(){


$('#acuan').on('change', ()=>{
  let id = $('#acuan').val()
  $('#detailvalue').empty();

  $.ajax({
    url : "profile-acuan/"+id+"/detail",
    type : "GET",
    dataType : "JSON",
    success : function(data){
      for(let i=0;i<data.length;i++){
          $('#detailvalue').append(appendForm([data[i].label, data[i].desc]));

      }





    },
    error : function(e){
      console.log(e)
      //swal('Oops...','Gagal Menampilkan Data!','error');
    }
  });
})

table = $('#tabel-data').DataTable({
     "processing" : true,
     "ajax" : {
       "url" : "{{ url('dataprofilematching') }}",
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

         if(save_method == "add") url = "{{url('/profile-matching')}}";
         else url = "/profile-matching/"+id;

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
    $('#detailvalue').empty();
    $('.help-block').empty();
    $('#modal-tambah').modal('show');
}
function detail_profile(id){
  let url = '{{url('profile-matching')}}'
  window.location.href = `${url}/${id}/detail`
}
function edit(id){
   save_method = "edit";
   let uri = "{{url('profile-matching')}}"
   $('input[name=_method]').val('PATCH');
   $('#detailvalue').empty();
   $('.form-group').removeClass('has-error');
   $('.help-block').empty();
   $.ajax({
     url : uri+"/"+id+"/edit",
     type : "GET",
     dataType : "JSON",
     success : function(data){
       $('#modal-tambah').modal('show');
       $('.modal-title').text('Edit Data');

       $('#id').val(data.id);
       $('#nama_coffeeshop').val(data.nama_coffeeshop);
       $('#acuan').find(`option[value="${data.id_acuan}"]`).prop('selected', true);

       $.ajax({
         url : "profile-acuan/"+data.id_acuan+"/detail",
         type : "GET",
         dataType : "JSON",
         success : function(data){
           for(let i=0;i<data.length;i++){
               $('#detailvalue').append(appendForm([data[i].label, data[i].desc]));
           }
         },
         error : function(e){
           console.log(e)
         }
       });

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
                url : "profile-matching/"+id,
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

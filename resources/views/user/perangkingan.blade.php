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
                   <i class="fa fa-home"></i> Coffeeshop {{$pf[0]->acuan}} Sebagai Acuan
               </a>
                <a class="collapse-link"></a>
           </h2>
           <ul class="nav navbar-right panel_toolbox">


               <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
           </ul>
           <div class="clearfix"></div>
           </div>

           <div class="x_content"></div>
          <div align="left"><h5>Kriteria Coffeeshop {{$pf[0]->acuan}} : </h5>
            <ul><li>dfdfdfd</li></ul>
          </div>
    </div>


 <div class="x_panel">

        <div class="x_title">
            <h2>
                <a href="">
                    <i class="fa fa-home"></i>
                </a>
                 <a class="collapse-link">Profile Coffeeshop {{$pf[0]->coffeeshop}}</a>



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

                            <th class="sorting_disabled" rowspan="1" colspan="1"  style="width: 100px;">Alamat</th>
                             @foreach($kriteria as $kt)
                                  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">{{$kt->nama}}</th>
                             @endforeach

                             <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 216px;">Action</th>
                          </tr>
                         </thead>
                         <tbody>
                             <tr>

                             </tr>
                         </tbody>

                 </table>





                </div>

                @include('user.modal-input')
        </div>



        <div class="x_panel">

               <div class="x_title">
                   <h2>
                       <a href="">
                           <i class="fa fa-home"></i>
                       </a>
                        <a class="collapse-link">Hasil</a>



                   </h2>
                   <ul class="nav navbar-right panel_toolbox">


                       <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                   </ul>
                   <div class="clearfix"></div>
                   </div>

                   <div class="x_content">
                     <div class="" role="tabpanel" data-example-id="togglable-tabs">
                          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                              <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Perangkingan</a>
                            </li>
                            <li role="presentation" class="">
                              <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Rekomendasi</a>
                            </li>

                          </ul>
                          <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                              <!-- start recent activity -->
                              <table  id="tables2" class="table table-responsive table-bordered table-striped table-hover dataTable no-footer" role="grid" aria-describedby="tabel-data_info" style="text-align: center; width: 100%; overflow-x:auto;" >
                                     <thead>
                                      <tr role="row">
                                         <th class="sorting_disabled" rowspan="1" colspan="1"  style="width: 100px;">No</th>
                                         <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Nama Lokasi</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Nilai Total</th>
                                      </tr>
                                     </thead>
                                     <tbody id="rank">

                                     </tbody>


                             </table>
                              <!-- end recent activity -->

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                              <!-- start user projects -->
                              <p id="rekomendation"></p>
                              <!-- end user projects -->

                            </div>

                          </div>
                        </div>
                   </div>
            </div>

</div>
@endsection

@section('js')
<script src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script>


var table, save_method;

$(function(){
loadRank()
  // $("a[href='#tab_content1']").on('shown.bs.tab', function(e) {
  //   loadRank()
  // });
  table = $('#tabel-data').DataTable({
       "processing" : true,
       "ajax" : {
         "url" : "{{ url('dataprofile') }}/{{\Request::segment(2)}}",
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

         if(save_method == "add") url = "{{url('/profile-detail')}}";
         else url = "/profile-detail/"+id;

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
                 loadRank()

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
    $('.modal-title').text('Tambah Data');
}

function loadRank()
{
  let url = {{\Request::segment(2)}}
  $('#tables2 > tbody').empty();
  $.ajax({
    url : "/rankJson/"+url,
    type : "GET",
    dataType : "JSON",
    success : function(data){
      let no = 1;
      data[0].sort(function (a, b) {
        return   b.nilai - a.nilai;
      });

       const max = data[0].filter( el => el.nilai === data[0][0].nilai )
       console.log(max)
       genRecomendationHTML(max)


      for (let i =0;i<data[0].length;i++) {

          $('#tables2 > tbody').append(`<tr><td>${no++}</td><td>${data[0][i].label}</td><td>${data[0][i].nilai}</td></tr>`);
        }
    },
    error : function(){
      swal('Oops...','Gagal Menampilkan Data!','error');
    }
  });
}


function genRecomendationHTML(data){
 let resultAboveOne = `Berdasarkan hasil dari perangkingan terdapat ${data.length} profile yang memiliki nilai sama yaitu profile dengan alamat:
 <ol id='list'><ol> `
 if(data.length > 1){
   $('#rekomendation').append(resultAboveOne);
 }
  for(let i=0;i<data.length;i++){
    if(data.length > 1){
      $('#list').append(`<li><b>${data[i].label}</b></li>`)
    }else{
        $('#rekomendation').append(`Berdasarkan hasil dari perangkingan, profile dengan alamat <b>${data[i].label} </b> mendapatkan nilai paling tinggi`)
    }

  }
}
function edit(id){
   save_method = "edit";
   $('input[name=_method]').val('PATCH');

   $('.form-group').removeClass('has-error');
   $('.help-block').empty();
   $.ajax({
     url : "/data-profile-diingikan/"+id+"/edit",
     type : "GET",
     dataType : "JSON",
     success : function(data){
       $('#modal-tambah').modal('show');
       $('.modal-title').text('Edit Data');

       $('#id').val(data.id);
       $('#nama').val(data.nama_lokasi);
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

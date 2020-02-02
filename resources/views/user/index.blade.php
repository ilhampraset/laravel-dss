@extends('layouts.dashboard')



@section('content')
<div class="x_panel">
     <h1 style="text-align: center;">Sistem Pendukung Keputusan Investasi Pendirian Coffee Shop</h1> 
</div>

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
              
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   
                </div>
        </div>

                
@endsection


@section('js')
<script src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script>


var table, save_method;
$(function(){
table = $('.table').DataTable({
     "processing" : true,
     "ajax" : {
       "url" : "{{ url('dataprofile') }}",
       "type" : "GET"
     },
     columns: [
        { data: 0 },
        { data: 1 },
        { data: 2 },
        { data: 3 },
        { data: 4 },
        { data: 5 }
    ]
   });

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

         if(save_method == "add") url = "{{url('/simpan')}}";
         else url = "kriteria/"+id;
         
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
   //$('#form-tambah')[0].reset();
   $('.form-group').removeClass('has-error');
   $('.help-block').empty();
   $.ajax({
     url : "kriteria/"+id+"/edit",
     type : "GET",
     dataType : "JSON",
     success : function(data){
       $('#modal-tambah').modal('show');
       $('.modal-title').text('Edit Data');
       
       $('#id').val(data.id);
       $('#nama').val(data.nama);
       
       
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
                url : "kriteria/"+id,
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


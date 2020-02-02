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
     <h1 style="text-align: center;">Sistem Pendukung Keputusan Investasi Pendirian Coffee Shop</h1> 
</div>

 <div class="x_panel">
   
        <div class="x_title">
            <h2>
                <a href="">
                    <i class="fa fa-home"></i>
                </a>  
                 <a class="collapse-link">Data Profile</a>

               

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
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Nama Lokasi</th>
                               <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 298px;">Nilai Total</th>
                             </tr>
                            </thead>
                            <tbody>
                                    <?php $no=0;?>
                                     @foreach($result as $key => $value )
                                    <tr>
                                    
                                        <td>{{++$no}}</td>
                                        <td>{{$key}}</td>
                                        <td>{{$value}}</td>
                                 
                                    </tr>
                                       @endforeach
                               
                            </tbody>

                           
                    </table>
                   <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                    <a href="#" data-original-title="">Download</a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                    <a href="#" data-original-title="">Download</a>
                                  </p>
                                </div>
                              </li>

                            </ul>
                            <!-- end recent activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Project Name</th>
                                  <th>Client Company</th>
                                  <th class="hidden-phone">Hours Spent</th>
                                  <th>Contribution</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>New Company Takeover Review</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">18</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>New Partner Contracts Consultanci</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">13</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Partners and Inverstors report</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">30</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>New Company Takeover Review</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">28</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk </p>
                          </div>
                        </div>
                      </div>
                </div>

                @include('user.modal-input')
        </div>

        
</div>          
@endsection

@section('js')
<script src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script>


var table, save_method;

$(function(){


table = $('').DataTable({
     "processing" : true,
     "ajax" : {
       "url" : "{{ url('dataprofile') }}",
       "type" : "GET"
     }
   });

table2 = $('#tabel-data').DataTable({});

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

  $('#form-tambah').on('submitt', function(e){
       if(!e.isDefaultPrevented()){
        
        var id = $('#id').val();

         if(save_method == "add") url = "{{url('kriteria')}}";
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
   
   $('.form-group').removeClass('has-error');
   $('.help-block').empty();
   $.ajax({
     url : "data-profile-diingikan/"+id+"/edit",
     type : "GET",
     dataType : "JSON",
     success : function(data){
       $('#modal-tambah').modal('show');
       $('.modal-title').text('Edit Data');
       
       $('#id').val(data.id);
       $('#nama').val(data.nama_lokasi);
   
       
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

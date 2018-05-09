<template>
   <div class="modal fade" id="myModal">
    <form id="form-tambah" data-parsley-validate method="POST" action="">
    
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Tambah Data</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                     <input id="id" name="id" type='hidden'>
                        <div class="form-group">
                            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input id="nama" name="nama" class="required form-control input-xs" placeholder="Nama " type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
                        <button id="simpan" class="btn btn-success" data-dismiss='modal' @click='saveModal' type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

        
</template>

<script>
  export default{
   
    data(){
      return{
        message : 'modal yow',
        
        
      }
      
    },
    methods:{
      saveModal(){
        alert('saving')
        
        
          
      },
      closeModal(){
        //document.getElementById('modal').style.visibility = "hidden";
      },
    }

  }
</script>


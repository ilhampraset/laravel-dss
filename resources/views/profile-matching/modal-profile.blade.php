<div class="modal fade" id="modal-tambah">
    <form id="form-tambah" data-parsley-validate method="POST">
    {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Tambah Data</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                     <input id="id" name="id" type='hidden'>
                     <input id="user" name="user_id" type="hidden" value="{{Auth::user()->id}}">
                        <div class="form-group">
                            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Coffeeshop</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input id="nama_coffeeshop" name="nama_coffeeshop" class="required form-control input-xs" placeholder="Nama Coffeeshop " type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Coffeeshop Acuan</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <select id="acuan" name='acuan'class='form-control input-xs'>
                                  <option value=""> Pilih Profile Acuan</option>
                                @foreach($profileAcuan as $p)
                                  <option value="{{$p->id}}"> {{$p->nama_coffeeshop}}</option>
                               @endforeach
                              </select>
                            </div>
                        </div>
                        <div id='detailvalue'>

                      </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
                        <button id="simpan" class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

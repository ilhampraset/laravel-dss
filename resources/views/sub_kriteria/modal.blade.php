<div class="modal fade" id="modal-tambah">
    <form id="form-tambah" data-parsley-validate method="POST" action="">
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

                        <div class="form-group">
                            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Kriteria :</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select id="id_kriteria" name="id_kriteria" class="form-control">
                                    @foreach($sub_kriteria as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Keterangan :</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea id="nama" name="nama" class="required form-control input-xs" > </textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>    

                        <div class="form-group">
                            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Nilai :</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input id="nilai" name="nilai" class="required form-control input-xs" placeholder="Nilai " type="text" >
                                <span class="help-block"></span>
                            </div>
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

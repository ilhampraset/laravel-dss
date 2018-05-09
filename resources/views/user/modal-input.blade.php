<div class="modal fade" id="modal-tambah">
    <form id="form-tambah" data-parsley-validate method="POST" action="{{url('simpan')}}">
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
                     <input id="user" name="user" type="hidden" value="{{Auth::user()->id}}">
                        <div class="form-group">
                            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Lokasi</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input id="nama" name="nama" class="required form-control input-xs" placeholder="Nama " type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    @foreach($kriteria as $kt)
                    <div class="form-horizontal">
                     <input id="id" name="id" type='hidden'>
                        <div class="form-group">
                            <label class="col-md-4 col-sm-4 col-xs-12 control-label">{{$kt->nama}}</label>
                           
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              
                                   <select  name='nilai[]'class='form-control input-xs'>
                                     @foreach($sub_kriteria as $skriteria)
                                     @if($skriteria->id_kriteria == $kt->id )
                                       <option value="{{$skriteria->id.' '.$kt->id }}"> {{$skriteria->nama.' ('.$skriteria->nilai.')'}}</option>
                                    @endif
                                    @endforeach
                                   </select>
                               
                                <span class="help-block"></span>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach

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

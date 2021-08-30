@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="card ">
        <div class="card-header ">
            <h4 class="card-title">{{$title}}</h4>
        </div>
        <div class="card-body ">
            <form method="post" method="post" action="{{route('prospek.surat_penawaran.store')}}"
                  class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <label class="col-md-3 col-form-label">Kode Kop Surat </label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="no_surat" class="form-control"
                                   value="SRT-{{$rand = substr(md5(microtime()),rand(0,26),15)}}" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Kop Surat</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="nama_kop_surat" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Alamat Kantor</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="alamat" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kontak (No. Telp)</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" name="notelp" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Image Kop Surat</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new">Pilih Gambar</span>
                                <input type="file" name="image" id='image' class="file form-control" required="">
                              </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Custom Image(Watermark)</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new">Pilih Gambar</span>
                                <input type="file" name="image2" id='image2' class="file form-control" >
                              </span>
                        </div>
                    </div>
                </div>


        </div>
        <div class="card-footer ">
            <div class="row">
                <label class="col-md-3"></label>
                <div class="col-md-9">
                    <button type="reset" class="btn btn-fill btn-danger">Reset</button>
                    <button type="submit" class="btn btn-fill btn-success">Simpan</button>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@extends('layout.main')
@section('title', $title)
@section('content')
    <form method="post" action="{{route('prospek.project.store')}}"
          class="form-horizontal">
        @csrf
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">{{$title}}</h4>
                <div style="float: right;" class="row">
                    <div class="col-md-12">
                        <button type="reset" class="btn btn-fill btn-danger">Reset</button>
                        <button type="submit" class="btn btn-fill btn-success">Simpan</button>
{{--                        <button type="submit" class="btn btn-fill btn-primary">PDF ( Surat Penawaran )</button>--}}
                    </div>
                </div>
            </div>
            <div class="card-body ">

                <div class="row">
                    <label class="col-md-3 col-form-label">Credential Prospek </label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="id_prospect" class="form-control"
                                   value="PRJ-{{$rand = substr(md5(microtime()),rand(0,26),15)}}" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Penawaran</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="nama_penawaran" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kepada (Perusahaan)</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="nama_perusahaan" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nomor Hp.</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" name="no_hp" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Klien</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="nama_client" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kota</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="kota" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Surat Penawaran</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" name="id_surat_penawaran" id="" required="">
                                <option value="" disabled>-- Silahkan Pilih Kop Surat Penawaran --</option>
                                @foreach($surat_penawaran as $surat)
                                    <option value="{{$surat->id}}">{{$surat->nama_kop_surat}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Jenis Penawaran</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" name="id_jenis_penawaran" id="" required="">
                                <option value="" disabled>-- Silahkan Pilih Jenis Penawaran --</option>
                                @foreach($jenis_penawaran as $jenis)
                                    <option value="{{$jenis->id}}">{{$jenis->jenis_penawaran}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-3 col-form-label">Deksripsi Penawaran</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="deskripsi_penawaran" id="editor" cols="100"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nilai Penawaran</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" name="nilai_penawaran" class="form-control" required="">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card-footer ">

            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endsection


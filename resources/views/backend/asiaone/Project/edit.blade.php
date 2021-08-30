@extends('layout.main')
@section('title', $title)
@section('content')
    <form method="post" action="{{route('prospek.project.update')}}"
          class="form-horizontal">
        @csrf
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">{{$title}}</h4>
                <div style="float: right;" class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-fill btn-success">Simpan Perubahan</button>
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
                                   value="{{ $data->id_prospect }}" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                {{--                gambar--}}

                <div class="row">
                    <p class="col-md-2 col-form-label">Kop Surat Penawaran </p><br>
                    <br>
                    <div class="col-md-10">
                        <div class="form-group">
                            <img style="width: 100%; height: 100px;" src="{{ URL::to('/') }}/images/{{ $data->image }}" alt="...">
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                {{--                gambar--}}
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_penawaran }}" name="nama_penawaran" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kepada (Perusahaan)</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_perusahaan }}" name="nama_perusahaan" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nomor Hp.</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="number"  value="0{{ $data->no_hp }}" name="no_hp" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Klien</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_client }}" name="nama_client"  class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kota</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text"  value="{{ $data->kota }}" name="kota"  class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Surat Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select class="form-control" name="id_surat_penawaran" id="" required="">
                                <option value="" disabled>-- Silahkan Pilih Kop Surat Penawaran --</option>
                                @foreach($surat_penawaran as $surat)
                                    <option value="{{$surat->id}}" {{ ( $surat->id == $data->id_surat_penawaran) ? 'selected' : '' }}>{{$surat->nama_kop_surat}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Jenis Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select class="form-control" name="id_jenis_penawaran" id="" required="">
                                <option value="" disabled>-- Silahkan Pilih Jenis Penawaran --</option>
                                @foreach($jenis_penawaran as $jenis)
                                    <option value="{{$jenis->id}}" {{ ( $jenis->id == $data->id_jenis_penawaran) ? 'selected' : '' }}>{{$jenis->jenis_penawaran}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-3 col-form-label">Deksripsi Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <textarea  name="deskripsi_penawaran"  id="editor" cols="100">{{ $data->deskripsi_penawaran }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nilai Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="number" value="{{ $data->nilai_penawaran }}" name="nilai_penawaran"  class="form-control" required="">
                            <input type="hidden" value="{{ $data->id }}" name="id"  class="form-control" required="">
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
    <script type="text/javascript">
        function dealRow(id)
        {
            swal({
                title: "Apakah Anda Yakin?",
                text: "Melakukan Deal Prospek Kali Ini!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#data-'+id).submit();
                    }
                });
        }
    </script>
@endsection


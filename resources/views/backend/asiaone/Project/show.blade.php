@extends('layout.main')
@section('title', $title)
@section('content')
    <form id="data-{{ $data->id }}" action="{{route('prospek.project.deal',$data->id)}}"
          method="post">
        {{csrf_field()}}
        {{method_field('delete')}}
    </form>
    <form method="post" action="{{route('prospek.project.store')}}"
          class="form-horizontal">
        @csrf
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">{{$title}}</h4>
                <div style="float: right;" class="row">
                    <div class="col-md-12">
                        <a href="{{ route('prospek.project.edit', $data->id) }}"
                           class="btn btn-fill btn-warning">Edit</a>
                        @csrf
                        @method('DELETE')
                        <a onclick="dealRow( {{ $data->id }} )" style="color: white" class="btn btn-fill btn-danger">Klik Deal</a>
                        <a href="{{ route('prospek.project.showPDF', $data->id) }}" class="btn btn-fill btn-primary">PDF
                            ( Surat Penawaran )</a>
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
                            <img style="width: 100%; height: 100px;" src="{{ URL::to('/') }}/images/{{ $data->image }}"
                                 alt="...">
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
                            <input type="text" value="{{ $data->nama_penawaran }}" readonly class="form-control"
                                   required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kepada (Perusahaan)</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_perusahaan }}" readonly class="form-control"
                                   required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nomor Hp.</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="number" value="0{{ $data->no_hp }}" readonly class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Klien</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_client }}" readonly class="form-control"
                                   required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kota</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->kota }}" readonly class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Surat Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_kop_surat }}" readonly class="form-control"
                                   required="">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Jenis Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->jenis_penawaran }}" readonly class="form-control"
                                   required="">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-3 col-form-label">Deksripsi Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <textarea readonly id="editor" cols="100">{{ $data->deskripsi_penawaran }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nilai Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="number" value="{{ $data->nilai_penawaran }}" readonly class="form-control"
                                   required="">
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
        function dealRow(id) {
            swal({
                title: "Apakah Anda Yakin?",
                text: "Melakukan Deal Prospek Kali Ini!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#data-' + id).submit();
                    }
                });
        }
    </script>
@endsection


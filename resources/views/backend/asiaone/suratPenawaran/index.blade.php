@extends('layout.main')
@section('title', $title)
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                    <div class="btn-group">
                        <a href="{{route('prospek.surat_penawaran.create')}}">
                            <button type="button" class="btn btn-success"><i class="now-ui-icons ui-1_simple-add"></i>
                                Tambah
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                    </div>
                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Surat</th>
                            <th>Nama Kop Surat</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th align="center">Kop</th>
                            <th align="center">Custom Image</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Surat</th>
                            <th>Nama Kop Surat</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th align="center">Kop</th>
                            <th align="center">Custom Image</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $row->no_surat }}</td>
                                <td>{{ $row->nama_kop_surat }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->notelp }}</td>
                                <td align="center"><a href data-toggle="modal" data-target="#gambar-{{$row->id}}">
                                        <img style="width: 10%; height: 10%;" src="{{ URL::to('/') }}/images/{{ $row->image }}" alt="..."></a></td>
                                <td align="center"><a href data-toggle="modal" data-target="#gambar2-{{$row->id}}">
                                        <img style="width: 10%; height: 10%;" src="{{ URL::to('/') }}/images/{{ $row->image2 }}" alt="..."></a></td>
                                <td align="center">
                                    <form id="data-{{ $row->id }}" action="{{route('prospek.surat_penawaran.delete',$row->id)}}"
                                          method="post">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                    </form>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="deleteRow( {{ $row->id }} )"
                                            class="btn btn-round btn-danger btn-icon btn-sm remove"><i
                                            class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            {{--    modal gambar --}}

                            <div class="modal fade" id="gambar-{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Gambar ( {{$row->nama_kop_surat}})</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img style="width: 50%; height: 20%;" src="{{ URL::to('/') }}/images/{{ $row->image }}" alt="...">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="gambar2-{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Gambar ( {{$row->nama_kop_surat}})</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img style="width: 50%; height: 20%;" src="{{ URL::to('/') }}/images/{{ $row->image2 }}" alt="...">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

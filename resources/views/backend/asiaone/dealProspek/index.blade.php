@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                    <div class="btn-group">
{{--                        <a href="{{route('prospek.project.create')}}">--}}
{{--                            <button type="button" class="btn btn-success"><i class="now-ui-icons ui-1_simple-add"></i>--}}
{{--                                Tambah--}}
{{--                            </button>--}}
{{--                        </a>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                    </div>
                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Klien</th>
                            <th>Kota</th>
                            <th>Jenis Penawaran</th>
                            <th>Nilai Penawaran</th>
                            <th>Nilai Deal</th>
                            <th>Nilai DP</th>
                            <th>WA Blast</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Klien</th>
                            <th>Kota</th>
                            <th>Jenis Penawaran</th>
                            <th>Nilai Penawaran</th>
                            <th>Nilai Deal</th>
                            <th>Nilai DP</th>
                            <th>WA Blast</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @php
                            $nomor = 1;
                            function rupiah($m)
                            {
                              $rupiah = "Rp ".number_format($m,0,",",".").",-";
                              return $rupiah;
                            }
                        @endphp
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $row->id_deal }}</td>
                                <td>{{ $row->nama_client }}</td>
                                <td>{{ $row->kota }}</td>
                                <td>{{ $row->jenis_penawaran }}</td>
                                <td>{{ rupiah($row->nilai_penawaran) }}</td>
                                <td>{{ rupiah($row->nilai_deal) }}</td>
                                <td>{{ rupiah($row->nilai_dp) }}</td>

                                <td align="center">
                                    <a target="_blank" href="https://wa.me/+62{{$row->no_hp}}"
                                       class="btn btn-round btn-success btn-icon btn-sm edit"><i class="far fa-address-book"></i></a>
                                </td>
                                <td align="center">

                                    <form id="data-{{ $row->id }}"
                                          action="{{route('prospek.deal.delete',$row->id)}}"
                                          method="post">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}

                                    </form>
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('prospek.deal.show', $row->id) }}"
                                       class="btn btn-round btn-primary  btn-icon btn-sm edit"><i
                                            class="far fa-eye"></i></a>
                                    <button type="submit" onclick="deleteRow( {{ $row->id }} )"
                                            class="btn btn-round btn-danger btn-icon btn-sm remove"><i
                                            class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

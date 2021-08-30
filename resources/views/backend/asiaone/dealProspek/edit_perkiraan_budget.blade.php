@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="card ">
        <div class="card-header ">
            <h4 class="card-title">Tabel Perkiraan Budget - {{$data->nama_penawaran}}</h4>
        </div>
        <div class="card-body ">
            <table style="font-size: 12px;" id="table_id" class="table table-striped table-bordered" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Vendor</th>
                    <th>Nama Perkiraan</th>
                    <th>Nama Prospek</th>
                    <th>Nilai</th>
                    <th>Dibuat</th>
                    <th>Tanggal Post</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $nomor = 1;
                 function rupiah($m)
                        {
                          $rupiah = "Rp ".number_format($m,0,",",".");
                          return $rupiah;
                        }
                $subtotal =0;
                $total =0;
                @endphp
                @foreach($budget as $row)
                    <tr>
                        <td>{{$nomor++}}</td>
                        @if($row->vendor)
                            <td>
                                <button class="btn btn-primary">{{ $row->vendor }}</button>
                            </td>
                        @else
                            <td>
                                <button class="btn btn-danger">{{ $row->jenis_perkiraan }}</button>
                            </td>
                        @endif
                        <td>{{ $row->nama_perkiraan }}</td>
                        <td>{{ $row->nama_penawaran }}</td>
                        <td>{{ rupiah($row->nilai_perkiraan) }}</td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('j F, Y g:i A') }}</td>
                        @if($row->tgl_post)
                            <td>
                                <button class="btn btn-success">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->tgl_post)->format('j F, Y g:i A')}}</button>
                            </td>
                        @else
                            <td>
                                <button class="btn btn-primary">Belum di ACC</button>
                            </td>
                        @endif
                        <td>
                            <form id="data-{{ $row->id }}"
                                  action="{{ url('/admin/prospek/deal/perkiraan/budget/edit/delete/'.$row->id.'',$data->id)}}"
                                  method="post">
                                {{csrf_field()}}
                                {{method_field('delete')}}
                            </form>
                            @csrf
                            @method('DELETE')
                            <form id="acc-{{ $row->id }}"
                                  action="{{ url('/admin/prospek/deal/perkiraan/budget/edit/acc/'.$row->id.'',$data->id)}}"
                                  method="post">
                                {{csrf_field()}}
                                {{method_field('delete')}}
                            </form>
                            @csrf
                            @method('DELETE')

                            <button data-toggle="modal" data-target="#editBudget-{{ $row->id }}"
                                    class="btn btn-warning">Edit
                            </button>
                            <a href="{{ route('prospek.project.showPDF', $data->id) }}" class="btn btn-secondary">Show</a>
                            <button onclick="deleteRow( {{ $row->id }} )" class="btn btn-danger">Hapus</button>
                            <button onclick="accRow( {{ $row->id }} )" class="btn btn-success">ACC</button>
                            <button class="btn btn-warning">Transfer</button>
                        </td>
                    </tr>
                    <?php
                    $total = $subtotal += $row->nilai_perkiraan;
                    ?>
                    <!--                    modal budget -->
                    <div class="modal fade" id="editBudget-{{ $row->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Budget
                                        ({{$row->nama_perkiraan}} / {{$row->nama_penawaran}})</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('prospek.deal.perkiraan.budget.edit.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">Nama Perkiraan </label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="hidden" value="{{ $row->id }}" name="id">
                                                    <input type="hidden" value="{{ $id }}" name="id_deal">
                                                    <input type="text" name="nama_perkiraan" class="form-control"
                                                           value="{{$row->nama_perkiraan}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">Nilai Perkiraan </label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" name="nilai_perkiraan" class="form-control"
                                                           value="{{$row->nilai_perkiraan}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <tr>
                    <td class="text-center" colspan="4"><b>Total</b></td>
                    <td><b>{{ rupiah($total)}}</b></td>
                    <td class="text-center" colspan="3"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer ">
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#radio').change(function () {
                if (this.checked) {
                    $('#input').show();
                }
            });
            $('#radio2').change(function () {
                if (this.checked) {
                    $('#input').hide();
                }
            });
        })

        function accRow(id) {
            swal({
                title: "Apakah Anda Yakin?",
                text: "ACC dengan budget ini, YES OR NO!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#acc-' + id).submit();
                    }
                });
        }
    </script>
@endsection



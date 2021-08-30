@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="card ">
        <div class="card-header ">
            <h4 class="card-title">{{$title}}</h4>
        </div>
        <div class="card-body ">
            <form method="post" method="post" action="{{route('prospek.deal.perkiraan.budget.store')}}"
                  class="form-horizontal">
                @csrf
                <div class="row">
                    <label class="col-md-3 col-form-label">Credential Prospek </label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="id_prospect" class="form-control"
                                   value="{{ $data->id_prospect }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Credential Deal </label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="id_deal" class="form-control"
                                   value="{{ $data->id_deal }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Penawaran</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_penawaran }}" class="form-control" readonly>
                            <input type="hidden" value="{{ $data->deal_id }}" name="deal_id" class="form-control">
                            <input type="hidden" value="{{ $data->id }}" name="id" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="col-md-3 col-form-label">Jenis Perkiraan ( Budget )</label>
                    <div class="col-md-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_perkiraan" value="vendor"
                                   id="radio">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Vendor
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_perkiraan" value="non_vendor"
                                   id="radio2" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                Non Vendor
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <div id="input" class="row">
                    <label class="col-md-3 col-form-label">Vendor</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="vendor" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Perkiraan (Prospek)</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="nama_perkiraan" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nilai Perkiraan</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" name="nilai_perkiraan" class="form-control" required>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer ">
            <div class="row">
                <label class="col-md-3"></label>
                <div class="col-md-9">
                    <button type="reset" class="btn btn-fill btn-danger">Reset</button>
                    <button type="submit" class="btn btn-fill btn-success">Simpan Budget</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    <div class="card ">
        <div class="card-header ">
            <h4 class="card-title">Tabel Perkiraan Budget</h4>
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
                            <td><button class="btn btn-primary">{{ $row->vendor }}</button></td>
                        @else
                            <td><button class="btn btn-danger">{{ $row->jenis_perkiraan }}</button></td>
                        @endif
                        <td>{{ $row->nama_perkiraan }}</td>
                        <td>{{ $row->nama_penawaran }}</td>
                        <td>{{ rupiah($row->nilai_perkiraan) }}</td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('j F, Y g:i A') }}</td>
                        @if($row->tgl_post)
                            <td><button class="btn btn-primary">{{$row->tgl_post}}</button></td>
                        @else
                            <td><button class="btn btn-danger">Belum Ditinjau</button></td>
                        @endif
                    </tr>
                    <?php
                    $total = $subtotal+=$row->nilai_perkiraan;
                    ?>
                @endforeach
                <tr>
                    <td class="text-center" colspan="4"><b>Total</b></td>
                    <td ><b>{{ rupiah($total) }}</b></td>
                    <td class="text-center" colspan="2"></td>
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
            $('#radio').change(function() {
                if(this.checked) {
                    $('#input').show();
                }
            });
            $('#radio2').change(function() {
                if(this.checked) {
                    $('#input').hide();
                }
            });
        })
    </script>
@endsection



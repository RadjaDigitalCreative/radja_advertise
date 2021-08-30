@extends('layout.main')
@section('title', $title)
@section('style')
    <style>
        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {

            width: 23cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;
        }

        @media print {
            body, page {
                margin: 0;
                box-shadow: 0;
            }
        }

        .line {
            margin-bottom: 0.5cm;

        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20px;
        }

        .ami {
            font-size: 5px;
            line-height: 0.01%;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    {{--    modal --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <page size="A4" style="margin-bottom: 60%">
                <div class="card">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <img style="width: 100%; height: 100px;"
                                         src="{{ URL::to('/') }}/images/{{ $data->image }}"
                                         alt="...">
                                </div>
                            </div>
                        </div>
                        <h4 class="col-md-12 text-center">SURAT PENAWARAN</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="float: right;">{{ $data->created_at }}</p>
                                <p>Kepada Yth: </p>
                                <p>{{ $data->nama_client }}</p>
                                <p>Di Tempat </p>
                                <p>Perihal: {{ $data->nama_penawaran }} </p>
                                <p>Dengan Hormat, </p>
                                <p>Bersama surat ini kami mengajukan penawaran kerjasama
                                    dalam {{ $data->nama_penawaran }}
                                    dengan RAB sebagai berikut :</p>
                                <p>
                                    {!! $data->deskripsi_penawaran !!}
                                </p>
                                <br>
                                <p>Demikian surat penawaran ini kami ajukan, terima kasih.</p>
                                <div style="float: right;">
                                    <p>Hormat Kami,</p>
                                    <img style="width: 100%; height: 100px;" src="{{ asset('asiaone/ttd.png') }}"
                                         alt="...">
                                    <p><u>Wendi Ardiawan Happy</u></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </page>

        </div>
    </div>
    @php

        function rupiah($m)
        {
          $rupiah = "Rp ".number_format($m,0,",",".");
          return $rupiah;
        }
    @endphp
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
                <hr>
                <div style="float: right;" class="row">
                    <div class="col-md-12">
                        <a href="{{ route('prospek.project.edit', $data->id) }}"
                           class="btn btn-fill btn-secondary">Edit</a>
                        <a href="{{ route('prospek.project.showPDF', $data->id) }}" class="btn btn-fill btn-primary">PDF
                            ( Surat Penawaran )</a>
                        <a href="{{ route('prospek.deal.invoice', $data->id) }}"
                           class="btn btn-fill btn-success">Invoice</a>
                        <a href="{{ route('prospek.deal.bast', $data->id) }}"
                           class="btn btn-fill btn-danger">BAST</a>
                        <a href="{{ route('prospek.deal.perkiraan.budget', $data->id) }}"
                           class="btn btn-fill btn-info">Perkiraan Budget</a>
                        <a href="{{ route('prospek.deal.perkiraan.budget.edit', $data->id) }}"
                           class="btn btn-fill btn-light">Edit Perkiraan Budget</a>

                        <a href="{{ route('prospek.deal.spk_vendor', $data->id) }}"
                           class="btn btn-fill btn-warning">Buat SPK Vendor</a>
                        <a href="{{ route('prospek.deal.pelunasan', $data->id) }}"
                           class="btn btn-fill btn-primary">Surat Pelunasan</a>

                        <a href="{{ route('prospek.project.edit', $data->id) }}"
                           class="btn btn-fill btn-outline-success">Selesai Project</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card ">
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
                    <label class="col-md-3 col-form-label">Nilai Deal</label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" value="{{ rupiah($data->nilai_deal) }}" class="form-control" readonly>
                        </div>
                    </div>
                    <label class="col-md-3 col-form-label">Nilai DP</label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" value="{{ rupiah($data->nilai_dp) }}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">PPN</label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" value="{{ $data->ppn }} %" class="form-control" readonly>
                        </div>
                    </div>
                    <label class="col-md-3 col-form-label">PPH</label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" value="{{ $data->pph }} %" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <label class="col-md-3 col-form-label"><b>Invoices</b></label>
                    <div class="col-md-9">
                        <table style="font-size: 12px" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Deksripsi</th>
                                <th>Jumlah</th>
                                <th>Price</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php
                                $no =1;
                            $totalprice =0;
                            $totalqty =0;
                            @endphp
                            @foreach($invoice as $row)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$row->ket}}</td>
                                    <td>{{$row->qty}}</td>
                                    <td>{{ rupiah($row->price)}}</td>
                                </tr>
                                <?php $totalqty += $row->qty ?>
                                <?php $totalprice += $row->price ?>
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-center"><b>Total</b></td>
                                <td>{{ $totalqty}}</td>
                                <td>{{ rupiah($totalprice) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <hr>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_penawaran }}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kepada (Perusahaan)</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_perusahaan }}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nomor Hp.</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="number" value="0{{ $data->no_hp }}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Klien</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->nama_client }}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Kota</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ $data->kota }}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Surat Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select class="form-control" name="id_surat_penawaran" id="" readonly>
                                @foreach($surat_penawaran as $surat)
                                    <option disabled
                                            value="{{$surat->id}}" {{ ( $surat->id == $data->id_surat_penawaran) ? 'selected' : '' }}>{{$surat->nama_kop_surat}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Jenis Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select class="form-control" name="id_jenis_penawaran" id="" readonly>
                                @foreach($jenis_penawaran as $jenis)
                                    <option disabled
                                            value="{{$jenis->id}}" {{ ( $jenis->id == $data->id_jenis_penawaran) ? 'selected' : '' }}>{{$jenis->jenis_penawaran}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-3 col-form-label">Deksripsi Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <textarea readonly name="deskripsi_penawaran" id="editor"
                                      cols="100">{{ $data->deskripsi_penawaran }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nilai Penawaran</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" value="{{ rupiah($data->nilai_penawaran) }}" name="nilai_penawaran"
                                   class="form-control" readonly>
                            <input type="hidden" value="{{ $data->id }}" name="id" class="form-control" required="">
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


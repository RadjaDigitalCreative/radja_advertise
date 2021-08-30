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
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('prospek.deal.invoice.update') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <table class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Deskripsi</th>
                                <th class="text-right">Jumlah</th>
                                <th class="text-right">Harga</th>
                                <th class="text-center">Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $no =1 ;
                                function rupiah($m)
                                {
                                  $rupiah = "Rp ".number_format($m,0,",",".").",-";
                                  return $rupiah;
                                }
                                $sub =0;
                            @endphp


                            <input type="hidden" name="id" value="{{ $data->id }}">
                            @foreach($invoice as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <input type="hidden" name="id_invoice[]" value="{{ $row->id }}">
                                    <td class="pt-3-half" contenteditable="true"><input type="text" name="ket[]"
                                                                                        value="{{ $row->ket }}"
                                                                                        class="border-none"></td>
                                    <td class="pt-3-half" contenteditable="true"><input type="text" name="qty[]"
                                                                                        value="{{ $row->qty }}"
                                                                                        class="border-none"></td>
                                    <td class="pt-3-half" contenteditable="true"><input type="text" name="price[]"
                                                                                        value="{{ $row->price }}"
                                                                                        class="border-none"></td>
                                    <td><span class="table-remove"><a href="{{ url('/admin/prospek/deal/invoice/delete/'.$row->id.'', $data->id) }}"
                                                                           class="btn btn-danger btn-rounded btn-sm my-0">Hapus</a></span>
                                    </td>
                                </tr>

                                <?php
                                $hasil = $row->price * $row->qty;
                                $subtotal = $sub += $hasil;
                                $ppn = $subtotal * ($data->ppn / 100);
                                $pph = $subtotal * ($data->pph / 100);
                                $total = $subtotal - $ppn - $pph;
                                ?>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="card">
        <div class="card-header ">
            <h4 class="card-title">{{$title}}</h4>
            <div style="float: right;" class="row">
                <div class="col-md-12">
                    <a target="_blank" href="{{ route('prospek.project.printPDF', $data->id) }}"
                       class="btn btn-fill btn-primary">Print PDF</a>
                    <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target=".bd-example-modal-lg">
                        Edit
                    </button>

                </div>
            </div>
        </div>
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
                    <h4 class="col-md-12 text-center">INVOICE</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="float: right;">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('j F, Y ')}}</p>
                            <p>Nama : {{ $data->nama_perusahaan }} </p>
                            <p>Status : Klien </p>
                            <p>NO : {{ $data->id }}
                                /RAI/{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m/Y ')  }}</p>
                            <br>
                            <table style="font-size: 13px;" class="table table-striped table-bordered" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Deskripsi</th>
                                    <th class="text-right">Jumlah</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no =1 ;

                                $sub =0;
                                @endphp
                                @foreach($invoice as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->ket }}</td>
                                        <td class="text-right">{{ $row->qty }}</td>
                                        <td class="text-right">{{ rupiah($row->price) }}</td>
                                        <td class="text-right">{{ rupiah($row->price *$row->qty)}}</td>
                                    </tr>
                                    <?php
                                    $hasil = $row->price * $row->qty;
                                    $subtotal = $sub += $hasil;
                                    $ppn = $subtotal * ($data->ppn / 100);
                                    $pph = $subtotal * ($data->pph / 100);
                                    $total = $subtotal - $ppn - $pph;
                                    ?>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="row" style="margin-top: 70px">
                                <h6 class="col-md-12 "><b>Catatan Penting:</b></h6>
                                <div class="col-md-6">
                                    <div style="font-size: 11px; border-style: inset;"><i>
                                            <p>Pembayaran via cash atau transfer ke Rekening : </p>
                                            <p>BCA 3930294127 a.n Wendi Ardiawan Happy</p>
                                            <p>Mandiri 1140014145562 a.n CV Radja Advertise Indonesia</p>
                                            <p>Pembayaran pelunasan dilakukan setelah diterima
                                                tanda tangan BAST
                                            </p>
                                            <p>Bila BAST pekerjaan telah di Tandatangani belum ada
                                                pelunasan, maka pekerjaan akan di lakukan
                                                pembongkaran / penarikan.</p></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <table>
                                            <tr>
                                                <td>Sub Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td>:</td>
                                                <td>{{ rupiah($subtotal)}}</td>
                                            </tr>
                                            <tr>
                                                <td>PPN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td>:</td>
                                                <td>{{rupiah($ppn)}}</td>
                                            </tr>
                                            <tr>
                                                <td>PPH&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td>:</td>
                                                <td>{{rupiah($pph)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td>:</td>
                                                <td>{{rupiah($total)}}</td>
                                            </tr>
                                            <tr>
                                                <td>DP ( Down Payment )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td>:</td>
                                                <td>{{rupiah($data->nilai_dp)}}</td>
                                            </tr>
                                            <hr>
                                            <tr>
                                                <td>Sisa Pelunasan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td>:</td>
                                                <td>{{rupiah($total - $data->nilai_dp)}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </page>
    </div>
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


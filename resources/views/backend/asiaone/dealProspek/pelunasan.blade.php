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
    <div class="card">
        <div class="card-header ">
            <h4 class="card-title">{{$title}}</h4>
            <div style="float: right;" class="row">
                <div class="col-md-12">
                    <a target="_blank" href="{{ route('prospek.project.printPDF', $data->id) }}"
                       class="btn btn-fill btn-primary">Print PDF</a>
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
                    <h4 class="col-md-12 text-center" >SURAT PERMINTAAN PEMBAYARAN</h4>
                    <div class="row">
                        <div class="col-md-12">

                        <p style="float: right;">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('j F, Y ')}}</p>
                        <p>Kepada Yth : <br>{{ $data->nama_client }} <br> Di Tempat</p>
                        <p>Perihal : Perminataan Pelunasan Pembayaran</p>
                        <br>
                            <p>Dengan Hormat, </p>
                            <p style="margin-bottom: 35px;">Bersama surat ini, dimana pekerjaan atas :</p>
                            <table>
                                <tr>
                                    <td>Nama Project&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>{{$data->nama_penawaran}}</td>
                                </tr>
                                <tr>
                                    <td>Lokasi Project&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td >:</td>
                                    <td>{{$data->kota}}</td>
                                </tr>
                            </table>

                            @php $no =1 ;
                                function rupiah($m)
                                {
                                  $rupiah = "Rp ".number_format($m,0,",",".").",-";
                                  return $rupiah;
                                }
                                $sub =0;
                            @endphp
                            @foreach($invoice as $row)
                                <?php
                                $hasil = $row->price * $row->qty;
                                $subtotal = $sub += $hasil;
                                $ppn = $subtotal * ($data->ppn / 100);
                                $pph = $subtotal * ($data->pph / 100);
                                $total = $subtotal - $ppn - $pph;
                                ?>
                            @endforeach
                            <p style="margin-top: 35px;">Pekerjaan telah selesai dan terpasang, maka kami mengajukan permintaan pembayaran
                                atas pekerjaan tersebut senilai {{ rupiah($total) }}<br> Dengan Rincian :</p>

                            <table>
                                <tr>
                                    <td>Total Project&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>{{ rupiah($total) }}</td>
                                </tr>
                                <tr>
                                    <td>Down Payment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td >:</td>
                                    <td>{{rupiah($data->nilai_dp)}}</td>
                                </tr>
                                <tr>
                                    <td>Sisa Pelunasan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td >:</td>
                                    <td>{{rupiah($total - $data->nilai_dp)}}</td>
                                </tr>
                            </table>
                            <p style="margin-top: 35px;">Harap dibayar cash atau transfer via rekening : <br>
                                - Mandiri 1140014145562 an. CV Radja Advertise Indonesia <br>
                                - BCA 3930294127 an. Wendi Ardiawan Happy</p>
                            <br>
                            <p >Demikian surat permintaan pembayaran ini kami ajukan, <br>Terima kasih. <br>Hormat Kami,</p>

                            <div >
                                <p>Hormat Kami,</p>
                                <img style="width: 20%; height: 100px;" src="{{ asset('asiaone/ttd.png') }}"
                                     alt="...">
                                <p><u>Wendi Ardiawan Happy</u></p>
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


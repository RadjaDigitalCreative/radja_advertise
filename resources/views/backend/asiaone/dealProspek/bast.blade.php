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
                    <h4 class="col-md-12 text-center" style="margin-bottom: 95px; margin-top: 85px;">BERITA ACARA SERAH TERIMA
                        PEKERJAAN</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Dengan Hormat, </p>
                            <p style="margin-bottom: 55px;">Bersama surat ini kami memberikan berita acara serah terima
                                pekerjaan sebagai berikut :</p>
                            <table>
                                <tr>
                                    <td>Kepada Yth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>{{$data->nama_perusahaan}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td >:</td>
                                    <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->format('j F, Y ')}}</td>
                                </tr>
                                <tr>
                                    <td>Perihal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td >:</td>
                                    <td>{{$data->nama_penawaran}}</td>
                                </tr>
                            </table>
                            <br>
                            <p style="margin-bottom: 105px;">Menyatakan pekerjaan jasa / produk yang dikerjakan diterima
                                dalam keadaan baik dan <br> sesuai dengan permintaan.</p>
                            <div style="float: left;">
                                <p>&nbsp;&nbsp;&nbsp;Penerima,</p>
                                <p style="margin-top: 120px;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
                            </div>
                            <div style="float: right;">
                                <p>Hormat Kami,</p>
                                <p style="margin-top: 120px;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
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


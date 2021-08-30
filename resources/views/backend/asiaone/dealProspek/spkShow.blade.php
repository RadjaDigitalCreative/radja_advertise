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
                    <a target="_blank" href="{{ route('prospek.project.printPDF', $data->id) }}" class="btn btn-fill btn-primary">Print PDF</a>
                </div>
            </div>
        </div>
        <page size="A4" style="margin-bottom: 60%">
            <div class="card">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <img style="width: 100%; height: 100px;" src="{{ URL::to('/') }}/images/{{ $data->image }}"
                                     alt="...">
                            </div>
                        </div>
                    </div>
                    <h4 class="col-md-12 text-center">PURCHASE ORDER</h4>
                    @php
                        function rupiah($m)
                        {
                          $rupiah = "Rp ".number_format($m,0,",",".").",-";
                          return $rupiah;
                        }
                        $sub =0;
                    @endphp
                    <div class="row">
                        <div class="col-md-12">
                            <p style="float: right;">{{ $data->created_at }}</p>
                            <p>Kepada Yth: </p>
                            <p>{{ $deal->vendor }}</p>
                            <p>Di Tempat </p>
                            <p>Perihal: Purchase Order {{ $deal->nama_perkiraan }} </p>
                            <p>Dengan Hormat, </p>
                            <p>Bersama surat ini kami terbitkan purchase order berupa kerjasama dalam pembuatan :</p>
                            <table>
                                <tr>
                                    <td width="190px"><p>Project</p></td>
                                    <td><p>:</p></td>
                                    <td><p>{{ $deal->nama_perkiraan }}</p></td>
                                </tr>
                                <tr>
                                    <td width="190px"><p>Spek</p></td>
                                    <td><p>:</p></td>
                                    <td>{!!  $deskripsi !!} </td>
                                </tr>
                                <tr>
                                    <td width="190px"><p>Harga</p></td>
                                    <td><p>:</p></td>
                                    <td><p>{{ rupiah($deal->nilai_perkiraan) }}</p> </td>
                                </tr>
                                <tr>
                                    <td width="190px"><p>DP</p></td>
                                    <td><p>:</p></td>
                                    <td><p>{{rupiah(0)}}</p> </td>
                                </tr>
                                <tr>
                                    <td width="190px"><p>Deadline/ Tgl</p></td>
                                    <td><p>:</p></td>
                                    <td><p>{{ $deathline }}</p> </td>
                                </tr>

                            </table>
                            <br>
                            <p>Catatan :</p>
                            <p>1. Pengerjaan harus sesuai dengan spek</p>
                            <p>2. Apabila pengerjaan lewat dari dead line maka dikenakan charge 1% perhari dari total nilai
                                project
                            </p>
                            <p>3. Harap ditanda-tangani oleh vendor pelaksana</p>
                            <p>4. Harap melampirkan foto sebelum, foto sesudah dan Berita Acara Serah Terima Pekerjaan
                                ke klien, ditanda-tangani klien dan dikirimkan kembali ke kami.</p>

                            <p>Demikian purchase order dibuat, terima kasih.</p>
                            <div style="float: left;">
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hormat Kami,</p>
                                <img style="width: 100%; height: 100px;" src="{{ asset('asiaone/ttd.png') }}"
                                     alt="...">
                                <p>( Wendi Ardiawan Happy )</p>
                            </div>
                            <div style="float: right;">
                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelaksana,</p>
                                <br><br><br><br>
                                <p>(&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</p>
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


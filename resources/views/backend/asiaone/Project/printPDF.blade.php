<html>
<head>

</head>
<body>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <img style="width: 100%; height: 100px;" src="data:image/png;base64, {{ $data_kop }}">
        </div>
    </div>
</div>
<h2 style="text-align: center">SURAT PENAWARAN</h2>
<div class="row">
    <p style="float: right;">{{ $data->created_at }}</p>
    <p>Kepada Yth: </p>
    <p>{{ $data->nama_client }}</p>
    <p>Di Tempat </p>
    <p>Perihal: {{ $data->nama_penawaran }} </p>
    <p>Dengan Hormat, </p>
    <p>Bersama surat ini kami mengajukan penawaran kerjasama dalam {{ $data->nama_penawaran }}
        dengan RAB sebagai berikut :</p>
    <p>
        {!! $data->deskripsi_penawaran !!}
    </p>
    <br>
    <p>Demikian surat penawaran ini kami ajukan, terima kasih.</p>
    <div style="float: right;">
        <p>Hormat Kami,</p>
        <br>
        <img style="width: 25%; height: 70px;" src="data:image/png;base64, {{ $data_ttd }}">
        <p><u>Wendi Ardiawan Happy</u></p>
    </div>
</div>
</body>
</html>

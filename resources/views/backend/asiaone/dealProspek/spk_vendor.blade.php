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
    <!-- Modal -->
    <div class="card">
        <div class="card-header ">
            <h4 class="card-title">{{$title}}</h4>
        </div>
        <form action="{{ route('prospek.deal.spk_vendor.print') }}" method="post">
            @csrf
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
                                   value="DEA-{{$rand = substr(md5(microtime()),rand(0,26),15)}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Nama Projek </label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="id_deal" class="form-control"
                                   value="{{$data->nama_penawaran}}" readonly>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$id}}">
                <div class="row">
                    <label class="col-md-3 col-form-label">Pilih Budget Vendor</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            @php
                                function rupiah($m)
                                {
                                  $rupiah = "Rp ".number_format($m,0,",",".").",-";
                                  return $rupiah;
                                }
                                $sub =0;
                            @endphp
                            <select class="form-control" name="id_budget" id="" required="">
                                <option value="" disabled>-- Silahkan Pilih Kop Surat Penawaran --</option>
                                @foreach($budget_deal as $budget)
                                    <option
                                        value="{{$budget->id}}">Nama Perkiraan = {{$budget->nama_perkiraan}} / Nilai
                                        Budget = {{ rupiah($budget->nilai_perkiraan)}} / Vendor
                                        = {{$budget->vendor}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Deathline Pengerjaan </label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="date" name="deathline" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 col-form-label">Deksripsi</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="deskripsi" id="editor" cols="100"></textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Siap Print</button>

            </div>
        </form>
        <br>
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


<?php

namespace App\Http\Controllers\Asiaone;

use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;


class ProjectController extends Controller
{
    protected $folder = 'backend.asiaone.project';
    protected $rdr = '/admin/prospek/project';
    private $titlePage = 'Prospek Project';
    private $titlePage2 = 'Tambah Prospek Project';
    private $titlePage3 = 'Update Prospek Project';
    private $titlePage4 = 'Detail Prospek Project';
    private $titlePage5 = 'Print(PDF) Prospek Project';
    private $titlePage6 = 'Prospek To Deal';


    public function index(Request $request)
    {
        $params = [
            'title' => $this->titlePage
        ];
        $data = DB::table('prospek_project')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat'
            )
            ->where('prospek_project.status', NULL)
            ->orderBy('prospek_project.created_at', 'desc')
            ->get();
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        return view($this->folder . '.index', $params, compact('role', 'bayar', 'data'));
    }

    public function create()
    {
        $params = [
            'title' => $this->titlePage2
        ];
        $surat_penawaran = DB::table('kop_surat')->get();
        $jenis_penawaran = DB::table('jenis_penawaran')->get();
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();

        return view($this->folder . '.create', $params, compact('role', 'bayar', 'surat_penawaran', 'jenis_penawaran'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'id_prospect' => 'required'
            ]);
            DB::table('prospek_project')->insert([
                'id_prospect' => $request->id_prospect,
                'nama_penawaran' => $request->nama_penawaran,
                'nama_perusahaan' => $request->nama_perusahaan,
                'no_hp' => $request->no_hp,
                'nama_client' => $request->nama_client,
                'kota' => $request->kota,
                'id_surat_penawaran' => $request->id_surat_penawaran,
                'id_jenis_penawaran' => $request->id_jenis_penawaran,
                'deskripsi_penawaran' => $request->deskripsi_penawaran,
                'nilai_penawaran' => $request->nilai_penawaran,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return redirect($this->rdr)->with('success', 'Data Berhasil di tambahkan');
        } catch (\Exception $e) {
            return redirect($this->rdr)->with('warning', 'Data hancur parah');
        }
    }

    public function show($id)
    {
        $params = [
            'title' => $this->titlePage4
        ];
        $data = DB::table('prospek_project')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $id)->first();
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        return view($this->folder . '.show', $params, compact('role', 'bayar', 'data'));
    }

    public function edit($id)
    {
        $params = [
            'title' => $this->titlePage4
        ];
        $surat_penawaran = DB::table('kop_surat')->get();
        $jenis_penawaran = DB::table('jenis_penawaran')->get();
        $data = DB::table('prospek_project')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $id)->first();
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        return view($this->folder . '.edit', $params, compact('role', 'bayar', 'data', 'surat_penawaran', 'jenis_penawaran'));
    }

    public function update(Request $request)
    {
        try {
            DB::table('prospek_project')->where('id', $request->id)
                ->update([
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'no_hp' => $request->no_hp,
                    'nama_client' => $request->nama_client,
                    'kota' => $request->kota,
                    'id_surat_penawaran' => $request->id_surat_penawaran,
                    'id_jenis_penawaran' => $request->id_jenis_penawaran,
                    'deskripsi_penawaran' => $request->deskripsi_penawaran,
                    'nilai_penawaran' => $request->nilai_penawaran,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            return redirect($this->rdr)->with('success', 'Data Berhasil di update');
        } catch (\Exception $e) {
            return redirect($this->rdr)->with('warning', 'Data hancur parah');
        }
    }

    public function delete($id)
    {
        DB::table('prospek_project')->where('id', $id)->delete();
        return redirect($this->rdr)->with('success', 'Data Berhasil di hapus');
    }

    public function deal($id)
    {
        $params = [
            'title' => $this->titlePage6
        ];
        $surat_penawaran = DB::table('kop_surat')->get();
        $jenis_penawaran = DB::table('jenis_penawaran')->get();
        $data = DB::table('prospek_project')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $id)->first();
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        return view($this->folder . '.deal', $params, compact('role', 'bayar', 'data', 'surat_penawaran', 'jenis_penawaran'));
    }

    public function saveDeal(Request $request)
    {
        try {
            DB::table('prospek_project')->where('id', $request->id)
                ->update([
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'no_hp' => $request->no_hp,
                    'nama_client' => $request->nama_client,
                    'kota' => $request->kota,
                    'id_surat_penawaran' => $request->id_surat_penawaran,
                    'id_jenis_penawaran' => $request->id_jenis_penawaran,
                    'deskripsi_penawaran' => $request->deskripsi_penawaran,
                    'nilai_penawaran' => $request->nilai_penawaran,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            DB::table('prospek_deal')->insert([
                'id_deal' => $request->id_deal,
                'id_prospect' => $request->id,
                'nilai_deal' => $request->nilai_deal,
                'nilai_dp' => $request->nilai_dp,
                'ppn' => $request->ppn,
                'pph' => $request->pph,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $id = DB::getPdo()->lastInsertId();
            $count = count($request->ket);
            for($i=0; $i<$count; $i++){
                DB::table('invoice_deal')->insert([
                    'id_deal' => $id,
                    'ket' => $request->ket[$i],
                    'qty' => $request->qty[$i],
                    'price' => $request->price[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            return redirect($this->rdr)->with('success', 'Data Berhasil di update');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showPDF($id)
    {
        $params = [
            'title' => $this->titlePage5
        ];
        $data = DB::table('prospek_project')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $id)->first();
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        return view($this->folder . '.showPDF', $params, compact('role', 'bayar', 'data'));
    }

    public function printPDF($id)
    {
        $data = DB::table('prospek_project')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $id)->first();
        $path = public_path('images/' . $data->image . '');
        $path2 = public_path('asiaone/ttd.png');
        $data_kop = base64_encode(file_get_contents($path));
        $data_ttd = base64_encode(file_get_contents($path2));
        $pdf = PDF::loadView($this->folder . '.printPDF', compact('data', 'data_kop', 'data_ttd'))->setPaper('a4', 'potrait');
        return $pdf->download('Surat_Penawaran_' . $data->nama_client . '.pdf');
    }
}

<?php

namespace App\Http\Controllers\Asiaone;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DealController extends Controller
{
    protected $folder = 'backend.asiaone.dealProspek';
    protected $rdr = '/admin/prospek/deal_prospek';
    private $titlePage = 'Prospek Deal';
    private $titlePage2 = 'Tambah Prospek Deal';
    private $titlePage3 = 'Update Prospek Deal';
    private $titlePage4 = 'Show Prospek Deal';
    private $titlePage5 = 'Show BAST ( Berita Acara )';
    private $titlePage6 = 'Show Invoice';
    private $titlePage7 = 'Show Surat Pelunasan';
    private $titlePage8 = 'Show Perkiraan Budget';


    public function index(Request $request)
    {
        $params = [
            'title' => $this->titlePage
        ];

        $data = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'prospek_deal.id_deal',
                'prospek_deal.nilai_deal',
                'prospek_deal.nilai_dp',
                'prospek_deal.ppn',
                'prospek_deal.pph',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat'
            )
            ->where('prospek_project.status', 1)
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

    public function show($id)
    {
        $params = [
            'title' => $this->titlePage4
        ];
        $surat_penawaran = DB::table('kop_surat')->get();
        $jenis_penawaran = DB::table('jenis_penawaran')->get();
        $get_invoice_id = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('invoice_deal', 'prospek_deal.id', '=', 'invoice_deal.id_deal')
            ->select(
                'invoice_deal.id_deal'
            )
            ->where('prospek_project.id', $id)->first();
        $invoice = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('invoice_deal', 'prospek_deal.id', '=', 'invoice_deal.id_deal')
            ->where('invoice_deal.id_deal', $get_invoice_id->id_deal)
            ->select(
                'invoice_deal.*'
            )
            ->get();
        $data = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'prospek_deal.id_deal',
                'prospek_deal.nilai_deal',
                'prospek_deal.nilai_dp',
                'prospek_deal.ppn',
                'prospek_deal.pph',
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
        return view($this->folder . '.show', $params, compact('role', 'bayar', 'data', 'surat_penawaran', 'jenis_penawaran', 'invoice'));
    }

    public function bast($id)
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
        return view($this->folder . '.bast', $params, compact('role', 'bayar', 'data'));
    }

    public function invoice($id)
    {
        $params = [
            'title' => $this->titlePage6
        ];
        $get_invoice_id = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('invoice_deal', 'prospek_deal.id', '=', 'invoice_deal.id_deal')
            ->select(
                'invoice_deal.id_deal'
            )
            ->where('prospek_project.id', $id)->first();
        $invoice = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('invoice_deal', 'prospek_deal.id', '=', 'invoice_deal.id_deal')
            ->where('invoice_deal.id_deal', $get_invoice_id->id_deal)
            ->select(
                'invoice_deal.*'
            )
            ->get();
        $data = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'prospek_deal.id_deal',
                'prospek_deal.id AS deal_id',
                'prospek_deal.nilai_deal',
                'prospek_deal.nilai_dp',
                'prospek_deal.ppn',
                'prospek_deal.pph',
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
        return view($this->folder . '.invoice', $params, compact('role', 'bayar', 'data', 'invoice'));
    }

    public function update(Request $request)
    {
        try {
            $count = count($request->ket);
            for ($i = 0; $i < $count; $i++) {
                DB::table('invoice_deal')->where('id', $request->id_invoice[$i])
                    ->update([
                        'ket' => $request->ket[$i],
                        'qty' => $request->qty[$i],
                        'price' => $request->price[$i],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
            }
            return redirect('/admin/prospek/deal/invoice/' . $request->id . '')->with('success', 'Data invoice di update');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id, $id_prospect)
    {
        DB::table('invoice_deal')->where('id', $id)
            ->delete();
        return redirect('/admin/prospek/deal/invoice/' . $id_prospect . '')->with('success', 'Data invoice di update');
    }

    public function perkiraan_budget($id)
    {
        $params = [
            'title' => $this->titlePage8
        ];

        $data = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'prospek_deal.id_deal',
                'prospek_deal.id AS deal_id',
                'prospek_deal.nilai_deal',
                'prospek_deal.nilai_dp',
                'prospek_deal.ppn',
                'prospek_deal.pph',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $id)->first();
        $budget = DB::table('perkiraan_budget')
            ->join('prospek_deal', 'perkiraan_budget.id_deal', 'prospek_deal.id')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->where('perkiraan_budget.id_deal', $data->deal_id)
            ->select(
                'perkiraan_budget.*',
                'prospek_project.nama_penawaran'
            )
            ->orderBy('perkiraan_budget.created_at')
            ->get();
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        return view($this->folder . '.perkiraan_budget', $params, compact('role', 'bayar', 'data', 'budget'));
    }

    public function perkiraan_budget_store(Request $request)
    {
        try {
            $data = DB::table('perkiraan_budget')
                ->where('id_deal', $request->deal_id)
                ->where('status', 1)
                ->first();
            if ($data == TRUE) {
                return redirect('/admin/prospek/deal/perkiraan/budget/' . $request->id . '')->with('errors', 'Data budget sudah ada, silahkan tunggu konfirmasi');
            } else {
                DB::table('perkiraan_budget')->insert([
                    'id_deal' => $request->deal_id,
                    'jenis_perkiraan' => $request->jenis_perkiraan,
                    'vendor' => $request->vendor,
                    'nama_perkiraan' => $request->nama_perkiraan,
                    'nilai_perkiraan' => $request->nilai_perkiraan,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
            return redirect('/admin/prospek/deal/perkiraan/budget/' . $request->id . '')->with('success', 'Data budget berhasil ditambahkan');
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function perkiraan_budget_edit_store(Request $request)
    {
        try {
            DB::table('perkiraan_budget')
                ->where('id', $request->id)
                ->update([
                    'nama_perkiraan' => $request->nama_perkiraan,
                    'nilai_perkiraan' => $request->nilai_perkiraan,
                    'updated_at' => Carbon::now(),
                ]);
            return redirect('/admin/prospek/deal/perkiraan/budget/edit/' . $request->id_deal . '')->with('success', 'Data perkiraan budget berhasil diupdate');
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function perkiraan_budget_edit($id)
    {
        $params = [
            'title' => $this->titlePage8
        ];

        $data = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'prospek_deal.id_deal',
                'prospek_deal.id AS deal_id',
                'prospek_deal.nilai_deal',
                'prospek_deal.nilai_dp',
                'prospek_deal.ppn',
                'prospek_deal.pph',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $id)->first();
        $budget = DB::table('perkiraan_budget')
            ->join('prospek_deal', 'perkiraan_budget.id_deal', 'prospek_deal.id')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->where('perkiraan_budget.id_deal', $data->deal_id)
            ->select(
                'perkiraan_budget.*',
                'prospek_project.nama_penawaran'
            )
            ->orderBy('perkiraan_budget.created_at')
            ->get();
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        return view($this->folder . '.edit_perkiraan_budget', $params, compact('role', 'bayar', 'data', 'budget', 'id'));
    }
    public function perkiraan_budget_edit_delete($id, $id_prospect)
    {
        DB::table('perkiraan_budget')->where('id', $id)->delete();
        return redirect('/admin/prospek/deal/perkiraan/budget/edit/'.$id_prospect.' ')->with('success', 'Data perkiraan budget berhasil dihapus');
    }
    public function perkiraan_budget_edit_acc($id, $id_prospect)
    {
        DB::table('perkiraan_budget')->where('id', $id)->update([
            'tgl_post' => Carbon::now(),
            'status' => 1,
        ]);
        return redirect('/admin/prospek/deal/perkiraan/budget/edit/'.$id_prospect.' ')->with('success', 'Data perkiraan budget berhasil di ACC');
    }

    public function pelunasan($id)
    {
        $params = [
            'title' => $this->titlePage7
        ];
        $get_invoice_id = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('invoice_deal', 'prospek_deal.id', '=', 'invoice_deal.id_deal')
            ->select(
                'invoice_deal.id_deal'
            )
            ->where('prospek_project.id', $id)->first();
        $invoice = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('invoice_deal', 'prospek_deal.id', '=', 'invoice_deal.id_deal')
            ->where('invoice_deal.id_deal', $get_invoice_id->id_deal)
            ->select(
                'invoice_deal.*'
            )
            ->get();
        $data = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'prospek_deal.id_deal',
                'prospek_deal.id AS deal_id',
                'prospek_deal.nilai_deal',
                'prospek_deal.nilai_dp',
                'prospek_deal.ppn',
                'prospek_deal.pph',
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
        return view($this->folder . '.pelunasan', $params, compact('role', 'bayar', 'data', 'invoice'));
    }
    public function spk_vendor($id)
    {
        $data = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'prospek_deal.id_deal',
                'prospek_deal.id AS deal_id',
                'prospek_deal.nilai_deal',
                'prospek_deal.nilai_dp',
                'prospek_deal.ppn',
                'prospek_deal.pph',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $id)->first();
        $budget_deal =  DB::table('perkiraan_budget')
            ->where('id_deal', $data->deal_id)
            ->get();
        $params = [
            'title' => 'Buat Spk Vendor'
        ];
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        return view($this->folder . '.spk_vendor', $params, compact('role', 'bayar', 'data', 'budget_deal', 'id'));
    }
    public function spk_vendor_print(Request $request)
    {
        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();
        $params = [
            'title' => 'Spk Vendor Show'
        ];
        $data = DB::table('prospek_deal')
            ->join('prospek_project', 'prospek_deal.id_prospect', '=', 'prospek_project.id')
            ->join('jenis_penawaran', 'prospek_project.id_jenis_penawaran', '=', 'jenis_penawaran.id')
            ->join('kop_surat', 'prospek_project.id_surat_penawaran', '=', 'kop_surat.id')
            ->select(
                'prospek_project.*',
                'prospek_deal.id_deal',
                'prospek_deal.id AS deal_id',
                'prospek_deal.nilai_deal',
                'prospek_deal.nilai_dp',
                'prospek_deal.ppn',
                'prospek_deal.pph',
                'jenis_penawaran.jenis_penawaran',
                'kop_surat.nama_kop_surat',
                'kop_surat.image'
            )
            ->where('prospek_project.id', $request->id)->first();
        $deal = DB::table('perkiraan_budget')
            ->where('id', $request->id_budget)
            ->first();
        $deathline = $request->deathline;
        $deskripsi = $request->deskripsi;

        return view($this->folder . '.spkShow', $params, compact('role', 'bayar', 'deal', 'deathline', 'deskripsi', 'data'));

    }

}

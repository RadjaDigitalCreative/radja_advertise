<?php

namespace App\Http\Controllers\Asiaone;

use App\Model\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SuratPenawaranController extends Controller
{
    protected $folder = 'backend.asiaone.suratPenawaran';
    protected $rdr = '/admin/prospek/surat_penawaran';
    private $titlePage = 'Kop Surat Penawaran';
    private $titlePage2 = 'Tambah Kop Surat Penawaran';
    private $titlePage3 = 'Update Kop Surat Penawaran';


    public function index(Request $request)
    {
        $params = [
            'title' => $this->titlePage
        ];
        $data = DB::table('kop_surat')->get();
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

        $role = DB::table('role')
            ->join('users', 'role.user_id', '=', 'users.id')
            ->get();
        $bayar = DB::table('users')
            ->join('role_payment', 'users.id', '=', 'role_payment.user_id')
            ->get();

        return view($this->folder . '.create', $params, compact('role', 'bayar'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'no_surat' => 'required',
                'nama_kop_surat' => 'required'
            ]);
            if (empty($request->file('image'))) {
                DB::table('kop_surat')
                    ->insert([
                        'no_surat' => $request->no_surat,
                        'nama_kop_surat' => $request->nama_kop_surat,
                        'alamat' => $request->alamat,
                        'notelp' => $request->notelp,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                return redirect($this->rdr)->with('success', 'Data berhasil ditambahkan');
            }
            elseif ($request->file('image') && empty($request->file('image2'))) {
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                DB::table('kop_surat')
                    ->insert([
                        'no_surat' => $request->no_surat,
                        'nama_kop_surat' => $request->nama_kop_surat,
                        'alamat' => $request->alamat,
                        'notelp' => $request->notelp,
                        'image' => $new_name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                return redirect($this->rdr)->with('success', 'Data berhasil ditambahkan');
            }
            elseif ($request->file('image') && $request->file('image2')) {
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $image2 = $request->file('image2');
                $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
                $image2->move(public_path('images'), $new_name2);
                DB::table('kop_surat')
                    ->insert([
                        'no_surat' => $request->no_surat,
                        'nama_kop_surat' => $request->nama_kop_surat,
                        'alamat' => $request->alamat,
                        'notelp' => $request->notelp,
                        'image' => $new_name,
                        'image2' => $new_name2,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                return redirect($this->rdr)->with('success', 'Data berhasil ditambahkan');
            }
        } catch (\Exception $e) {
            return redirect($this->rdr)->with('warning', 'Data hancur parah');
        }
    }

    public function delete($id)
    {
        DB::table('kop_surat')->where('id', $id)->delete();
        return redirect($this->rdr)->with('success', 'Data Berhasil di hapus');
    }
}

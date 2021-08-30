<?php

namespace App\Http\Controllers\Asiaone;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class JenisPenawaranController extends Controller
{
    protected $folder = 'backend.asiaone.jenisPenawaran';
    protected $rdr = '/admin/prospek/jenis_penawaran';
    private $titlePage = 'Jenis Penawaran';
    private $titlePage2 = 'Tambah Jenis Penawaran';
    private $titlePage3 = 'Update Jenis Penawaran';


    public function index(Request $request)
    {
        $data = DB::table('jenis_penawaran')->orderBy('created_at', 'desc')->get();

        $params = [
            'title' => $this->titlePage
        ];
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
                'name' => 'required'
            ]);
            $data = DB::table('jenis_penawaran')->where('jenis_penawaran', $request->name)->first();
            if ($data == TRUE) {
                return redirect($this->rdr)->with('warning', 'Data Sudah Ada!!!');
            } else {
                DB::table('jenis_penawaran')->insert([
                    'jenis_penawaran' => $request->name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }

            return redirect($this->rdr)->with('success', 'Data Berhasil di tambahkan');
        } catch (\Exception $e) {
            return redirect($this->rdr)->with('warning', 'Data hancur parah');
        }
    }

    public function delete($id)
    {
        DB::table('jenis_penawaran')->where('id', $id)->delete();
        return redirect($this->rdr)->with('success', 'Data Berhasil di hapus');
    }
}

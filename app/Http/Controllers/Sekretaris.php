<?php

namespace App\Http\Controllers;


use App\Models\BerkasModel;
use App\Models\TugasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Sekretaris extends Controller
{
    public function verifikasiBerkas($idUser = null)
    {
        if (!$idUser) {
            $data['berkas'] = BerkasModel::all();
            $data['pegawai'] = User::where('role', 'pegawai')->get();
            return view('pages.sekretaris.list_pegawai', $data);
        } else {
            $data['berkas'] = BerkasModel::all();
            $data['pegawai'] = User::where('role', 'pegawai')->get();
            $user = User::where('id', $idUser)->first();
            $data['id_user'] = $user->id;
            $data['tugas'] = TugasModel::where('id_jabatan', $user->id_jabatan)->get();
            return view('pages.sekretaris.verifikasi_berkas', $data);
        }
    }

    public function approveBerkas($idBerkas)
    {
        $berkas = BerkasModel::where('id_berkas', $idBerkas);
        $berkas->update([
            'status' => '1',
        ]);

        return redirect()->back()->with('message', 'berkasi Berhasil di approve');
    }

    public function pendingBerkas($idBerkas)
    {
        $berkas = BerkasModel::where('id_berkas', $idBerkas);
        $berkas->update([
            'status' => '0',
        ]);

        return redirect()->back()->with('message', 'berkasi Berhasil di pending');
    }
}

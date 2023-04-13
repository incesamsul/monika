<?php

namespace App\Http\Controllers;


use App\Models\BerkasModel;
use App\Models\TugasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Pegawai extends Controller
{
    public function uploadBerkas()
    {
        $data['tugas'] = TugasModel::where('id_jabatan', auth()->user()->id_jabatan)->get();
        $data['berkas'] = BerkasModel::where('id_user', auth()->user()->id)->first();
        return view('pages.pegawai.upload_berkas', $data);
    }

    public function tugas()
    {
        $data['tugas'] = TugasModel::where('id_jabatan', auth()->user()->id_jabatan)->get();
        return view('pages.pegawai.tugas', $data);
    }

    public function createUploadBerkas(Request $request)
    {
        $berkas = $request->file('berkas');
        $format = $berkas->extension();
        $fileName = uniqid() . '.' . $format;
        $berkas->move(public_path('data/berkas'), $fileName);
        $berkas = BerkasModel::where('id_user', auth()->user()->id)
            ->where('bulan', $request->bulan)
            ->where('id_tugas', $request->id_tugas);
        if (!$berkas->first()) {
            BerkasModel::create([
                'id_user' => auth()->user()->id,
                'berkas' => $fileName,
                'bulan' => $request->bulan,
                'id_tugas' => $request->id_tugas,
            ]);
        }

        return redirect()->back()->with('message', 'berkasi Berhasil di upload');
    }


    public function hapusBerkas($idBerkas)
    {
        BerkasModel::where('id_berkas', $idBerkas)->delete();
        return redirect()->back()->with('message', 'berkasi Berhasil di hapus');
    }
}

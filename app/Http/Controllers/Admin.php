<?php

namespace App\Http\Controllers;

use App\Models\JabatanModel;
use App\Models\TugasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Admin extends Controller
{

    protected $userModel;
    protected $profileUserModel;
    protected $kritikSaranModel;
    protected $kuisionerModel;
    protected $penilaianModel;


    public function __construct()
    {
        $this->userModel = new User();
    }

    public function pengguna()
    {
        $data['jabatan'] = JabatanModel::all();
        $data['pengguna'] = $this->userModel->getAllUser();
        return view('pages.pengguna.index', $data);
    }

    public function jabatan()
    {
        $data['jabatan'] = JabatanModel::all();
        return view('pages.jabatan.index', $data);
    }

    public function tugas($idJabtan = null)
    {
        if ($idJabtan) {
            $data['tugas'] = TugasModel::where('id_jabatan', $idJabtan)->get();
            $data['jabatan'] = JabatanModel::where('id_jabatan', $idJabtan)->first();
            return view('pages.tugas.perjabatan', $data);
        } else {
            $data['jabatan'] = JabatanModel::all();
            return view('pages.tugas.index', $data);
        }
    }


    public function profileUser()
    {
        $data['user'] = User::all();
        $data['profile'] = $this->profileUserModel->getProfileUser();
        return view('pages.rekaptulasi_data.index', $data);
    }






    // fetch data user by admin
    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            if ($request->filter == "") {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            } else {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('role', '=', $request->filter)
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            }

            return view('pages.pengguna.users_data', $data)->render();
        }
    }

    // CRUD TUGAS

    public function createTugas(Request $request)
    {
        $bulan = implode(",", $request->bulan);
        TugasModel::create([
            'id_jabatan' => $request->id_jabatan,
            'tugas' => $request->tugas,
            'bulan' => $bulan,
        ]);
        return redirect()->back()->with('message', 'tugas Berhasil di tambahkan');
    }

    public function updateTugas(Request $request)
    {
        $bulan = implode(",", $request->bulan);
        TugasModel::where('id_tugas', $request->id)->update([
            'tugas' => $request->tugas,
            'bulan' => $bulan,
        ]);
        return redirect()->back()->with('message', 'tugas Berhasil di update');
    }

    public function deleteTugas(Request $request)
    {
        TugasModel::where('id_tugas', $request->id_tugas)->delete();
        return 1;
    }

    public function aktifkanTugas($idTugas)
    {
        TugasModel::where('id_tugas', $idTugas)->update([
            'status' => '1'
        ]);
        return redirect()->back()->with('message', 'tugas aktif');
    }

    public function matikanTugas($idTugas)
    {
        TugasModel::where('id_tugas', $idTugas)->update([
            'status' => '0'
        ]);
        return redirect()->back()->with('message', 'tugas aktif');
    }

    // CRUD JABATAN

    public function createJabatan(Request $request)
    {
        JabatanModel::create([
            'nama_jabatan' => $request->nama_jabatan,
        ]);
        return redirect()->back()->with('message', 'jabatan Berhasil di tambahkan');
    }

    public function updateJabatan(Request $request)
    {
        JabatanModel::where('id_jabatan', $request->id)->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);
        return redirect()->back()->with('message', 'jabatan Berhasil di update');
    }

    public function deleteJabatan(Request $request)
    {
        JabatanModel::where('id_jabatan', $request->id_jabatan)->delete();
        return 1;
    }

    // CRUD PENGGUNA
    public function createPengguna(Request $request)
    {
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'id_jabatan' => $request->jabatan,
            'password' => bcrypt($request->email),
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di tambahkan');
    }

    public function updatePengguna(Request $request)
    {
        $user = User::where([
            ['id', '=', $request->id]
        ])->first();
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di update');
    }

    public function deletePengguna(Request $request)
    {
        User::destroy($request->post('user_id'));
        return 1;
    }
}

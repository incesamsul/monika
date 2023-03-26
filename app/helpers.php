<?php

use App\Models\BerkasModel;
use App\Models\FavoritModel;
use App\Models\KategoriModel;
use App\Models\LogAktivitasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isNull;


function cekBerkas($bulan, $idTugas, $idUser)
{
    $berkas = BerkasModel::where('id_user', $idUser)
        ->where('bulan', $bulan)
        ->where('id_tugas', $idTugas);
    if ($berkas->first()) {
        return 1;
    } else {
        return 0;
    }
}

function getBerkas($bulan, $idTugas, $idUser)
{
    $berkas = BerkasModel::where('id_user', $idUser)
        ->where('bulan', $bulan)
        ->where('id_tugas', $idTugas);
    return $berkas->first();
}

function getMonth()
{
    return ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
}

function removeSpace($string)
{
    return str_replace(" ", "", $string);
}

function getUserRoleName($userRoleId)
{
    return DB::table('users')
        ->Join('role', 'role.id_role', '=', 'users.id_role')
        ->where('users.id_role', $userRoleId)
        ->select('nama_role')
        ->first()->nama_role;
}


function sweetAlert($pesan, $tipe)
{
    echo '<script>document.addEventListener("DOMContentLoaded", function() {
        Swal.fire(
            "' . $pesan . '",
            "proses berhasil di lakukan",
            "' . $tipe . '",
        );
    })</script>';
}

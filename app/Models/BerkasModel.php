<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasModel extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}

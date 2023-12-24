<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = "Presensi";
    protected $primaryKey = "presence_id";

    protected $fillable = [
        'presence_id',
        'nip',
        'presence_date',
        'time_in',
        'time_out',
    ];
}

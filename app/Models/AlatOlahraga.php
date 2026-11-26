<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AlatOlahraga extends Model
{
    protected $table = 'alat_olahraga';
    public $timestamps = false;
    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'jenis_alat',
        'kondisi',
        'tarif_sewa'
    ];
}

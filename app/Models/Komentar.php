<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'posting_komentar';

    protected $primaryKey = 'komen_id';

    protected $fillable = [
        'posting_id',
        'id_user',
        'komentar_text',
        'komentar_gambar',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    public function posting()
    {
        return $this->belongsTo(Posting::class, 'posting_id', 'posting_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'create_by', 'id_user');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'update_by', 'id_user');
    }
}

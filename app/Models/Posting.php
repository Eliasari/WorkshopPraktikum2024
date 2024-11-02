<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    use HasFactory;
    protected $table = 'postings';
    protected $primaryKey = 'posting_id';

    protected $fillable = [
        'sender',
        'message_text',
        'message_gambar',
        'create_by',
        'delete_mark',
        'update_by',
    ];


    public function senderBy()
    {
        return $this->belongsTo(User::class, 'sender', 'id_user');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'create_by', 'id_user');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'update_by', 'id_user');
    }

    public function likes()
    {
        return $this->hasMany(Likes::class, 'posting_id', 'posting_id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'posting_id', 'posting_id');
    }
}

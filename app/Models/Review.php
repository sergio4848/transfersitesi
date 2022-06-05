<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable=[
        'transfer_id',
        'user_id',
        'IP',
        'subject',
        'review',
    ];

    public function transfer(){
        return $this->belongsTo(Transfer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'IP',
        'pickupTime',
        'flightDate',
        'flightTime',
        'note',
        'transfer_id',
        'price',
        'fromlocation',
        'tolocation',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }


}

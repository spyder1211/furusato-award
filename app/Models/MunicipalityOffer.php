<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MunicipalityOffer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'status',
        'note',
    ];

    /**
     * Get the sender (municipality user) of the offer.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver (municipality user) of the offer.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}

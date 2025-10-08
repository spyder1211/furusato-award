<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyOffer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_id',
        'municipality_user_id',
        'message',
        'status',
        'note',
    ];

    /**
     * Get the company service associated with this offer.
     */
    public function companyService()
    {
        return $this->belongsTo(CompanyService::class, 'service_id');
    }

    /**
     * Get the municipality user who sent this offer.
     */
    public function municipality()
    {
        return $this->belongsTo(User::class, 'municipality_user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyService extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'description',
        'case_studies',
        'strengths',
        'status',
    ];

    /**
     * Get the user that owns the company service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the company service.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the company offers for this service.
     */
    public function companyOffers()
    {
        return $this->hasMany(CompanyOffer::class, 'service_id');
    }
}

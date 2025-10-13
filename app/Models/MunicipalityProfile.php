<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MunicipalityProfile extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'prefecture',
        'city',
        'population',
        'characteristics',
        'election_count',
        'birthplace',
        'university',
        'philosophy',
        'expertise',
        'furusato_tax_amount',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'population' => 'decimal:2',
            'election_count' => 'integer',
            'furusato_tax_amount' => 'integer',
        ];
    }

    /**
     * Get the user that owns the municipality profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * the fillable model atts
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * the guarded model atts
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     * fetch the relation
     *
     * @return HasMany
     */
    public function jobs() : HasMany
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }
}

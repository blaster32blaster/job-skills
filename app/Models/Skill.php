<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    /**
     * the fillable model atts
     *
     * @var array
     */
    protected $fillable = [
        'title',
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
     * return the relation
     *
     * @return BelongsToMany
     */
    public function jobs() : BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_skills', 'skill_id', 'job_id');
    }
}

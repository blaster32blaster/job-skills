<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSkill extends Model
{
    use HasFactory;

    /**
     * the fillable model atts
     *
     * @var array
     */
    protected $fillable = [
        'job_id',
        'skill_id'
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

    protected $table = 'job_skills';

    /**
     * fetch the relation
     *
     * @return BelongsTo
     */
    public function job() : BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * fetch the relation
     *
     * @return BelongsTo
     */
    public function skill() : BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}

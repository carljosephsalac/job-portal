<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $table = 'job_posts';

    protected $fillable = [
        'user_id',
        'title',
        'salary',
        'type',
        'location',
        'company',
        'description',
    ];

    /**
     * Get the user that owns the job post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'active',
        'addeduid',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * Get the user that added the newsletter.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'addeduid');
    }

    /**
     * Get the subscribers of the newsletter.
     */
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'newsletters_subscribers', 'newsletter_id', 'user_id')
                    ->withTimestamps();
    }
}

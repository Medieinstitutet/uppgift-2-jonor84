<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NewslettersSubscriber extends Pivot
{
    protected $table = 'newsletters_subscribers';
    public $timestamps = true;

}

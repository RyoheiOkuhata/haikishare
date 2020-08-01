<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model {//ok
    public function product(): BelongsTo
    {
    return $this->belongsTo('App\Product');
    }
}
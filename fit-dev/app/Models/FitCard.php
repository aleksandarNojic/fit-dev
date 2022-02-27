<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;

class FitCard extends Model
{
    use Uuids, HasFactory;

    /**
     * Get the fitCards for the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

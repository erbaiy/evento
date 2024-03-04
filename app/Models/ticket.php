<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $table = 'ticket';
    protected $fillable =
    [
        'reservation_id',
        'token',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

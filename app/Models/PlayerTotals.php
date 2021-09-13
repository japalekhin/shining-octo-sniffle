<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerTotals extends Model
{
    use HasFactory;

    protected $table = 'player_totals';

    protected $primaryKey = 'player_id';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;
}

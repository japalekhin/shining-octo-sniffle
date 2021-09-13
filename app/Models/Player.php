<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Player extends Model
{
    use HasFactory;

    protected $table = 'roster';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_code', 'code');
    }

    public function totals()
    {
        return $this->hasOne(PlayerTotals::class, 'player_id', 'id');
    }

    public function getThreePointAccuracyDisplayAttribute()
    {
        return number_format($this->three_point_accuracy * 100, 2) . '%';
    }

    public function scopeAge($query)
    {
        return $query->addSelect([
            'age' => DB::raw('*, YEAR(CURDATE()) - YEAR(`dob`) - (RIGHT(CURDATE(), 5) < RIGHT(`dob`, 5)) AS `age`'),
        ]);
    }

    public function scopeIsOrOlderThan($query, $age)
    {
        return $query->having('age', '>=', $age);
    }

    public function scopeThreePointStats($query)
    {
        return $query
            ->leftJoin('player_totals', function ($join) {
                $join->on('roster.id', '=', 'player_totals.player_id');
            })
            ->addSelect(DB::raw('IF(`3pt_attempted` = 0, 0, `3pt` / `3pt_attempted`) AS `three_point_accuracy`, FLOOR(IF(`3pt_attempted` = 0, 0, `3pt` / `3pt_attempted`) * `3pt_attempted` * 3) AS `three_point_total`'));
    }
}

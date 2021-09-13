<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ReportsController extends Controller
{
    public static function setupRoutes()
    {
        Route::prefix('/reports')->group(function () {
            Route::get('/', [__CLASS__, 'getIndex']);
            Route::get('/30-3-pointers', [__CLASS__, 'get30AndUp3Pointers']);
            Route::get('/team-3-pointers', [__CLASS__, 'getTeam3Pointers']);
        });
    }

    public function getIndex(Request $request)
    {
        return view('reports.index');
    }

    public function get30AndUp3Pointers(Request $request)
    {
        $players = Player::with(['team'])
            ->age()
            ->isOrOlderThan(30)
            ->threePointStats()
            ->orderBy('three_point_accuracy', 'DESC')
            ->having('three_point_accuracy', '>', .35)
            ->get();

        return view('reports.gte-30-3-pointers', [
            'players' => $players,
            'reportKey' => '30-3-pointers',
        ]);
    }

    public function getTeam3Pointers(Request $request)
    {
        // SELECT
        //     `t`.*,
        //     AVG(IF(`tpt`.`3pt_attempted` = 0, 0, `tpt`.`3pt` / `tpt`.`3pt_attempted`)) AS `three_pt_accuracy`,
        //     SUM(`tpt`.`3pt`) AS `three_pt_total`,
        //     COUNT(`cpt`.`player_id`) AS `contributors`,
        //     COUNT(`apt`.`player_id`) AS `contributor_attempts`,
        //     COUNT(`fpt`.`player_id`) AS `contributor_failures`
        // FROM
        //     `team` AS `t`
        //     LEFT JOIN `roster` AS `r` ON `t`.`code` = `r`.`team_code`
        //     LEFT JOIN `player_totals` AS `tpt` ON `r`.`id` = `tpt`.`player_id`
        //     LEFT JOIN `player_totals` AS `cpt` ON `r`.`id` = `cpt`.`player_id` AND `cpt`.`3pt` > 0  
        //     LEFT JOIN `player_totals` AS `apt` ON `r`.`id` = `apt`.`player_id` AND `apt`.`3pt_attempted` > 0
        //     LEFT JOIN `player_totals` AS `fpt` ON `r`.`id` = `fpt`.`player_id` AND `fpt`.`3pt` = 0
        // GROUP BY
        //     `t`.`code`
        // ORDER BY
        //     `3pt_accuracy` DESC

        $teams = DB::table('team')
            ->leftJoin('roster', 'team.code', '=', 'roster.team_code')
            ->leftJoin('player_totals AS tpt', 'roster.id', '=', 'tpt.player_id')
            ->leftJoin('player_totals AS cpt', function ($join) {
                $join
                    ->on('roster.id', '=', 'cpt.player_id')
                    ->on('cpt.3pt', '>', DB::raw(0));
            })
            ->leftJoin('player_totals AS apt', function ($join) {
                $join
                    ->on('roster.id', '=', 'apt.player_id')
                    ->on('apt.3pt_attempted', '>', DB::raw(0));
            })
            ->leftJoin('player_totals AS fpt', function ($join) {
                $join
                    ->on('roster.id', '=', 'fpt.player_id')
                    ->on('fpt.3pt', '=', DB::raw(0));
            })
            ->select([
                'team.*',
                DB::raw('AVG(IF(`tpt`.`3pt_attempted` = 0, 0, `tpt`.`3pt` / `tpt`.`3pt_attempted`)) AS `three_pt_accuracy`'),
                DB::raw('SUM(`tpt`.`3pt`) AS `three_pt_total`'),
                DB::raw('COUNT(`cpt`.`player_id`) AS `contributors`'),
                DB::raw('COUNT(`apt`.`player_id`) AS `contributor_attempts`'),
                DB::raw('COUNT(`fpt`.`player_id`) AS `contributor_failures`'),
            ])
            ->groupBy('team.code')
            ->orderBy('three_pt_accuracy', 'DESC')
            ->get();

        $accuracyDisplay = [];
        foreach ($teams as $team) {
            $accuracyDisplay[$team->code] = number_format($team->three_pt_accuracy * 100, 2) . '%';
        }

        return view('reports.team-3-pointers', [
            'teams' => $teams,
            'accuracyDisplay' => $accuracyDisplay,
            'reportKey' => 'team-3-pointers',
        ]);
    }
}

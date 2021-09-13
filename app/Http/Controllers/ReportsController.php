<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('reports.gte-30-3-pointers', [
            'reportKey' => '30-3-pointers',
        ]);
    }

    public function getTeam3Pointers(Request $request)
    {
        return view('reports.team-3-pointers', [
            'reportKey' => 'team-3-pointers',
        ]);
    }
}

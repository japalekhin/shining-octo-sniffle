<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ExportController extends Controller
{
    public static function setupRoutes()
    {
        Route::get('/export', [__CLASS__, 'getIndex']);
    }

    public function getIndex(Request $request)
    {
        return view('export');
    }
}

@extends('layouts.global')

@section('content')
    <div class="flex-grow flex flex-col items-center justify-center">
        <div class="my-6">
            <a href="/reports" class="bg-indigo-800 text-white text-lg px-6 py-4 rounded">View Reports</a>
        </div>
        <div class="my-6">
            <a href="/export" class="bg-indigo-800 text-white text-lg px-6 py-4 rounded">Export Data</a>
        </div>
    </div>
@endsection

@extends('layouts.global')

@section('content')
    <div class="container px-4 md:px-16 mx-auto py-16">
        <div class="flex flex-col md:flex-row md:items-center">
            <h1 class="text-3xl text-center md:text-left mb-2 md:mb-0 md:mr-6">Reports</h1>
            <div class="flex flex-row">
                <a href="/reports/30-3-pointers"
                    class="inline-block flex-grow md:flex-grow-0 @if (isset($reportKey) && $reportKey == '30-3-pointers') bg-indigo-800 text-white @else hover:bg-gray-200 @endif text-center text-lg px-6 py-2">&GreaterEqual;30
                    3-pointers</a>
                <a href="/reports/team-3-pointers"
                    class="inline-block flex-grow md:flex-grow-0 @if (isset($reportKey) && $reportKey == 'team-3-pointers') bg-indigo-800 text-white @else hover:bg-gray-200 @endif text-center text-lg px-6 py-2">Team
                    3-pointers</a>
            </div>
        </div>

        @yield('report-content')
    </div>
@endsection

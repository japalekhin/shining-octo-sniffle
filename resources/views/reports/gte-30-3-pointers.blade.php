@extends('layouts.reports')

@section('report-content')
    <table class="w-full mt-6">
        <thead>
            <tr>
                <th class="text-left">Player</th>
                <th class="text-left">Team</th>
                <th class="text-right">Age</th>
                <th class="text-right">3P Acc<span class="hidden md:inline">uracy<span></th>
                <th class="text-right">3P Att<span class="hidden md:inline">empts<span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
                <tr>
                    <td class="text-left">
                        <span class="text-gray-600">#{{ $player->number }}</span>
                        <span class="font-medium">{{ $player->name }}</span>
                        ({{ $player->pos }})
                    </td>
                    <td class="text-left">{{ $player->team->name }}</td>
                    <td class="text-right">{{ $player->age }}</td>
                    <td class="text-right">
                        {{ $player->threePointAccuracyDisplay }}
                        <span class="text-gray-600">({{ $player->three_point_total }})</span>
                    </td>
                    <td class="text-right">{{ $player['3pt_attempted'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@extends('layouts.reports')

@section('report-content')
    <table class="w-full mt-6">
        <thead>
            <tr>
                <th class="text-left">Team</th>
                <th class="text-right">3P Acc<span class="hidden md:inline">uracy<span></th>
                <th class="text-right">3P T<span class="hidden md:inline">o<span>t<span class="hidden md:inline">a<span>l
                </th>
                <th class="text-right">Cont<span class="hidden md:inline">ributors<span></th>
                <th class="text-right">Att<span class="hidden md:inline">empting<span> Pl<span
                                class="hidden md:inline">ayers<span></th>
                <th class="text-right">Fail<span class="hidden md:inline">ed<span> Att<span
                                class="hidden md:inline">empts<span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $team)
                <tr>
                    <td class="text-left">{{ $team->name }}</td>
                    <td class="text-right">{{ $accuracyDisplay[$team->code] }}</td>
                    <td class="text-right">{{ $team->three_pt_total }}</td>
                    <td class="text-right">{{ $team->contributors }}</td>
                    <td class="text-right">{{ $team->contributor_attempts }}</td>
                    <td class="text-right">{{ $team->contributor_failures }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

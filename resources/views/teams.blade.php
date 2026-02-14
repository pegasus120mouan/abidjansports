@extends('layouts.app')

@section('title', 'Équipes - Abidjansports')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-xl p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Équipes & Classements</h1>
        <p class="text-green-200">Découvrez les équipes ivoiriennes et leurs performances</p>
    </div>

    {{-- League Selector --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <button class="px-6 py-2 bg-orange-600 text-white rounded-full font-semibold">Ligue 1 Ivoirienne</button>
        <button class="px-6 py-2 bg-white text-gray-700 rounded-full font-semibold hover:bg-gray-100 transition">Ligue 2</button>
        <button class="px-6 py-2 bg-white text-gray-700 rounded-full font-semibold hover:bg-gray-100 transition">Coupe Nationale</button>
        <button class="px-6 py-2 bg-white text-gray-700 rounded-full font-semibold hover:bg-gray-100 transition">CAF Champions League</button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Full Standings --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="bg-gray-900 text-white px-6 py-4">
                    <h2 class="text-xl font-bold">Classement Ligue 1 Ivoirienne 2024-2025</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="text-gray-500 text-sm">
                                <th class="text-left py-3 px-4">#</th>
                                <th class="text-left py-3 px-4">Équipe</th>
                                <th class="text-center py-3 px-2">J</th>
                                <th class="text-center py-3 px-2">G</th>
                                <th class="text-center py-3 px-2">N</th>
                                <th class="text-center py-3 px-2">P</th>
                                <th class="text-center py-3 px-2">BP</th>
                                <th class="text-center py-3 px-2">BC</th>
                                <th class="text-center py-3 px-2">Diff</th>
                                <th class="text-center py-3 px-4">Pts</th>
                                <th class="text-center py-3 px-4">Forme</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fullStandings as $index => $team)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition {{ $index < 3 ? 'bg-green-50' : ($index >= count($fullStandings) - 3 ? 'bg-red-50' : '') }}">
                                <td class="py-4 px-4">
                                    <span class="w-6 h-6 flex items-center justify-center rounded-full text-sm font-bold 
                                        {{ $index < 3 ? 'bg-green-600 text-white' : ($index >= count($fullStandings) - 3 ? 'bg-red-600 text-white' : 'bg-gray-200') }}">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-{{ $team['color'] }} rounded-full flex items-center justify-center font-bold text-white text-xs">
                                            {{ $team['abbr'] }}
                                        </div>
                                        <span class="font-semibold">{{ $team['name'] }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-2 text-center text-gray-600">{{ $team['played'] }}</td>
                                <td class="py-4 px-2 text-center text-gray-600">{{ $team['won'] }}</td>
                                <td class="py-4 px-2 text-center text-gray-600">{{ $team['drawn'] }}</td>
                                <td class="py-4 px-2 text-center text-gray-600">{{ $team['lost'] }}</td>
                                <td class="py-4 px-2 text-center text-gray-600">{{ $team['goals_for'] }}</td>
                                <td class="py-4 px-2 text-center text-gray-600">{{ $team['goals_against'] }}</td>
                                <td class="py-4 px-2 text-center font-semibold {{ $team['goal_diff'] > 0 ? 'text-green-600' : ($team['goal_diff'] < 0 ? 'text-red-600' : '') }}">
                                    {{ $team['goal_diff'] > 0 ? '+' : '' }}{{ $team['goal_diff'] }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="text-lg font-bold">{{ $team['points'] }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex gap-1">
                                        @foreach($team['form'] as $result)
                                        <span class="w-5 h-5 rounded text-xs font-bold flex items-center justify-center
                                            {{ $result == 'W' ? 'bg-green-500 text-white' : ($result == 'L' ? 'bg-red-500 text-white' : 'bg-gray-400 text-white') }}">
                                            {{ $result }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- Legend --}}
                <div class="px-6 py-4 bg-gray-50 flex flex-wrap gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-4 h-4 bg-green-600 rounded"></span>
                        <span class="text-gray-600">Qualification CAF Champions League</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-4 h-4 bg-red-600 rounded"></span>
                        <span class="text-gray-600">Relégation</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="space-y-8">
            {{-- Top Scorers --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-orange-600 rounded"></span>
                    Meilleurs Buteurs
                </h3>
                <div class="space-y-3">
                    @foreach($topScorers as $index => $player)
                    <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition">
                        <span class="w-6 h-6 flex items-center justify-center bg-{{ $index < 3 ? 'orange' : 'gray' }}-{{ $index < 3 ? '600' : '200' }} text-{{ $index < 3 ? 'white' : 'gray-600' }} rounded-full text-sm font-bold">
                            {{ $index + 1 }}
                        </span>
                        <div class="flex-1">
                            <p class="font-semibold text-sm">{{ $player['name'] }}</p>
                            <p class="text-xs text-gray-500">{{ $player['team'] }}</p>
                        </div>
                        <span class="text-lg font-bold text-orange-600">{{ $player['goals'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Top Assists --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-blue-600 rounded"></span>
                    Meilleurs Passeurs
                </h3>
                <div class="space-y-3">
                    @foreach($topAssists as $index => $player)
                    <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition">
                        <span class="w-6 h-6 flex items-center justify-center bg-{{ $index < 3 ? 'blue' : 'gray' }}-{{ $index < 3 ? '600' : '200' }} text-{{ $index < 3 ? 'white' : 'gray-600' }} rounded-full text-sm font-bold">
                            {{ $index + 1 }}
                        </span>
                        <div class="flex-1">
                            <p class="font-semibold text-sm">{{ $player['name'] }}</p>
                            <p class="text-xs text-gray-500">{{ $player['team'] }}</p>
                        </div>
                        <span class="text-lg font-bold text-blue-600">{{ $player['assists'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Featured Team --}}
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-6 text-white">
                <h3 class="text-lg font-bold mb-4">Équipe à la Une</h3>
                <div class="text-center">
                    <div class="w-20 h-20 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-3xl font-bold text-yellow-600">AS</span>
                    </div>
                    <h4 class="text-xl font-bold">ASEC Mimosas</h4>
                    <p class="text-yellow-200 text-sm mb-4">Leader du championnat</p>
                    <div class="grid grid-cols-3 gap-2 text-center">
                        <div class="bg-white/20 rounded-lg p-2">
                            <p class="text-2xl font-bold">18</p>
                            <p class="text-xs">Matchs</p>
                        </div>
                        <div class="bg-white/20 rounded-lg p-2">
                            <p class="text-2xl font-bold">42</p>
                            <p class="text-xs">Points</p>
                        </div>
                        <div class="bg-white/20 rounded-lg p-2">
                            <p class="text-2xl font-bold">+18</p>
                            <p class="text-xs">Diff</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection

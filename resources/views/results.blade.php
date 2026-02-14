@extends('layouts.app')

@section('title', 'Résultats - Abidjansports')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Résultats & Scores</h1>
        <p class="text-gray-400">Suivez tous les résultats des compétitions sportives</p>
    </div>

    {{-- Filter Tabs --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <button class="px-6 py-2 bg-orange-600 text-white rounded-full font-semibold">Tous</button>
        <button class="px-6 py-2 bg-white text-gray-700 rounded-full font-semibold hover:bg-gray-100 transition">Football</button>
        <button class="px-6 py-2 bg-white text-gray-700 rounded-full font-semibold hover:bg-gray-100 transition">Basketball</button>
        <button class="px-6 py-2 bg-white text-gray-700 rounded-full font-semibold hover:bg-gray-100 transition">Athlétisme</button>
    </div>

    {{-- Live Matches --}}
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
            Matchs en Direct
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($liveMatches as $match)
            <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-red-500">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-gray-500">{{ $match['competition'] }}</span>
                    <span class="bg-red-100 text-red-600 px-2 py-0.5 rounded text-xs font-semibold animate-pulse">
                        EN DIRECT • {{ $match['minute'] }}'
                    </span>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-{{ $match['home_color'] }} rounded-full flex items-center justify-center font-bold text-white text-sm">
                                {{ $match['home_abbr'] }}
                            </div>
                            <span class="font-semibold">{{ $match['home_team'] }}</span>
                        </div>
                        <span class="text-2xl font-bold {{ $match['home_score'] > $match['away_score'] ? 'text-green-600' : '' }}">
                            {{ $match['home_score'] }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-{{ $match['away_color'] }} rounded-full flex items-center justify-center font-bold text-white text-sm">
                                {{ $match['away_abbr'] }}
                            </div>
                            <span class="font-semibold">{{ $match['away_team'] }}</span>
                        </div>
                        <span class="text-2xl font-bold {{ $match['away_score'] > $match['home_score'] ? 'text-green-600' : '' }}">
                            {{ $match['away_score'] }}
                        </span>
                    </div>
                </div>
                
                @if(count($match['scorers']) > 0)
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <p class="text-xs text-gray-500">
                        ⚽ {{ implode(', ', $match['scorers']) }}
                    </p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </section>

    {{-- Today's Results --}}
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <span class="w-1 h-8 bg-green-600 rounded"></span>
            Résultats du Jour
        </h2>
        
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            @foreach($todayResults as $competition => $matches)
            <div class="border-b border-gray-100 last:border-0">
                <div class="bg-gray-50 px-5 py-3">
                    <h3 class="font-semibold text-gray-700">{{ $competition }}</h3>
                </div>
                
                @foreach($matches as $match)
                <div class="px-5 py-4 flex items-center justify-between hover:bg-gray-50 transition">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="text-right w-32">
                            <span class="font-semibold">{{ $match['home_team'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-gray-900 text-white px-4 py-2 rounded-lg">
                            <span class="text-xl font-bold">{{ $match['home_score'] }}</span>
                            <span class="text-gray-400">-</span>
                            <span class="text-xl font-bold">{{ $match['away_score'] }}</span>
                        </div>
                        <div class="w-32">
                            <span class="font-semibold">{{ $match['away_team'] }}</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-sm text-gray-500">{{ $match['status'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>

    {{-- Upcoming Matches --}}
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <span class="w-1 h-8 bg-blue-600 rounded"></span>
            Matchs à Venir
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($upcomingMatches as $match)
            <div class="bg-white rounded-xl shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-gray-500">{{ $match['competition'] }}</span>
                    <span class="bg-blue-100 text-blue-600 px-2 py-0.5 rounded text-xs font-semibold">
                        {{ $match['date'] }} • {{ $match['time'] }}
                    </span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-600">
                            {{ $match['home_abbr'] }}
                        </div>
                        <span class="font-semibold">{{ $match['home_team'] }}</span>
                    </div>
                    
                    <div class="px-4">
                        <span class="text-gray-400 font-bold">VS</span>
                    </div>
                    
                    <div class="flex items-center gap-3 flex-1 justify-end">
                        <span class="font-semibold">{{ $match['away_team'] }}</span>
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-600">
                            {{ $match['away_abbr'] }}
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-500">📍 {{ $match['venue'] }}</span>
                    <button class="text-orange-600 hover:text-orange-700 text-sm font-semibold">
                        🔔 Rappel
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection

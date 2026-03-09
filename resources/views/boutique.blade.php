@extends('layouts.app')

@section('title', 'Boutique - Abidjansports')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-orange-600 to-orange-800 rounded-xl p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Boutique</h1>
        <p class="text-orange-200">Retrouvez tous nos journaux sportifs</p>
    </div>

    {{-- Journals Grid --}}
    @if(count($journals) == 0)
        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
            <p class="text-gray-500 text-lg">Aucun journal disponible pour le moment.</p>
            <p class="text-gray-400 mt-2">Revenez bientôt pour découvrir nos publications.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($journals as $journal)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition group">
                    <a href="{{ route('journal.show', $journal['slug']) }}" class="block">
                        <div class="relative aspect-[3/4] overflow-hidden bg-gray-100">
                            @if($journal['image'])
                                <img src="{{ $journal['image'] }}" 
                                     alt="{{ $journal['titre'] }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-100 to-orange-200">
                                    <svg class="w-16 h-16 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            @if(!$journal['disponible'])
                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                    <span class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold">Épuisé</span>
                                </div>
                            @endif
                            
                            @if($journal['numero'])
                                <span class="absolute top-2 left-2 bg-orange-600 text-white px-2 py-1 rounded text-xs font-semibold">
                                    {{ $journal['numero'] }}
                                </span>
                            @endif
                        </div>
                    </a>
                    
                    <div class="p-4">
                        <a href="{{ route('journal.show', $journal['slug']) }}" class="block">
                            <h3 class="font-bold text-gray-900 mb-1 group-hover:text-orange-600 transition line-clamp-2">
                                {{ $journal['titre'] }}
                            </h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-3">{{ $journal['date_publication_formatte'] }}</p>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-orange-600 font-bold text-lg">{{ $journal['prix_formatte'] }}</span>
                            
                            @if($journal['disponible'])
                                <a href="{{ route('journal.show', $journal['slug']) }}" 
                                   class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                    Voir
                                </a>
                            @else
                                <span class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-semibold cursor-not-allowed">
                                    Indisponible
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Info Section --}}
    <div class="mt-12 bg-gray-900 rounded-xl p-8 text-white">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Publication Régulière</h3>
                <p class="text-gray-400">Nouveaux numéros chaque semaine</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Livraison à Abidjan</h3>
                <p class="text-gray-400">Livraison gratuite dans tout Abidjan</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Contact</h3>
                <p class="text-gray-400">+225 07 00 00 00 00</p>
            </div>
        </div>
    </div>
</div>
@endsection

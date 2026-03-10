@extends('layouts.app')

@section('title', $journal['titre'] . ' - Boutique Abidjansports')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Breadcrumb --}}
    <nav class="mb-6">
        <ol class="flex items-center gap-2 text-sm text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-orange-600">Accueil</a></li>
            <li><span class="text-gray-400">/</span></li>
            <li><a href="{{ route('boutique') }}" class="hover:text-orange-600">Boutique</a></li>
            <li><span class="text-gray-400">/</span></li>
            <li class="text-orange-600 font-semibold">{{ $journal['titre'] }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="grid md:grid-cols-2 gap-6 p-6">
                    {{-- Image --}}
                    <div class="aspect-[3/4] rounded-lg overflow-hidden bg-gray-100">
                        @if($journal['image'])
                            <img src="{{ \App\Helpers\HtmlHelper::proxyImageUrl($journal['image']) }}" 
                                 alt="{{ $journal['titre'] }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-100 to-orange-200">
                                <svg class="w-24 h-24 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Details --}}
                    <div class="flex flex-col">
                        @if($journal['numero'])
                            <span class="inline-block bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm font-semibold mb-3 w-fit">
                                {{ $journal['numero'] }}
                            </span>
                        @endif

                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">
                            {{ $journal['titre'] }}
                        </h1>

                        <p class="text-gray-500 mb-4">
                            Publié le {{ $journal['date_publication_formatte'] }}
                        </p>

                        <div class="text-3xl font-bold text-orange-600 mb-6">
                            {{ $journal['prix_formatte'] }}
                        </div>

                        @if($journal['description'])
                            <div class="text-gray-700 mb-6 flex-1">
                                <h3 class="font-semibold text-gray-900 mb-2">Description</h3>
                                <p>{{ $journal['description'] }}</p>
                            </div>
                        @endif

                        <div class="space-y-3 mt-auto">
                            @if($journal['disponible'])
                                <div class="flex items-center gap-2 text-green-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-semibold">En stock ({{ $journal['stock'] }} disponibles)</span>
                                </div>

                                <a href="https://wa.me/2250700000000?text=Bonjour, je souhaite commander le journal: {{ urlencode($journal['titre']) }}" 
                                   target="_blank"
                                   class="flex items-center justify-center gap-2 w-full bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg font-semibold transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    Commander via WhatsApp
                                </a>
                            @else
                                <div class="flex items-center gap-2 text-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <span class="font-semibold">Rupture de stock</span>
                                </div>

                                <button disabled class="w-full bg-gray-300 text-gray-500 py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                                    Indisponible
                                </button>
                            @endif

                            @if($journal['fichier_pdf'])
                                <a href="{{ $journal['fichier_pdf'] }}" 
                                   target="_blank"
                                   class="flex items-center justify-center gap-2 w-full border-2 border-orange-600 text-orange-600 hover:bg-orange-50 py-3 px-6 rounded-lg font-semibold transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Télécharger le PDF
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Other Journals --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Autres Journaux</h3>
                <div class="space-y-4">
                    @forelse($latestJournals as $item)
                        @if($item['slug'] !== $journal['slug'])
                            <a href="{{ route('journal.show', $item['slug']) }}" class="flex gap-3 group">
                                <div class="w-16 h-20 rounded-lg overflow-hidden shrink-0 bg-gray-100">
                                    @if($item['image'])
                                        <img src="{{ \App\Helpers\HtmlHelper::proxyImageUrl($item['image']) }}" alt="{{ $item['titre'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-orange-100">
                                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-orange-600 transition line-clamp-2 text-sm">
                                        {{ $item['titre'] }}
                                    </h4>
                                    <p class="text-orange-600 font-bold text-sm mt-1">{{ $item['prix_formatte'] }}</p>
                                </div>
                            </a>
                        @endif
                    @empty
                        <p class="text-gray-500 text-sm">Aucun autre journal disponible.</p>
                    @endforelse
                </div>
                
                <a href="{{ route('boutique') }}" class="block text-center text-orange-600 hover:text-orange-700 font-semibold mt-4">
                    Voir tous les journaux →
                </a>
            </div>

            {{-- Contact --}}
            <div class="bg-gray-900 rounded-xl p-6 text-white">
                <h3 class="text-lg font-bold mb-4">Besoin d'aide ?</h3>
                <p class="text-gray-400 text-sm mb-4">Contactez-nous pour toute question concernant votre commande.</p>
                <a href="tel:+2250700000000" class="flex items-center gap-2 text-orange-400 hover:text-orange-300 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +225 07 00 00 00 00
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

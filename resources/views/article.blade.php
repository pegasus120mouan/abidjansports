@extends('layouts.app')

@section('title', $article['titre'] ?? 'Article - Abidjansports')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Article Principal --}}
        <div class="lg:col-span-2">
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                {{-- Image de l'article --}}
                @if($article['image'])
                <div class="relative h-[300px] lg:h-[400px]">
                    <img src="{{ \App\Helpers\HtmlHelper::proxyImageUrl($article['image']) }}" 
                         alt="{{ $article['titre'] }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="inline-block bg-orange-600 text-white px-3 py-1 rounded text-sm font-semibold">
                            {{ $article['category']['nom'] ?? 'Sport' }}
                        </span>
                    </div>
                </div>
                @endif
                
                {{-- Contenu de l'article --}}
                <div class="p-6 lg:p-8">
                    <h1 class="text-2xl lg:text-4xl font-bold text-gray-900 mb-4">
                        {{ $article['titre'] }}
                    </h1>
                    
                    {{-- Métadonnées --}}
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6 pb-6 border-b">
                        <span class="flex items-center gap-1">
                            <i class="bi bi-person"></i>
                            {{ $article['auteur']['prenoms'] ?? '' }} {{ $article['auteur']['nom'] ?? '' }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="bi bi-calendar"></i>
                            {{ \Carbon\Carbon::parse($article['created_at'])->format('d/m/Y à H:i') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="bi bi-folder"></i>
                            {{ $article['sous_category']['nom'] ?? '' }}
                        </span>
                    </div>
                    
                    {{-- Résumé --}}
                    @if($article['resume'])
                    <p class="text-lg text-gray-600 mb-6 font-medium italic">
                        {{ $article['resume'] }}
                    </p>
                    @endif
                    
                    {{-- Contenu --}}
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! \App\Helpers\HtmlHelper::cleanWordHtml($article['contenu']) !!}
                    </div>
                    
                    {{-- Partage --}}
                    <div class="mt-8 pt-6 border-t">
                        <h3 class="text-sm font-semibold text-gray-500 mb-3">Partager cet article</h3>
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article['titre']) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($article['titre'] . ' ' . request()->url()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        
        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Articles récents --}}
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="bi bi-clock-history text-orange-600"></i>
                    Articles récents
                </h3>
                <div class="space-y-4">
                    @foreach($latestArticles as $recent)
                    <a href="{{ route('article.show', $recent['slug']) }}" class="flex gap-3 group">
                        @if($recent['image'])
                        <img src="{{ \App\Helpers\HtmlHelper::proxyImageUrl($recent['image']) }}" 
                             alt="{{ $recent['titre'] }}" 
                             class="w-20 h-16 object-cover rounded-lg shrink-0">
                        @endif
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 group-hover:text-orange-600 transition line-clamp-2">
                                {{ $recent['titre'] }}
                            </h4>
                            <span class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($recent['created_at'])->diffForHumans() }}
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            
            {{-- Catégories --}}
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="bi bi-grid text-orange-600"></i>
                    Catégories
                </h3>
                <div class="space-y-2">
                    @isset($menuCategories)
                    @foreach($menuCategories as $cat)
                    <a href="{{ route('category', $cat['slug']) }}" 
                       class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition">
                        <span>{{ $cat['nom'] }}</span>
                        <i class="bi bi-chevron-right text-sm"></i>
                    </a>
                    @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

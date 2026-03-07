@extends('layouts.app')

@section('title', 'Abidjansports - Actualité Sportive Ivoirienne')

@section('content')
{{-- Breaking News Ticker - Dynamique depuis l'API --}}
@if(isset($flashInfos) && count($flashInfos) > 0)
<div class="bg-red-600 text-white py-2 overflow-hidden">
    <div class="container mx-auto px-4 flex items-center gap-4">
        <span class="bg-white text-red-600 px-3 py-1 rounded font-bold text-sm shrink-0">FLASH</span>
        <div class="overflow-hidden">
            <p id="flash-ticker" class="whitespace-nowrap animate-marquee">
                @foreach($flashInfos as $index => $flash)
                    @if($flash['icone'])<i class="{{ $flash['icone'] }}"></i>@endif
                    {{ $flash['contenu'] }}
                    @if($index < count($flashInfos) - 1) • @endif
                @endforeach
            </p>
        </div>
    </div>
</div>
@endif

<div class="container mx-auto px-4 py-8">
    {{-- Hero Section - Articles récents depuis l'API --}}
    <section class="mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Featured Article (Premier article) --}}
            @if(isset($latestArticles) && count($latestArticles) > 0)
            @php $mainArticle = $latestArticles[0]; @endphp
            <div class="lg:col-span-2">
                <a href="{{ route('article.show', $mainArticle['slug'] ?? '#') }}" class="block">
                    <article class="relative rounded-xl overflow-hidden group cursor-pointer h-[400px] lg:h-[500px]">
                        <img src="{{ \App\Helpers\HtmlHelper::proxyImageUrl($mainArticle['image']) ?? 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=800&q=80' }}" 
                             alt="{{ $mainArticle['titre'] ?? 'Article' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="inline-block bg-orange-600 text-white px-3 py-1 rounded text-sm font-semibold mb-3">
                                {{ $mainArticle['category']['nom'] ?? 'À LA UNE' }}
                            </span>
                            <h2 class="text-2xl lg:text-4xl font-bold text-white mb-3 group-hover:text-orange-400 transition">
                                {{ $mainArticle['titre'] ?? 'Titre de l\'article' }}
                            </h2>
                            <p class="text-gray-300 mb-4 line-clamp-2">
                                {{ $mainArticle['resume'] ?? '' }}
                            </p>
                            <div class="flex items-center gap-4 text-sm text-gray-400">
                                <span>📅 {{ \Carbon\Carbon::parse($mainArticle['created_at'])->diffForHumans() }}</span>
                            </div>
                        </div>
                    </article>
                </a>
            </div>
            @endif
            
            {{-- Side Featured Articles (2ème et 3ème articles) --}}
            <div class="flex flex-col gap-4">
                @if(isset($latestArticles) && count($latestArticles) > 1)
                @php $secondArticle = $latestArticles[1]; @endphp
                <a href="{{ route('article.show', $secondArticle['slug'] ?? '#') }}" class="block">
                    <article class="relative rounded-xl overflow-hidden group cursor-pointer h-[240px]">
                        <img src="{{ \App\Helpers\HtmlHelper::proxyImageUrl($secondArticle['image']) ?? 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=400&q=80' }}" 
                             alt="{{ $secondArticle['titre'] ?? 'Article' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <span class="inline-block bg-green-600 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">
                                {{ $secondArticle['category']['nom'] ?? 'SPORT' }}
                            </span>
                            <h3 class="text-lg font-bold text-white group-hover:text-orange-400 transition">
                                {{ $secondArticle['titre'] ?? 'Titre de l\'article' }}
                            </h3>
                        </div>
                    </article>
                </a>
                @endif
                
                @if(isset($latestArticles) && count($latestArticles) > 2)
                @php $thirdArticle = $latestArticles[2]; @endphp
                <a href="{{ route('article.show', $thirdArticle['slug'] ?? '#') }}" class="block">
                    <article class="relative rounded-xl overflow-hidden group cursor-pointer h-[240px]">
                        <img src="{{ \App\Helpers\HtmlHelper::proxyImageUrl($thirdArticle['image']) ?? 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=400&q=80' }}" 
                             alt="{{ $thirdArticle['titre'] ?? 'Article' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <span class="inline-block bg-blue-600 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">
                                {{ $thirdArticle['category']['nom'] ?? 'SPORT' }}
                            </span>
                            <h3 class="text-lg font-bold text-white group-hover:text-orange-400 transition">
                                {{ $thirdArticle['titre'] ?? 'Titre de l\'article' }}
                            </h3>
                        </div>
                    </article>
                </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Live Scores Section --}}
    <section class="mb-10">
        <div class="bg-gray-900 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                    Scores en Direct
                </h2>
                <a href="{{ route('results') }}" class="text-orange-400 hover:text-orange-300 text-sm font-semibold">
                    Voir tous les résultats →
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Match 1 --}}
                <div class="bg-gray-800 rounded-lg p-4">
                    <div class="text-xs text-gray-400 mb-2">Ligue 1 Ivoirienne • En cours</div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center font-bold text-black">AS</div>
                            <span class="font-semibold">ASEC Mimosas</span>
                        </div>
                        <span class="text-2xl font-bold text-green-400">2</span>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center font-bold">AF</div>
                            <span class="font-semibold">Africa Sports</span>
                        </div>
                        <span class="text-2xl font-bold">1</span>
                    </div>
                    <div class="text-center mt-3 text-orange-400 text-sm font-semibold">67'</div>
                </div>
                
                {{-- Match 2 --}}
                <div class="bg-gray-800 rounded-lg p-4">
                    <div class="text-xs text-gray-400 mb-2">Ligue 1 Ivoirienne • Terminé</div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold">SC</div>
                            <span class="font-semibold">Stade d'Abidjan</span>
                        </div>
                        <span class="text-2xl font-bold">0</span>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center font-bold">RC</div>
                            <span class="font-semibold">Racing Club</span>
                        </div>
                        <span class="text-2xl font-bold text-green-400">3</span>
                    </div>
                    <div class="text-center mt-3 text-gray-500 text-sm">Terminé</div>
                </div>
                
                {{-- Match 3 --}}
                <div class="bg-gray-800 rounded-lg p-4">
                    <div class="text-xs text-gray-400 mb-2">CAF Champions League • 20:00</div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center font-bold text-black">AS</div>
                            <span class="font-semibold">ASEC Mimosas</span>
                        </div>
                        <span class="text-2xl font-bold text-gray-500">-</span>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-700 rounded-full flex items-center justify-center font-bold">AH</div>
                            <span class="font-semibold">Al Ahly</span>
                        </div>
                        <span class="text-2xl font-bold text-gray-500">-</span>
                    </div>
                    <div class="text-center mt-3 text-blue-400 text-sm">À venir</div>
                </div>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2">
            {{-- Latest News --}}
            <section class="mb-10">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="w-1 h-8 bg-orange-600 rounded"></span>
                        Dernières Actualités
                    </h2>
                    <a href="#" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">
                        Voir tout →
                    </a>
                </div>
                
                <div id="latest-articles" class="space-y-6">
                    @isset($latestArticles)
                    @foreach($latestArticles as $article)
                    <a href="{{ route('article.show', $article['slug'] ?? '#') }}" class="block">
                        <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3 h-48 md:h-auto">
                                    <img src="{{ \App\Helpers\HtmlHelper::proxyImageUrl($article['image']) ?? 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=400&q=80' }}" 
                                         alt="{{ $article['titre'] ?? 'Article' }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                </div>
                                <div class="flex-1 p-5">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded text-xs font-semibold">
                                            {{ $article['category']['nom'] ?? 'Sport' }}
                                        </span>
                                        <span class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($article['created_at'])->diffForHumans() }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition line-clamp-2">
                                        {{ $article['titre'] ?? 'Titre de l\'article' }}
                                    </h3>
                                    <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                                        {{ $article['resume'] ?? '' }}
                                    </p>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Abidjansports</span>
                                        <span class="text-orange-600 hover:text-orange-700 font-semibold">
                                            Lire la suite →
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </a>
                    @endforeach
                    @endisset
                </div>
                
                {{-- Load More --}}
                <div class="text-center mt-8">
                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                        Charger plus d'articles
                    </button>
                </div>
            </section>
        </div>
        
        {{-- Sidebar --}}
        <aside class="space-y-8">
            {{-- League Standings --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-green-600 rounded"></span>
                    Classement Ligue 1
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-500 border-b">
                                <th class="text-left py-2">#</th>
                                <th class="text-left py-2">Équipe</th>
                                <th class="text-center py-2">J</th>
                                <th class="text-center py-2">Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($standings as $index => $team)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-2 font-semibold {{ $index < 3 ? 'text-green-600' : '' }}">{{ $index + 1 }}</td>
                                <td class="py-2 font-medium">{{ $team['name'] }}</td>
                                <td class="py-2 text-center text-gray-500">{{ $team['played'] }}</td>
                                <td class="py-2 text-center font-bold">{{ $team['points'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('teams') }}" class="block text-center text-orange-600 hover:text-orange-700 font-semibold text-sm mt-4">
                    Voir le classement complet →
                </a>
            </div>
            
            {{-- Popular Articles --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-red-600 rounded"></span>
                    Articles Populaires
                </h3>
                <div class="space-y-4">
                    @foreach($popularArticles as $index => $article)
                    <article class="flex gap-3 group cursor-pointer">
                        <span class="text-3xl font-bold text-gray-200 group-hover:text-orange-600 transition">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <div>
                            <h4 class="font-semibold text-gray-900 group-hover:text-orange-600 transition line-clamp-2 text-sm">
                                {{ $article['title'] }}
                            </h4>
                            <span class="text-xs text-gray-500">{{ $article['views'] }} vues</span>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            
            {{-- Social Media --}}
            <div class="bg-gradient-to-br from-orange-600 to-green-600 rounded-xl p-6 text-white">
                <h3 class="text-lg font-bold mb-4">Suivez-nous</h3>
                <div class="grid grid-cols-3 gap-3">
                    <a href="#" class="bg-white/20 hover:bg-white/30 rounded-lg p-4 text-center transition">
                        <span class="text-2xl">📘</span>
                        <p class="text-xs mt-1">Facebook</p>
                    </a>
                    <a href="#" class="bg-white/20 hover:bg-white/30 rounded-lg p-4 text-center transition">
                        <span class="text-2xl">🐦</span>
                        <p class="text-xs mt-1">Twitter</p>
                    </a>
                    <a href="#" class="bg-white/20 hover:bg-white/30 rounded-lg p-4 text-center transition">
                        <span class="text-2xl">📸</span>
                        <p class="text-xs mt-1">Instagram</p>
                    </a>
                </div>
            </div>
            
            {{-- Newsletter --}}
            <div class="bg-gray-900 rounded-xl p-6 text-white">
                <h3 class="text-lg font-bold mb-2">Newsletter</h3>
                <p class="text-gray-400 text-sm mb-4">Recevez les dernières actualités sportives directement dans votre boîte mail.</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Votre adresse email" 
                           class="w-full px-4 py-3 rounded-lg bg-gray-800 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500">
                    <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 py-3 rounded-lg font-semibold transition">
                        S'abonner
                    </button>
                </form>
            </div>
        </aside>
    </div>
</div>

<style>
@keyframes marquee {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}
.animate-marquee {
    animation: marquee 20s linear infinite;
}
</style>
@endsection

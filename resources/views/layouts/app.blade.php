<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Abidjansports - Toute l'actualité sportive de Côte d'Ivoire et d'Afrique">
    <title>@yield('title', 'Abidjansports - Actualité Sportive Ivoirienne')</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    {{-- Header --}}
    <header class="bg-white text-gray-900 shadow-lg">
        {{-- Top Bar --}}
        <div class="bg-gray-900 text-white py-2">
            <div class="container mx-auto px-4 flex justify-between items-center text-sm">
                <div class="flex items-center gap-4">
                    <span>📍 Abidjan, Côte d'Ivoire</span>
                    <span>{{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-orange-400 transition">Facebook</a>
                    <a href="#" class="hover:text-orange-400 transition">Twitter</a>
                    <a href="#" class="hover:text-orange-400 transition">Instagram</a>
                </div>
            </div>
        </div>
        
        {{-- Main Header --}}
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Abidjansports" class="h-14 w-auto">
                </a>
                
                            </div>
        </div>
        
        {{-- Navigation --}}
        <nav class="bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md relative z-50 mb-4">
            <div class="container mx-auto px-4">
                <ul class="flex items-center gap-0">
                    {{-- Accueil --}}
                    <li>
                        <a href="/" class="block px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all {{ request()->is('/') ? 'bg-white/20 border-white' : '' }}">
                            Accueil
                        </a>
                    </li>
                    
                    {{-- Football avec sous-menu --}}
                    <li class="relative dropdown-menu">
                        <button type="button" class="dropdown-toggle flex items-center gap-1 px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all {{ request()->is('categorie/football*') ? 'bg-white/20 border-white' : '' }}">
                            Football
                            <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul class="dropdown-content absolute left-0 top-full bg-white text-gray-800 rounded-b-lg shadow-xl min-w-[200px] hidden z-50">
                            <li><a href="{{ route('category', 'football') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🇨🇮 Ligue 1 Ivoirienne</a></li>
                            <li><a href="{{ route('category', 'football') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🌍 CAF Champions League</a></li>
                            <li><a href="{{ route('category', 'football') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🏆 Coupe Nationale</a></li>
                            <li><a href="{{ route('category', 'football') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🐘 Équipe Nationale</a></li>
                            <li><a href="{{ route('category', 'football') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition border-t">🌐 Football International</a></li>
                        </ul>
                    </li>
                    
                    {{-- Basketball avec sous-menu --}}
                    <li class="relative dropdown-menu">
                        <button type="button" class="dropdown-toggle flex items-center gap-1 px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all {{ request()->is('categorie/basketball*') ? 'bg-white/20 border-white' : '' }}">
                            Basketball
                            <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul class="dropdown-content absolute left-0 top-full bg-white text-gray-800 rounded-b-lg shadow-xl min-w-[200px] hidden z-50">
                            <li><a href="{{ route('category', 'basketball') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🇨🇮 Championnat National</a></li>
                            <li><a href="{{ route('category', 'basketball') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🌍 Afrobasket</a></li>
                            <li><a href="{{ route('category', 'basketball') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🏀 NBA</a></li>
                        </ul>
                    </li>
                    
                    {{-- Athlétisme --}}
                    <li class="relative dropdown-menu">
                        <button type="button" class="dropdown-toggle flex items-center gap-1 px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all {{ request()->is('categorie/athletisme*') ? 'bg-white/20 border-white' : '' }}">
                            Athlétisme
                            <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul class="dropdown-content absolute left-0 top-full bg-white text-gray-800 rounded-b-lg shadow-xl min-w-[200px] hidden z-50">
                            <li><a href="{{ route('category', 'athletisme') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🏅 Jeux Olympiques</a></li>
                            <li><a href="{{ route('category', 'athletisme') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🌍 Championnats d'Afrique</a></li>
                            <li><a href="{{ route('category', 'athletisme') }}" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🏆 Diamond League</a></li>
                        </ul>
                    </li>
                    
                    {{-- Tennis --}}
                    <li>
                        <a href="{{ route('category', 'tennis') }}" class="block px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all {{ request()->is('categorie/tennis*') ? 'bg-white/20 border-white' : '' }}">
                            Tennis
                        </a>
                    </li>
                    
                    {{-- Autres Sports --}}
                    <li class="relative dropdown-menu">
                        <button type="button" class="dropdown-toggle flex items-center gap-1 px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all">
                            Autres Sports
                            <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul class="dropdown-content absolute left-0 top-full bg-white text-gray-800 rounded-b-lg shadow-xl min-w-[200px] hidden z-50">
                            <li><a href="#" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🥊 Boxe</a></li>
                            <li><a href="#" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🥋 Taekwondo</a></li>
                            <li><a href="#" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🏊 Natation</a></li>
                            <li><a href="#" class="block px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">🚴 Cyclisme</a></li>
                        </ul>
                    </li>
                    
                    {{-- Séparateur --}}
                    <li class="flex-1"></li>
                    
                    {{-- Résultats --}}
                    <li>
                        <a href="{{ route('results') }}" class="flex items-center gap-2 px-5 py-3 font-semibold bg-white/10 hover:bg-white/20 rounded-lg mx-1 transition {{ request()->is('resultats*') ? 'bg-white/30' : '' }}">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            Résultats Live
                        </a>
                    </li>
                    
                    {{-- Équipes --}}
                    <li>
                        <a href="{{ route('teams') }}" class="block px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all {{ request()->is('equipes*') ? 'bg-white/20 border-white' : '' }}">
                            Classements
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                
                dropdowns.forEach(dropdown => {
                    const toggle = dropdown.querySelector('.dropdown-toggle');
                    const content = dropdown.querySelector('.dropdown-content');
                    const arrow = dropdown.querySelector('.dropdown-arrow');
                    
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        // Fermer tous les autres dropdowns
                        dropdowns.forEach(other => {
                            if (other !== dropdown) {
                                other.querySelector('.dropdown-content').classList.add('hidden');
                                other.querySelector('.dropdown-arrow').classList.remove('rotate-180');
                            }
                        });
                        
                        // Toggle le dropdown actuel
                        content.classList.toggle('hidden');
                        arrow.classList.toggle('rotate-180');
                    });
                });
                
                // Fermer les dropdowns quand on clique ailleurs
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.dropdown-menu')) {
                        dropdowns.forEach(dropdown => {
                            dropdown.querySelector('.dropdown-content').classList.add('hidden');
                            dropdown.querySelector('.dropdown-arrow').classList.remove('rotate-180');
                        });
                    }
                });
            });
        </script>
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white mt-12">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- About --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Abidjansports" class="h-10 w-auto">
                    </div>
                    <p class="text-gray-400 text-sm">
                        Votre source d'information sportive en Côte d'Ivoire. 
                        Suivez toute l'actualité du sport ivoirien et africain.
                    </p>
                </div>
                
                {{-- Categories --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Catégories</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('category', 'football') }}" class="hover:text-orange-500 transition">Football</a></li>
                        <li><a href="{{ route('category', 'basketball') }}" class="hover:text-orange-500 transition">Basketball</a></li>
                        <li><a href="{{ route('category', 'athletisme') }}" class="hover:text-orange-500 transition">Athlétisme</a></li>
                        <li><a href="{{ route('category', 'tennis') }}" class="hover:text-orange-500 transition">Tennis</a></li>
                    </ul>
                </div>
                
                {{-- Links --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Liens Utiles</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('results') }}" class="hover:text-orange-500 transition">Résultats</a></li>
                        <li><a href="{{ route('teams') }}" class="hover:text-orange-500 transition">Équipes</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">À propos</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Contact</a></li>
                    </ul>
                </div>
                
                {{-- Newsletter --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">Recevez les dernières actualités sportives</p>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Votre email" 
                               class="flex-1 px-4 py-2 rounded bg-gray-800 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500">
                        <button type="submit" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 rounded font-semibold transition">
                            OK
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} Abidjansports. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>

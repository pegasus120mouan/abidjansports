<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Abidjansports - Toute l'actualité sportive de Côte d'Ivoire et d'Afrique">
    <title><?php echo $__env->yieldContent('title', 'Abidjansports - Actualité Sportive Ivoirienne'); ?></title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100 min-h-screen">
    
    <header class="bg-white text-gray-900 shadow-lg">
        
        <div class="bg-gray-900 text-white py-2">
            <div class="container mx-auto px-4 flex justify-between items-center text-sm">
                <div class="flex items-center gap-4">
                    <span>📍 Abidjan, Côte d'Ivoire</span>
                    <span><?php echo e(now()->locale('fr')->isoFormat('dddd D MMMM YYYY')); ?></span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-orange-400 transition">Facebook</a>
                    <a href="#" class="hover:text-orange-400 transition">Twitter</a>
                    <a href="#" class="hover:text-orange-400 transition">Instagram</a>
                </div>
            </div>
        </div>
        
        
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Abidjansports" class="h-14 w-auto">
                </a>
            </div>
        </div>
        
        
        <nav class="bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md relative z-50 mb-4">
            <div class="container mx-auto px-4">
                <ul class="flex items-center gap-0">
                    
                    <li>
                        <a href="/" class="block px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all <?php echo e(request()->is('/') ? 'bg-white/20 border-white' : ''); ?>">
                            Accueil
                        </a>
                    </li>
                    
                    
                    <?php if(isset($menuCategories)): ?>
                        <?php $__currentLoopData = $menuCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($category['sous_categories'] ?? []) > 0): ?>
                                
                                <li class="relative dropdown-menu">
                                    <button type="button" class="dropdown-toggle flex items-center gap-1 px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all <?php echo e(request()->is('categorie/' . $category['slug'] . '*') ? 'bg-white/20 border-white' : ''); ?>">
                                        <?php echo e($category['nom']); ?>

                                        <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-content absolute left-0 top-full bg-white text-gray-800 rounded-b-lg shadow-xl min-w-[200px] hidden z-50">
                                        <?php $__currentLoopData = $category['sous_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sousCategorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(route('sous-category', $sousCategorie['slug'])); ?>" class="flex items-center gap-2 px-4 py-3 hover:bg-orange-50 hover:text-orange-600 transition">
                                                    <?php if($sousCategorie['icone']): ?>
                                                        <i class="<?php echo e($sousCategorie['icone']); ?>"></i>
                                                    <?php endif; ?>
                                                    <?php echo e($sousCategorie['nom']); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                
                                <li>
                                    <a href="<?php echo e(route('category', $category['slug'])); ?>" class="block px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all <?php echo e(request()->is('categorie/' . $category['slug'] . '*') ? 'bg-white/20 border-white' : ''); ?>">
                                        <?php echo e($category['nom']); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    
                    
                    <li class="flex-1"></li>
                    
                    
                    <li>
                        <a href="<?php echo e(route('results')); ?>" class="flex items-center gap-2 px-5 py-3 font-semibold bg-white/10 hover:bg-white/20 rounded-lg mx-1 transition <?php echo e(request()->is('resultats*') ? 'bg-white/30' : ''); ?>">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            Résultats Live
                        </a>
                    </li>
                    
                    
                    <li>
                        <a href="<?php echo e(route('teams')); ?>" class="block px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all <?php echo e(request()->is('equipes*') ? 'bg-white/20 border-white' : ''); ?>">
                            Classements
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('boutique')); ?>" class="block px-5 py-3 font-semibold hover:bg-white/20 border-b-2 border-transparent hover:border-white transition-all <?php echo e(request()->is('boutique*') ? 'bg-white/20 border-white' : ''); ?>">
                            Boutique
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
                        
                        dropdowns.forEach(other => {
                            if (other !== dropdown) {
                                other.querySelector('.dropdown-content').classList.add('hidden');
                                other.querySelector('.dropdown-arrow').classList.remove('rotate-180');
                            }
                        });
                        
                        content.classList.toggle('hidden');
                        arrow.classList.toggle('rotate-180');
                    });
                });
                
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

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <footer class="bg-gray-900 text-white mt-12">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Abidjansports" class="h-10 w-auto">
                    </div>
                    <p class="text-gray-400 text-sm">
                        Votre source d'information sportive en Côte d'Ivoire. 
                        Suivez toute l'actualité du sport ivoirien et africain.
                    </p>
                </div>
                
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Catégories</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="<?php echo e(route('category', 'football')); ?>" class="hover:text-orange-500 transition">Football</a></li>
                        <li><a href="<?php echo e(route('category', 'basketball')); ?>" class="hover:text-orange-500 transition">Basketball</a></li>
                        <li><a href="<?php echo e(route('category', 'athletisme')); ?>" class="hover:text-orange-500 transition">Athlétisme</a></li>
                        <li><a href="<?php echo e(route('category', 'tennis')); ?>" class="hover:text-orange-500 transition">Tennis</a></li>
                    </ul>
                </div>
                
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Liens Utiles</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="<?php echo e(route('results')); ?>" class="hover:text-orange-500 transition">Résultats</a></li>
                        <li><a href="<?php echo e(route('teams')); ?>" class="hover:text-orange-500 transition">Équipes</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">À propos</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Contact</a></li>
                    </ul>
                </div>
                
                
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
                <p>&copy; <?php echo e(date('Y')); ?> Abidjansports. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    
    <script>
    (function() {
        const trackVisit = () => {
            const data = {
                type_page: '<?php echo e($typePage ?? "autre"); ?>',
                article_id: <?php echo e($articleId ?? 'null'); ?>

            };
            
            fetch('<?php echo e(config("app.api_url")); ?>/visite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            }).catch(() => {});
        };
        
        if (document.readyState === 'complete') {
            trackVisit();
        } else {
            window.addEventListener('load', trackVisit);
        }
    })();
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\abidjansports\resources\views/layouts/app.blade.php ENDPATH**/ ?>
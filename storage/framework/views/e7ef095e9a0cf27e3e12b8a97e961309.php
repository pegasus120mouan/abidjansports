<?php $__env->startSection('title', $categoryName . ' - Abidjansports'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    
    <div class="bg-gradient-to-r from-<?php echo e($categoryColor); ?>-600 to-<?php echo e($categoryColor); ?>-800 rounded-xl p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2"><?php echo e($categoryName); ?></h1>
        <?php if(isset($sousCategory)): ?>
            <p class="text-<?php echo e($categoryColor); ?>-200">
                <a href="<?php echo e(route('category', $category['slug'] ?? '')); ?>" class="hover:underline"><?php echo e($category['nom'] ?? ''); ?></a> 
                > <?php echo e($sousCategory['nom'] ?? ''); ?>

            </p>
        <?php else: ?>
            <p class="text-<?php echo e($categoryColor); ?>-200">Toute l'actualité <?php echo e(strtolower($categoryName)); ?> en Côte d'Ivoire et en Afrique</p>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
            <?php if(count($articles) == 0): ?>
                <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                    <p class="text-gray-500">Aucun article dans cette catégorie pour le moment.</p>
                </div>
            <?php else: ?>
            
            <a href="<?php echo e(route('article.show', $articles[0]['slug'])); ?>" class="block">
                <article class="relative rounded-xl overflow-hidden group cursor-pointer h-[350px] mb-8">
                    <?php if($articles[0]['image']): ?>
                        <img src="<?php echo e($articles[0]['image']); ?>" 
                             alt="<?php echo e($articles[0]['titre']); ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-300 flex items-center justify-content-center">
                            <span class="text-gray-500">Pas d'image</span>
                        </div>
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <span class="inline-block bg-<?php echo e($categoryColor); ?>-600 text-white px-3 py-1 rounded text-sm font-semibold mb-3">
                            <?php echo e($articles[0]['sous_category']['nom'] ?? $categoryName); ?>

                        </span>
                        <h2 class="text-2xl lg:text-3xl font-bold text-white mb-3 group-hover:text-orange-400 transition">
                            <?php echo e($articles[0]['titre']); ?>

                        </h2>
                        <p class="text-gray-300 mb-4 line-clamp-2">
                            <?php echo e($articles[0]['resume'] ?? ''); ?>

                        </p>
                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <span>📅 <?php echo e(\Carbon\Carbon::parse($articles[0]['created_at'])->format('d/m/Y')); ?></span>
                            <span>Par <?php echo e($articles[0]['auteur']['signature'] ?? $articles[0]['auteur']['prenoms'] . ' ' . $articles[0]['auteur']['nom']); ?></span>
                        </div>
                    </div>
                </article>
            </a>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php $__currentLoopData = array_slice($articles, 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('article.show', $article['slug'])); ?>" class="block">
                    <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group h-full">
                        <div class="h-48 overflow-hidden">
                            <?php if($article['image']): ?>
                                <img src="<?php echo e($article['image']); ?>" 
                                     alt="<?php echo e($article['titre']); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">Pas d'image</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-gray-400 text-xs"><?php echo e(\Carbon\Carbon::parse($article['created_at'])->format('d/m/Y')); ?></span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition line-clamp-2">
                                <?php echo e($article['titre']); ?>

                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                                <?php echo e($article['resume'] ?? ''); ?>

                            </p>
                            <span class="text-orange-600 hover:text-orange-700 font-semibold text-sm">
                                Lire la suite →
                            </span>
                        </div>
                    </article>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            
            <div class="flex justify-center mt-8 gap-2">
                <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition">
                    ← Précédent
                </button>
                <button class="px-4 py-2 bg-orange-600 text-white rounded-lg">1</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition">2</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition">3</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition">
                    Suivant →
                </button>
            </div>
        </div>

        
        <aside class="space-y-8">
            
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Catégories</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="<?php echo e(route('category', 'football')); ?>" 
                           class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition <?php echo e($category == 'football' ? 'bg-orange-50 text-orange-600' : ''); ?>">
                            <span class="font-medium">⚽ Football</span>
                            <span class="text-gray-400 text-sm">124</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('category', 'basketball')); ?>" 
                           class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition <?php echo e($category == 'basketball' ? 'bg-orange-50 text-orange-600' : ''); ?>">
                            <span class="font-medium">🏀 Basketball</span>
                            <span class="text-gray-400 text-sm">45</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('category', 'athletisme')); ?>" 
                           class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition <?php echo e($category == 'athletisme' ? 'bg-orange-50 text-orange-600' : ''); ?>">
                            <span class="font-medium">🏃 Athlétisme</span>
                            <span class="text-gray-400 text-sm">32</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('category', 'tennis')); ?>" 
                           class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition <?php echo e($category == 'tennis' ? 'bg-orange-50 text-orange-600' : ''); ?>">
                            <span class="font-medium">🎾 Tennis</span>
                            <span class="text-gray-400 text-sm">18</span>
                        </a>
                    </li>
                </ul>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Populaires en <?php echo e($categoryName); ?></h3>
                <div class="space-y-4">
                    <?php $__currentLoopData = array_slice($articles, 0, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('article.show', $article['slug'])); ?>" class="block">
                        <article class="flex gap-3 group cursor-pointer">
                            <div class="w-20 h-16 rounded-lg overflow-hidden shrink-0">
                                <?php if($article['image']): ?>
                                    <img src="<?php echo e($article['image']); ?>" alt="" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gray-200"></div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-orange-600 transition line-clamp-2 text-sm">
                                    <?php echo e($article['titre']); ?>

                                </h4>
                                <span class="text-xs text-gray-500"><?php echo e(\Carbon\Carbon::parse($article['created_at'])->format('d/m/Y')); ?></span>
                            </div>
                        </article>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="bg-gray-900 rounded-xl p-6 text-white">
                <h3 class="text-lg font-bold mb-2">Newsletter <?php echo e($categoryName); ?></h3>
                <p class="text-gray-400 text-sm mb-4">Recevez les dernières actualités <?php echo e(strtolower($categoryName)); ?>.</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Votre email" 
                           class="w-full px-4 py-3 rounded-lg bg-gray-800 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500">
                    <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 py-3 rounded-lg font-semibold transition">
                        S'abonner
                    </button>
                </form>
            </div>
        </aside>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\abidjansports\resources\views/category.blade.php ENDPATH**/ ?>
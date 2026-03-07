/**
 * Auto-refresh pour Abidjansports
 * Rafraîchit automatiquement les articles et les flash infos
 */

class AutoRefresh {
    constructor(options = {}) {
        this.articlesInterval = options.articlesInterval || 60000; // 60 secondes par défaut
        this.flashInterval = options.flashInterval || 30000; // 30 secondes par défaut
        this.articlesContainer = document.getElementById('latest-articles');
        this.flashContainer = document.getElementById('flash-ticker');
        this.heroContainer = document.getElementById('hero-articles');
        this.minioPattern = 'http://51.178.49.141:9000/abidjansports/';
        this.proxyUrl = window.location.origin + '/images/';
        
        this.init();
    }
    
    proxyImageUrl(url) {
        if (!url) return null;
        return url.replace(this.minioPattern, this.proxyUrl);
    }

    init() {
        // Rafraîchir les articles périodiquement
        if (this.articlesContainer || this.heroContainer) {
            setInterval(() => this.refreshArticles(), this.articlesInterval);
        }
        
        // Rafraîchir les flash infos périodiquement
        if (this.flashContainer) {
            setInterval(() => this.refreshFlashInfos(), this.flashInterval);
        }
        
        console.log('AutoRefresh initialisé - Articles: ' + (this.articlesInterval/1000) + 's, Flash: ' + (this.flashInterval/1000) + 's');
    }

    async refreshArticles() {
        try {
            const response = await fetch('/api/latest-articles?limit=10');
            const result = await response.json();
            
            if (result.success && result.data.length > 0) {
                this.updateHeroSection(result.data);
                this.updateArticlesList(result.data);
                console.log('Articles rafraîchis à ' + new Date().toLocaleTimeString());
            }
        } catch (error) {
            console.error('Erreur lors du rafraîchissement des articles:', error);
        }
    }

    async refreshFlashInfos() {
        try {
            const response = await fetch('/api/flash-infos');
            const result = await response.json();
            
            if (result.success && result.data.length > 0) {
                this.updateFlashTicker(result.data);
                console.log('Flash infos rafraîchis à ' + new Date().toLocaleTimeString());
            }
        } catch (error) {
            console.error('Erreur lors du rafraîchissement des flash infos:', error);
        }
    }

    updateHeroSection(articles) {
        if (!this.heroContainer || articles.length === 0) return;
        
        const mainArticle = articles[0];
        const mainImage = this.heroContainer.querySelector('#hero-main-image');
        const mainTitle = this.heroContainer.querySelector('#hero-main-title');
        const mainResume = this.heroContainer.querySelector('#hero-main-resume');
        const mainCategory = this.heroContainer.querySelector('#hero-main-category');
        const mainDate = this.heroContainer.querySelector('#hero-main-date');
        const mainLink = this.heroContainer.querySelector('#hero-main-link');
        
        if (mainImage) mainImage.src = this.proxyImageUrl(mainArticle.image) || '';
        if (mainTitle) mainTitle.textContent = mainArticle.titre || '';
        if (mainResume) mainResume.textContent = mainArticle.resume || '';
        if (mainCategory) mainCategory.textContent = mainArticle.category?.nom || 'Sport';
        if (mainDate) mainDate.textContent = this.formatDate(mainArticle.created_at);
        if (mainLink) mainLink.href = '/article/' + (mainArticle.slug || '');
    }

    updateArticlesList(articles) {
        if (!this.articlesContainer) return;
        
        let html = '';
        articles.forEach(article => {
            html += this.createArticleCard(article);
        });
        
        this.articlesContainer.innerHTML = html;
    }

    createArticleCard(article) {
        return `
            <a href="/article/${article.slug || '#'}" class="block">
                <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 h-48 md:h-auto">
                            <img src="${this.proxyImageUrl(article.image) || 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=400&q=80'}" 
                                 alt="${article.titre || 'Article'}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="flex-1 p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded text-xs font-semibold">
                                    ${article.category?.nom || 'Sport'}
                                </span>
                                <span class="text-gray-400 text-xs">${this.formatDate(article.created_at)}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition line-clamp-2">
                                ${article.titre || 'Titre de l\'article'}
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                                ${article.resume || ''}
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
        `;
    }

    updateFlashTicker(flashInfos) {
        if (!this.flashContainer) return;
        
        let html = flashInfos.map((flash, index) => {
            let icon = flash.icone ? `<i class="${flash.icone}"></i> ` : '';
            let separator = index < flashInfos.length - 1 ? ' • ' : '';
            return icon + flash.contenu + separator;
        }).join('');
        
        this.flashContainer.innerHTML = html;
    }

    formatDate(dateString) {
        if (!dateString) return '';
        
        const date = new Date(dateString);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMs / 3600000);
        const diffDays = Math.floor(diffMs / 86400000);
        
        if (diffMins < 1) return 'À l\'instant';
        if (diffMins < 60) return `Il y a ${diffMins} min`;
        if (diffHours < 24) return `Il y a ${diffHours}h`;
        if (diffDays < 7) return `Il y a ${diffDays} jour${diffDays > 1 ? 's' : ''}`;
        
        return date.toLocaleDateString('fr-FR');
    }
}

// Initialiser le rafraîchissement automatique quand le DOM est prêt
document.addEventListener('DOMContentLoaded', function() {
    // Rafraîchir toutes les 60 secondes pour les articles, 30 secondes pour les flash
    new AutoRefresh({
        articlesInterval: 60000,  // 1 minute
        flashInterval: 30000      // 30 secondes
    });
});

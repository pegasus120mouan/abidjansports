<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected ApiService $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $flashInfos = $this->apiService->getFlashInformations();
        $latestArticles = $this->apiService->getLatestArticles(10);

        $standings = [
            ['name' => 'ASEC Mimosas', 'played' => 18, 'points' => 42],
            ['name' => 'Africa Sports', 'played' => 18, 'points' => 38],
            ['name' => 'Racing Club', 'played' => 18, 'points' => 35],
            ['name' => 'Stade d\'Abidjan', 'played' => 18, 'points' => 32],
            ['name' => 'SOA', 'played' => 18, 'points' => 30],
        ];

        $popularArticles = [
            ['title' => 'Les Éléphants champions de la CAN 2024', 'views' => '125K'],
            ['title' => 'Transfert record pour un joueur ivoirien', 'views' => '89K'],
            ['title' => 'Le nouveau stade d\'Abidjan inauguré', 'views' => '67K'],
            ['title' => 'Didier Drogba nommé ambassadeur FIFA', 'views' => '54K'],
            ['title' => 'La Côte d\'Ivoire accueillera la CAN 2027', 'views' => '48K'],
        ];

        return view('home', compact('latestArticles', 'standings', 'popularArticles', 'flashInfos'))
            ->with('typePage', 'accueil');
    }

    public function article($slug)
    {
        $article = $this->apiService->getArticle($slug);
        
        if (!$article) {
            abort(404);
        }
        
        $latestArticles = $this->apiService->getLatestArticles(5);
        
        return view('article', compact('article', 'latestArticles'))
            ->with('typePage', 'article')
            ->with('articleId', $article['id'] ?? null);
    }

    public function category($slug)
    {
        $categoryColors = [
            'football' => 'orange',
            'basketball' => 'blue',
            'athletisme' => 'green',
            'tennis' => 'purple',
        ];

        $response = $this->apiService->getArticlesByCategory($slug);
        $articles = $response['data'] ?? [];
        $category = $response['category'] ?? null;
        $categoryName = $category['nom'] ?? ucfirst($slug);
        $categoryColor = $categoryColors[$slug] ?? 'gray';

        return view('category', [
            'category' => $category,
            'categoryName' => $categoryName,
            'categorySlug' => $slug,
            'categoryColor' => $categoryColor,
            'articles' => $articles,
            'typePage' => 'categorie',
        ]);
    }

    public function sousCategory($slug)
    {
        $response = $this->apiService->getArticlesBySousCategory($slug);
        $articles = $response['data'] ?? [];
        $sousCategory = $response['sous_category'] ?? null;
        $category = $sousCategory['category'] ?? null;
        
        $categoryColors = [
            'football' => 'orange',
            'basketball' => 'blue',
            'athletisme' => 'green',
            'tennis' => 'purple',
        ];
        
        $categoryColor = $categoryColors[$category['slug'] ?? ''] ?? 'gray';

        return view('category', [
            'category' => $category,
            'sousCategory' => $sousCategory,
            'categoryName' => $sousCategory['nom'] ?? ucfirst($slug),
            'categorySlug' => $slug,
            'categoryColor' => $categoryColor,
            'articles' => $articles,
        ]);
    }

    public function results()
    {
        $liveMatches = [
            [
                'competition' => 'Ligue 1 Ivoirienne',
                'minute' => 67,
                'home_team' => 'ASEC Mimosas',
                'home_abbr' => 'ASC',
                'home_color' => 'yellow-500',
                'home_score' => 2,
                'away_team' => 'Africa Sports',
                'away_abbr' => 'AFS',
                'away_color' => 'red-600',
                'away_score' => 1,
                'scorers' => ['Koné 23\'', 'Diallo 45\'', 'Touré 52\''],
            ],
            [
                'competition' => 'Ligue 1 Ivoirienne',
                'minute' => 34,
                'home_team' => 'Racing Club',
                'home_abbr' => 'RCA',
                'home_color' => 'green-600',
                'home_score' => 0,
                'away_team' => 'SOA',
                'away_abbr' => 'SOA',
                'away_color' => 'blue-600',
                'away_score' => 0,
                'scorers' => [],
            ],
        ];

        $todayResults = [
            'Ligue 1 Ivoirienne' => [
                ['home_team' => 'Stade d\'Abidjan', 'home_score' => 1, 'away_team' => 'Bouaké FC', 'away_score' => 2, 'status' => 'Terminé'],
                ['home_team' => 'Issia Wazi', 'home_score' => 0, 'away_team' => 'San Pedro', 'away_score' => 0, 'status' => 'Terminé'],
            ],
            'CAF Champions League' => [
                ['home_team' => 'Al Ahly', 'home_score' => 3, 'away_team' => 'Mamelodi', 'away_score' => 1, 'status' => 'Terminé'],
            ],
        ];

        $upcomingMatches = [
            [
                'competition' => 'Ligue 1 Ivoirienne',
                'date' => 'Demain',
                'time' => '16:00',
                'home_team' => 'ASEC Mimosas',
                'home_abbr' => 'ASC',
                'away_team' => 'Stade d\'Abidjan',
                'away_abbr' => 'STA',
                'venue' => 'Stade Félix Houphouët-Boigny',
            ],
            [
                'competition' => 'CAF Champions League',
                'date' => 'Sam. 15 Fév',
                'time' => '20:00',
                'home_team' => 'ASEC Mimosas',
                'home_abbr' => 'ASC',
                'away_team' => 'Al Ahly',
                'away_abbr' => 'AHL',
                'venue' => 'Stade Olympique d\'Ébimpé',
            ],
            [
                'competition' => 'Ligue 1 Ivoirienne',
                'date' => 'Dim. 16 Fév',
                'time' => '17:00',
                'home_team' => 'Africa Sports',
                'home_abbr' => 'AFS',
                'away_team' => 'Racing Club',
                'away_abbr' => 'RCA',
                'venue' => 'Stade Robert Champroux',
            ],
            [
                'competition' => 'Coupe Nationale',
                'date' => 'Mer. 19 Fév',
                'time' => '15:30',
                'home_team' => 'SOA',
                'home_abbr' => 'SOA',
                'away_team' => 'Bouaké FC',
                'away_abbr' => 'BFC',
                'venue' => 'Stade de Bouaké',
            ],
        ];

        return view('results', compact('liveMatches', 'todayResults', 'upcomingMatches'));
    }

    public function teams()
    {
        $fullStandings = [
            ['name' => 'ASEC Mimosas', 'abbr' => 'ASC', 'color' => 'yellow-500', 'played' => 18, 'won' => 13, 'drawn' => 3, 'lost' => 2, 'goals_for' => 35, 'goals_against' => 17, 'goal_diff' => 18, 'points' => 42, 'form' => ['W', 'W', 'D', 'W', 'W']],
            ['name' => 'Africa Sports', 'abbr' => 'AFS', 'color' => 'red-600', 'played' => 18, 'won' => 11, 'drawn' => 5, 'lost' => 2, 'goals_for' => 28, 'goals_against' => 14, 'goal_diff' => 14, 'points' => 38, 'form' => ['W', 'D', 'W', 'W', 'D']],
            ['name' => 'Racing Club', 'abbr' => 'RCA', 'color' => 'green-600', 'played' => 18, 'won' => 10, 'drawn' => 5, 'lost' => 3, 'goals_for' => 25, 'goals_against' => 15, 'goal_diff' => 10, 'points' => 35, 'form' => ['W', 'W', 'L', 'W', 'D']],
            ['name' => 'Stade d\'Abidjan', 'abbr' => 'STA', 'color' => 'blue-600', 'played' => 18, 'won' => 9, 'drawn' => 5, 'lost' => 4, 'goals_for' => 22, 'goals_against' => 16, 'goal_diff' => 6, 'points' => 32, 'form' => ['D', 'W', 'W', 'L', 'W']],
            ['name' => 'SOA', 'abbr' => 'SOA', 'color' => 'purple-600', 'played' => 18, 'won' => 8, 'drawn' => 6, 'lost' => 4, 'goals_for' => 20, 'goals_against' => 15, 'goal_diff' => 5, 'points' => 30, 'form' => ['D', 'D', 'W', 'W', 'L']],
            ['name' => 'San Pedro', 'abbr' => 'SPE', 'color' => 'cyan-600', 'played' => 18, 'won' => 7, 'drawn' => 6, 'lost' => 5, 'goals_for' => 18, 'goals_against' => 16, 'goal_diff' => 2, 'points' => 27, 'form' => ['L', 'W', 'D', 'W', 'D']],
            ['name' => 'Bouaké FC', 'abbr' => 'BFC', 'color' => 'amber-600', 'played' => 18, 'won' => 6, 'drawn' => 7, 'lost' => 5, 'goals_for' => 17, 'goals_against' => 17, 'goal_diff' => 0, 'points' => 25, 'form' => ['D', 'W', 'D', 'L', 'W']],
            ['name' => 'Issia Wazi', 'abbr' => 'ISW', 'color' => 'teal-600', 'played' => 18, 'won' => 5, 'drawn' => 6, 'lost' => 7, 'goals_for' => 15, 'goals_against' => 20, 'goal_diff' => -5, 'points' => 21, 'form' => ['L', 'D', 'L', 'W', 'D']],
            ['name' => 'Gagnoa', 'abbr' => 'GAG', 'color' => 'lime-600', 'played' => 18, 'won' => 4, 'drawn' => 5, 'lost' => 9, 'goals_for' => 14, 'goals_against' => 25, 'goal_diff' => -11, 'points' => 17, 'form' => ['L', 'L', 'D', 'L', 'W']],
            ['name' => 'Korhogo', 'abbr' => 'KOR', 'color' => 'rose-600', 'played' => 18, 'won' => 3, 'drawn' => 4, 'lost' => 11, 'goals_for' => 12, 'goals_against' => 28, 'goal_diff' => -16, 'points' => 13, 'form' => ['L', 'L', 'L', 'D', 'L']],
        ];

        $topScorers = [
            ['name' => 'Karim Konaté', 'team' => 'ASEC Mimosas', 'goals' => 12],
            ['name' => 'Youssouf Dao', 'team' => 'Africa Sports', 'goals' => 10],
            ['name' => 'Cheick Oumar', 'team' => 'Racing Club', 'goals' => 8],
            ['name' => 'Mamadou Sanogo', 'team' => 'Stade d\'Abidjan', 'goals' => 7],
            ['name' => 'Ibrahim Cissé', 'team' => 'SOA', 'goals' => 6],
        ];

        $topAssists = [
            ['name' => 'Franck Kessié Jr', 'team' => 'ASEC Mimosas', 'assists' => 8],
            ['name' => 'Abdoulaye Traoré', 'team' => 'Africa Sports', 'assists' => 7],
            ['name' => 'Jean-Philippe Gbamin', 'team' => 'Racing Club', 'assists' => 6],
            ['name' => 'Serge Aurier Jr', 'team' => 'SOA', 'assists' => 5],
            ['name' => 'Nicolas Pépé Jr', 'team' => 'San Pedro', 'assists' => 5],
        ];

        return view('teams', compact('fullStandings', 'topScorers', 'topAssists'));
    }

    public function boutique()
    {
        $response = $this->apiService->getJournals();
        $journals = $response['data'] ?? [];
        
        return view('boutique', compact('journals'))
            ->with('typePage', 'boutique');
    }

    public function journalDetail($slug)
    {
        $journal = $this->apiService->getJournal($slug);
        
        if (!$journal) {
            abort(404);
        }
        
        $latestJournals = $this->apiService->getLatestJournals(4);
        
        return view('journal-detail', compact('journal', 'latestJournals'))
            ->with('typePage', 'boutique');
    }
}

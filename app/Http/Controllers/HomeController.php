<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = [
            [
                'title' => 'Sébastien Haller de retour en sélection après sa guérison',
                'excerpt' => 'L\'attaquant ivoirien Sébastien Haller fait son grand retour en équipe nationale après avoir vaincu son cancer. Une nouvelle qui réjouit tous les fans des Éléphants.',
                'image' => 'https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?w=600&q=80',
                'category' => 'Football',
                'category_color' => 'orange',
                'author' => 'Kouamé Yao',
                'date' => 'Il y a 3 heures',
            ],
            [
                'title' => 'ASEC Mimosas : Le club forme une nouvelle génération de talents',
                'excerpt' => 'L\'académie de l\'ASEC continue de produire des joueurs de classe mondiale. Découvrez les jeunes pépites qui font rêver les recruteurs européens.',
                'image' => 'https://images.unsplash.com/photo-1560272564-c83b66b1ad12?w=600&q=80',
                'category' => 'Football',
                'category_color' => 'orange',
                'author' => 'Aminata Diallo',
                'date' => 'Il y a 5 heures',
            ],
            [
                'title' => 'Basketball : Les Éléphants préparent l\'Afrobasket 2025',
                'excerpt' => 'L\'équipe nationale de basketball intensifie sa préparation pour la prochaine édition de l\'Afrobasket. Le sélectionneur dévoile sa liste préliminaire.',
                'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=600&q=80',
                'category' => 'Basketball',
                'category_color' => 'blue',
                'author' => 'Jean-Marc Konan',
                'date' => 'Il y a 8 heures',
            ],
            [
                'title' => 'Marie-Josée Ta Lou : "Je vise l\'or aux JO de Los Angeles"',
                'excerpt' => 'La sprinteuse ivoirienne se confie sur ses ambitions pour les prochains Jeux Olympiques et son programme d\'entraînement intensif.',
                'image' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=600&q=80',
                'category' => 'Athlétisme',
                'category_color' => 'green',
                'author' => 'Fatou Bamba',
                'date' => 'Hier',
            ],
            [
                'title' => 'Ligue 1 : Africa Sports remporte le derby d\'Abidjan',
                'excerpt' => 'Dans un match intense au stade Félix Houphouët-Boigny, Africa Sports s\'impose face à son rival historique grâce à un but dans les dernières minutes.',
                'image' => 'https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=600&q=80',
                'category' => 'Football',
                'category_color' => 'orange',
                'author' => 'Ibrahim Touré',
                'date' => 'Hier',
            ],
        ];

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

        return view('home', compact('articles', 'standings', 'popularArticles'));
    }

    public function category($slug)
    {
        $categoryColors = [
            'football' => 'orange',
            'basketball' => 'blue',
            'athletisme' => 'green',
            'tennis' => 'purple',
        ];

        $categoryColor = $categoryColors[$slug] ?? 'gray';

        $articles = $this->getArticlesByCategory($slug);

        return view('category', [
            'category' => $slug,
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

    private function getArticlesByCategory($category)
    {
        $allArticles = [
            'football' => [
                [
                    'title' => 'Les Éléphants préparent les éliminatoires de la Coupe du Monde 2026',
                    'excerpt' => 'L\'équipe nationale de Côte d\'Ivoire entame sa préparation pour les prochaines échéances internationales avec un stage de deux semaines.',
                    'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=600&q=80',
                    'author' => 'Kouamé Yao',
                    'date' => 'Il y a 2 heures',
                ],
                [
                    'title' => 'ASEC Mimosas : Victoire écrasante en Ligue des Champions CAF',
                    'excerpt' => 'Le club ivoirien s\'impose 4-1 face à son adversaire et se qualifie pour les quarts de finale de la compétition continentale.',
                    'image' => 'https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?w=600&q=80',
                    'author' => 'Aminata Diallo',
                    'date' => 'Il y a 5 heures',
                ],
                [
                    'title' => 'Transfert : Un international ivoirien rejoint la Premier League',
                    'excerpt' => 'Le milieu de terrain signe un contrat de 5 ans avec un club anglais pour un montant record.',
                    'image' => 'https://images.unsplash.com/photo-1560272564-c83b66b1ad12?w=600&q=80',
                    'author' => 'Ibrahim Touré',
                    'date' => 'Hier',
                ],
                [
                    'title' => 'Ligue 1 : Le classement des buteurs après la 18ème journée',
                    'excerpt' => 'Karim Konaté de l\'ASEC Mimosas domine le classement avec 12 réalisations cette saison.',
                    'image' => 'https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=600&q=80',
                    'author' => 'Jean-Marc Konan',
                    'date' => 'Hier',
                ],
                [
                    'title' => 'Africa Sports : Le club annonce son nouveau sponsor principal',
                    'excerpt' => 'Un partenariat historique qui va permettre au club de renforcer son effectif pour la saison prochaine.',
                    'image' => 'https://images.unsplash.com/photo-1517466787929-bc90951d0974?w=600&q=80',
                    'author' => 'Fatou Bamba',
                    'date' => 'Il y a 2 jours',
                ],
            ],
            'basketball' => [
                [
                    'title' => 'Afrobasket 2025 : La Côte d\'Ivoire dans le groupe de la mort',
                    'excerpt' => 'Le tirage au sort place les Éléphants basketteurs dans un groupe relevé avec le Nigeria et le Sénégal.',
                    'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=600&q=80',
                    'author' => 'Jean-Marc Konan',
                    'date' => 'Il y a 3 heures',
                ],
                [
                    'title' => 'NBA : Un Ivoirien drafté au premier tour',
                    'excerpt' => 'Le jeune pivot ivoirien réalise son rêve en rejoignant la plus grande ligue de basketball au monde.',
                    'image' => 'https://images.unsplash.com/photo-1504450758481-7338bbe75c8e?w=600&q=80',
                    'author' => 'Kouamé Yao',
                    'date' => 'Hier',
                ],
                [
                    'title' => 'Championnat national : ABC domine la compétition',
                    'excerpt' => 'L\'Association Basket Club d\'Abidjan reste invaincu après 10 journées de championnat.',
                    'image' => 'https://images.unsplash.com/photo-1519861531473-9200262188bf?w=600&q=80',
                    'author' => 'Aminata Diallo',
                    'date' => 'Il y a 2 jours',
                ],
            ],
            'athletisme' => [
                [
                    'title' => 'Marie-Josée Ta Lou bat son record personnel sur 100m',
                    'excerpt' => 'La sprinteuse ivoirienne réalise un temps de 10.72 secondes lors du meeting de Paris.',
                    'image' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=600&q=80',
                    'author' => 'Fatou Bamba',
                    'date' => 'Il y a 4 heures',
                ],
                [
                    'title' => 'Championnats d\'Afrique : 5 médailles pour la Côte d\'Ivoire',
                    'excerpt' => 'La délégation ivoirienne brille aux championnats continentaux avec 2 or, 2 argent et 1 bronze.',
                    'image' => 'https://images.unsplash.com/photo-1461896836934- voices-of-the-world?w=600&q=80',
                    'author' => 'Ibrahim Touré',
                    'date' => 'Hier',
                ],
                [
                    'title' => 'JO 2028 : Les espoirs ivoiriens en athlétisme',
                    'excerpt' => 'Focus sur les jeunes talents qui représenteront la Côte d\'Ivoire aux prochains Jeux Olympiques.',
                    'image' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=600&q=80',
                    'author' => 'Jean-Marc Konan',
                    'date' => 'Il y a 3 jours',
                ],
            ],
            'tennis' => [
                [
                    'title' => 'Open d\'Abidjan : Le tournoi international revient en 2025',
                    'excerpt' => 'La capitale économique accueillera à nouveau un tournoi ATP Challenger au mois de mars.',
                    'image' => 'https://images.unsplash.com/photo-1554068865-24cecd4e34b8?w=600&q=80',
                    'author' => 'Kouamé Yao',
                    'date' => 'Il y a 6 heures',
                ],
                [
                    'title' => 'Tennis ivoirien : Une nouvelle génération prometteuse',
                    'excerpt' => 'Les jeunes joueurs ivoiriens se distinguent dans les tournois juniors internationaux.',
                    'image' => 'https://images.unsplash.com/photo-1595435934249-5df7ed86e1c0?w=600&q=80',
                    'author' => 'Aminata Diallo',
                    'date' => 'Hier',
                ],
            ],
        ];

        return $allArticles[$category] ?? [];
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ApiService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url', 'http://abidjansports-admin.test/api');
    }

    public function getCategories()
    {
        return Cache::remember('menu_categories', 300, function () {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/categories");
                
                if ($response->successful()) {
                    return $response->json('data') ?? [];
                }
                
                return [];
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    public function getFlashInformations()
    {
        return Cache::remember('flash_informations', 60, function () {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/flash-informations");
                
                if ($response->successful()) {
                    return $response->json('data') ?? [];
                }
                
                return [];
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    public function getArticles($limit = 10)
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/articles", [
                'limit' => $limit
            ]);
            
            if ($response->successful()) {
                return $response->json('data') ?? [];
            }
            
            return [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getLatestArticles($limit = 5)
    {
        return Cache::remember("latest_articles_{$limit}", 120, function () use ($limit) {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/articles/latest", [
                    'limit' => $limit
                ]);
                
                if ($response->successful()) {
                    return $response->json('data') ?? [];
                }
                
                return [];
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    public function getArticlesByCategory($slug)
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/articles/category/{$slug}");
            
            if ($response->successful()) {
                return $response->json() ?? [];
            }
            
            return [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getArticlesBySousCategory($slug)
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/articles/sous-category/{$slug}");
            
            if ($response->successful()) {
                return $response->json() ?? [];
            }
            
            return [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getArticle($slug)
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/articles/{$slug}");
            
            if ($response->successful()) {
                return $response->json('data') ?? null;
            }
            
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}

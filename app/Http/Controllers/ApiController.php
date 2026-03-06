<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected ApiService $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function latestArticles(Request $request)
    {
        $limit = $request->get('limit', 10);
        $articles = $this->apiService->getLatestArticles($limit);
        
        return response()->json([
            'success' => true,
            'data' => $articles,
            'timestamp' => now()->toIso8601String()
        ]);
    }

    public function flashInfos()
    {
        $flashInfos = $this->apiService->getFlashInformations();
        
        return response()->json([
            'success' => true,
            'data' => $flashInfos,
            'timestamp' => now()->toIso8601String()
        ]);
    }
}

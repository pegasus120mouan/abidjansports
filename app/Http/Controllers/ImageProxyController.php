<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageProxyController extends Controller
{
    /**
     * Proxy pour les images MinIO
     * Permet de servir les images via HTTPS
     */
    public function show($path)
    {
        $minioUrl = 'http://51.178.49.141:9000/abidjansports/' . $path;
        
        try {
            $response = Http::timeout(10)->get($minioUrl);
            
            if ($response->successful()) {
                $contentType = $response->header('Content-Type') ?? 'image/jpeg';
                
                return response($response->body())
                    ->header('Content-Type', $contentType)
                    ->header('Cache-Control', 'public, max-age=86400, immutable')
                    ->header('Access-Control-Allow-Origin', '*');
            }
            
            abort(404);
        } catch (\Exception $e) {
            abort(404);
        }
    }
}

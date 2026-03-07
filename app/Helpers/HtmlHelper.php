<?php

namespace App\Helpers;

class HtmlHelper
{
    /**
     * Nettoie le contenu HTML provenant de Microsoft Word
     */
    public static function cleanWordHtml($html)
    {
        if (empty($html)) {
            return '';
        }

        // Supprimer les commentaires conditionnels IE/Word
        $html = preg_replace('/<!--\[if[^\]]*\]>.*?<!\[endif\]-->/is', '', $html);
        $html = preg_replace('/<!--\[if[^\]]*\]>.*?<!\[endif\]-->/is', '', $html);
        
        // Supprimer les balises XML Word
        $html = preg_replace('/<\?xml[^>]*>/i', '', $html);
        $html = preg_replace('/<o:[^>]*>.*?<\/o:[^>]*>/is', '', $html);
        $html = preg_replace('/<w:[^>]*>.*?<\/w:[^>]*>/is', '', $html);
        $html = preg_replace('/<m:[^>]*>.*?<\/m:[^>]*>/is', '', $html);
        $html = preg_replace('/<st1:[^>]*>.*?<\/st1:[^>]*>/is', '', $html);
        
        // Supprimer les balises XML auto-fermantes
        $html = preg_replace('/<o:[^>]*\/>/i', '', $html);
        $html = preg_replace('/<w:[^>]*\/>/i', '', $html);
        $html = preg_replace('/<m:[^>]*\/>/i', '', $html);
        
        // Supprimer les balises style Word
        $html = preg_replace('/<style[^>]*>.*?<\/style>/is', '', $html);
        
        // Supprimer les attributs de style Word
        $html = preg_replace('/\s*mso-[^:]+:[^;"]+;?/i', '', $html);
        $html = preg_replace('/\s*class="Mso[^"]*"/i', '', $html);
        
        // Supprimer les spans vides
        $html = preg_replace('/<span[^>]*>\s*<\/span>/i', '', $html);
        
        // Supprimer les divs vides
        $html = preg_replace('/<div[^>]*>\s*<\/div>/i', '', $html);
        
        // Supprimer les paragraphes vides
        $html = preg_replace('/<p[^>]*>\s*(&nbsp;)?\s*<\/p>/i', '', $html);
        
        // Nettoyer les espaces multiples
        $html = preg_replace('/\s+/', ' ', $html);
        
        // Supprimer les balises font
        $html = preg_replace('/<\/?font[^>]*>/i', '', $html);
        
        // Garder seulement les balises HTML de base
        $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><a><img><blockquote><table><tr><td><th><thead><tbody>';
        $html = strip_tags($html, $allowedTags);
        
        return trim($html);
    }

    /**
     * Transforme une URL d'image MinIO en URL proxy HTTPS
     */
    public static function proxyImageUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        // Remplacer l'URL MinIO par le proxy local
        $minioPattern = 'http://51.178.49.141:9000/abidjansports/';
        $proxyUrl = url('/images') . '/';
        
        return str_replace($minioPattern, $proxyUrl, $url);
    }

    /**
     * Convertit le texte brut en HTML avec des paragraphes
     */
    public static function textToHtml($text)
    {
        if (empty($text)) {
            return '';
        }

        // Échapper le HTML
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        
        // Convertir les sauts de ligne en paragraphes
        $paragraphs = preg_split('/\n\s*\n/', $text);
        $html = '';
        
        foreach ($paragraphs as $paragraph) {
            $paragraph = trim($paragraph);
            if (!empty($paragraph)) {
                $paragraph = nl2br($paragraph);
                $html .= '<p>' . $paragraph . '</p>';
            }
        }
        
        return $html;
    }
}

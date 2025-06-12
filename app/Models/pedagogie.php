<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pedagogie extends Model
{
        use HasFactory;

    protected $table = 'pedagogie_resources';

    protected $fillable = [
        'title',
        'description',
        'type', // 'video' ou 'article'
        'content', // Contenu HTML pour les articles
        'video_url', // URL pour les vidéos
        'thumbnail', // Image miniature
        'is_free', // Indique si la ressource est gratuite ou premium
        'section', // Section dans laquelle la ressource apparaît (ex: 'dروس مجانية', 'الحلقات التالية')
        'order', // Ordre d'affichage
        'status', // 'published' ou 'draft'
    ];

    /**
     * Récupérer les ressources gratuites
     */
    public static function getFreeResources()
    {
        return self::where('is_free', true)
                  ->where('status', 'published')
                  ->orderBy('order')
                  ->get();
    }

    /**
     * Récupérer les ressources premium
     */
    public static function getPremiumResources()
    {
        return self::where('is_free', false)
                  ->where('status', 'published')
                  ->orderBy('order')
                  ->get();
    }

}

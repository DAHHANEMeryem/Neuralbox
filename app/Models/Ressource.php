<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'video_url',
        'categorie',
        'category_id',
        'visibilite',
        'preview_image',
        'ordre'
    ];


    /**
     * Récupère les ressources par catégorie et visibilité
     */
    public static function getRessources($categorie, $visibilite = null)
    {
        $query = self::with('category')->where('categorie', $categorie);

        if ($visibilite) {
            $query->where(function($q) use ($visibilite) {
                $q->where('visibilite', $visibilite);
            });
        }
        return $query->orderBy('ordre', 'asc')->get();
        // return $query->orderBy('ordre', 'asc')->get()
        //     ->groupBy(function ($item) {
        //     return $item->category->name ?? 'بدون فئة';
        //     });
    }

    public function category()
    {
        return $this->belongsTo(Category::class,);
    }
}
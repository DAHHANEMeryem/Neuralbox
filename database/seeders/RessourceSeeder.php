<?php

namespace Database\Seeders;

use App\Models\Ressource;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RessourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        // Ressources pédagogiques gratuites
        Ressource::create([
           'titre' => 'الفرق بين الانتباه والتركيز',
                'description' => 'شرح مبسط للفرق بين المفهومين، وكيفية تنمية كل منهما لدى طفلك.',
                'video_url' => 'Tool-1.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'tous',
                'preview_image' => 'images/peda/1.png',
                'ordre' => 1,
        ]);
        Ressource::create([
           'titre' => 'الفرق بين الانتباه والتركيز',
                'description' => 'شرح مبسط للفرق بين المفهومين، وكيفية تنمية كل منهما لدى طفلك.',
                'video_url' => 'Tool-1.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/peda/1.png',
                'ordre' => 1,
        ]);


       Ressource::create(['titre' => 'الأداة الأولى – ميكادو',
                'description' => 'مجموعة من الأعواد الخشبية الملونة، حيث يُمثل كل عود قيمة معينة. يتم وضعها بشكل عشوائي على سطح مستوٍ، ثم يقوم اللاعبون بمحاولة استخراج الأعواد واحدة تلو الأخرى دون تحريك الأعواد الأخرى مما يحسن التركيز و الانتباه و تعزز التنسيق الحركي و التفكير الاستراتيجي.',
                'video_url' => 'Tool-1.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'tous',
                'preview_image' => 'Tool-1.jpg',
                'ordre' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]); 
             Ressource::create(['titre' => 'الأداة الخامسة – البطاقة البريدية',
            'description' => 'بطاقة بريدية  تحتوي على رسومات لأشكال مختلفة مغطاة بطبقة قابلة للحك. عند حك هذه الطبقة، يكشف الطفل عن الشكل المخفي. تتطلب هذه العملية الدقة والصبر، وتشجع الطفل على عدم التسرع في الكشف عن الشكل، بل بالاستمتاع بعملية الاكتشاف خطوة بخطوة.',
            'video_url' => 'Tool-1.mp4',
            'categorie' => 'neuralbox',
            'visibilite' => 'abonne',
            'preview_image' => 'tool-1.jpg',
                'ordre' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ]); 
        







}}

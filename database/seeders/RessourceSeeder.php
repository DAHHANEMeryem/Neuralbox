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
                'video_url' => 'pedavd1.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'tous',
                'preview_image' => 'images/peda/1.png',
                'ordre' => 1,
        ]);
    Ressource::create([
            'titre' => 'أنواع التركيز و الانتباه',
                'description' => 'كل نوع من الإنتباه و التركيز يعكس طريقة تعامل العقل مع المهام والمحفزات المحيطة...',
                'video_url' => 'pedavd2.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'tous',
                'preview_image' => 'images/MrAbdessamad_video_covers-05.jpg',
                'ordre' => 2,
        ]);
            Ressource::create([
           'titre' => 'اضطراب فرط الحركة و تشتت الانتباه',
                'description' => 'اكتشفوا المكونات الثلاث الأساسية التي تميز هذا الإضطراب، وكيف تؤثر كل واحدة منها على السلوك والتعلم.',
                'video_url' => 'mikado.mp4', // Remplacez avec le vrai nom de fichier si disponible
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 3,
        ]);
            Ressource::create([
            'titre' => 'التمييز بين اضطراب فرط الحركة وتشتت الانتباه ومشكل فرط الحركة و تشتت الانتباه',
                'description' => 'ليس كل طفل كثير الحركة يعاني من اضطراب! هذا الفيديو يوضح الفروق الدقيقة لمساعدة الأهل على الفهم واتخاذ القرار الصحيح',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 4,
        ]);
            Ressource::create([
           'titre' => 'تقدير الذات',
                'description' => 'مهارة تساعد الطفل على تقبّل نفسه، وبناء صورة إيجابية عنها، والشعور بالحب والثقة.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 5,
        ]);
            Ressource::create([
           
                'titre' => 'كلمات يجب أن يسمعها طفلك',
                'description' => 'عبارات يومية تعزز الثقة بالنفس، الشعور بالأمان، وتغذي الذكاء العاطفي.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 6,
        ]);
            Ressource::create([
           'titre' => 'الذكاء العاطفي',
                'description' => 'القدرة على فهم المشاعر والتحكم فيها والتفاعل بإيجابية مع الآخرين و مع مشاعره.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 7,
        ]);
            Ressource::create([
           'titre' => 'قيم النجاح الستة',
                'description' => 'مبادئ أساسية تساعد الطفل على بناء شخصية قوية وتحقيق أهدافه بثبات.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 8,
        ]);
            Ressource::create([
            'titre' => 'منارة الحياة',
                'description' => 'رؤية واضحة توجه الطفل في اتخاذ قراراته وتمنحه هدفًا يعيش من أجله.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 9,
        ]);
            Ressource::create([
           
                'titre' => 'القاعدة الثلاثية',
                'description' => 'تقنية تعتمد على ثلاث مراحل لترسيخ المعلومات في الذاكرة بشكل فعال.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 10,
        ]);
            Ressource::create([
            'titre' => 'الركائز السبع للتعلم',
                'description' => 'نموذج يربط بين سبعة عناصر تساعد في تحسين بيئة التعلم.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 11,
        ]);
            Ressource::create([
            'titre' => 'الخريطة الذهنية',
                'description' => 'أداة بصرية تنظم الأفكار وتساعد على الفهم والمراجعة.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 12,
        ]);
            Ressource::create([
            'titre' => 'الماندالا',
                'description' => 'تمارين تلوين دائرية تساعد على التركيز والاسترخاء.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 13,
        ]);
        Ressource::create([
           'titre' => 'منحنى الإنتاجية',
                'description' => 'أداة لفهم أفضل أوقات تركيز الطفل خلال اليوم.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/peda/1.png',
                'ordre' => 14,
        ]);

        // Ressources pédagogiques premium
        Ressource::create([
           'titre' => 'الساعة البيولوجية',
                'description' => 'تساعد في تنظيم وقت النوم والتعلم حسب نشاط الجسم الطبيعة.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 15,
        ]);

        Ressource::create([
            'titre' => 'تخطيط الأسابيع الثلاث',
                'description' => 'تقنية لتنظيم التعلم والمراجعة على مدى ثلاث أسابيع.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 16,
        ]);

        Ressource::create([
            'titre' => 'الطريقة الصحيحة للتعلم',
                'description' => 'خطوات لفهم الدرس، تلخيصه، تدريبه ثم اجتيازه بنجاح.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/peda/1.png',
                'ordre' => 17,
             'created_at' => $now,
                'updated_at' => $now
        ]);
          Ressource::create([
           'titre' => 'تقنية 20-50 سؤالاً',
                'description' => 'تحفز الطفل على طرح أسئلة لفهم أعمق للمحتوى.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/peda/1.png',
                'ordre' => 18,
             'created_at' => $now,
                'updated_at' => $now
        ]);
          Ressource::create([
           'titre' => 'الرابط الذهني',
                'description' => 'استخدام الحواس والمسرح والرسم لترسيخ المعلومة.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/peda/1.png',
                'ordre' => 19,
             'created_at' => $now,
                'updated_at' => $now
        ]);
          Ressource::create([
           'titre' => 'نمط VAK',
                'description' => 'يوضح أساليب التعلم الثلاثة: البصري، السمعي، الحسي الحركي.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/peda/1.png',
                'ordre' => 20,
             'created_at' => $now,
                'updated_at' => $now
        ]);
          Ressource::create([
           'titre' => 'التعلم النشيط',
                'description' => 'يجعل الطفل فاعلاً في التعلم من خلال الممارسة والمشاركة.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 21,
             'created_at' => $now,
                'updated_at' => $now
        ]);
          Ressource::create([
            'titre' => 'جدول القائد',
                'description' => 'وسيلة لتحفيز الطفل عبر تتبع الإنجازات وتعزيز الثقة بالنفس.',
                'video_url' => 'mikado.mp4',
                'categorie' => 'pedagogie',
                'visibilite' => 'abonne',
                'preview_image' => 'images/MrAbdessamad_video_covers-04.jpg',
                'ordre' => 22,
             'created_at' => $now,
                'updated_at' => $now
        ]);






       Ressource::create(['titre' => 'الأداة الأولى – ميكادو',
                'description' => 'مجموعة من الأعواد الخشبية الملونة، حيث يُمثل كل عود قيمة معينة. يتم وضعها بشكل عشوائي على سطح مستوٍ، ثم يقوم اللاعبون بمحاولة استخراج الأعواد واحدة تلو الأخرى دون تحريك الأعواد الأخرى مما يحسن التركيز و الانتباه و تعزز التنسيق الحركي و التفكير الاستراتيجي.',
                'video_url' => 'Micado.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'tous',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]);
              Ressource::create([ 'titre' => 'الأداة الثانية – الهلال',
                'description' => 'قاعدة خشبية نصف دائرية على شكل هلال، ومجموعة من القطع الخشبية الملونة بأحجام مختلفة. يتم تركيب هذه القطع فوق القاعدة  دون إسقاطها و تتطلب دقة وتوازنًا عاليًا مما يحسن التركيز والانتباه و ينمي المهارات الحركية الدقيقة و المهارات التنظيمية.',
                'video_url' => 'Hilal.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'tous',
                'preview_image' => 'MrAbdessamad_video_covers-02.jpg',
                'ordre' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create(['titre' => 'الأداة الثالثة – صناديق التوازن',
                'description' => 'لعبة الموازنة هي تحدٍّ دقيق يتطلب إدخال كرات صغيرة في ثقوب محددة داخل أكثر من عشرين صندوقًا صغيرًا. تعتمد اللعبة على تحريك الصناديق بمهارة لتحقيق التوازن المطلوب وتوجيه الكرات بدقة نحو أماكنها الصحيحة. مما يساعد على تطور مستوى التركيز، تعزيز الذكاء، وتحسين المهارات الحركية الدقيقة.',
                'video_url' => 'balance_boxes.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create(['titre' => 'الأداة الرابعة – ستيم',
                'description' => 'لعبة تتطلب الدقة و استعمال الأدوات و القطع المتاحة للبناء و التركيب، وتساعد في تنمية مهارات التفكير النقدي وحل المشكلات  مما يعزز لديهم الإبداع والابتكار والاهتمام بمجالات العلوم والتكنولوجيا.',
                'video_url' => 'steam.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create(['titre' => 'الأداة الخامسة – البطاقة البريدية',
                'description' => 'بطاقة بريدية  تحتوي على رسومات لأشكال مختلفة مغطاة بطبقة قابلة للحك. عند حك هذه الطبقة، يكشف الطفل عن الشكل المخفي. تتطلب هذه العملية الدقة والصبر، وتشجع الطفل على عدم التسرع في الكشف عن الشكل، بل بالاستمتاع بعملية الاكتشاف خطوة بخطوة.',
                'video_url' => 'postcard.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create([ 'titre' => 'الأداة السادسة – الصندوق الغامض',
                'description' => 'مجموعة من الصناديق الخشبية المغلقة، تختلف في الأحجام والأشكال. تحتوي كل منها على أجزاء سرية يمكن إزالتها, مما يعزز الانتباه و التركيز و مهارة حل المشكلات و حس الاكتشاف ضمن لعبة ممتعة.',
                'video_url' => 'mystery_box.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create(['titre' => 'الأداة السابعة – قطع التركيب',
                'description' => 'مجموعة من القطع الصغيرة الملونة ذات الأشكال المختلفة، مصممة لتجميعها معًا لبناء أكثر من أربعة عشر شكلاً معقدًا تتطلب تركيزا كبير مع استخدام التفكير المنطقي و أيضا تنمية الصبر والمثابرة.',
                'video_url' => 'puzzle_pieces.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create(['titre' => 'الأداة الثامنة – جونغا',
                'description' => 'مجموعة من القطع الخشبية المستطيلة، يتم ترتيبها لتكوين برج عالٍ حيث يتم سحب قطعة واحدة من البرج ووضعها في الأعلى، مع الحرص على عدم إسقاط البرج و تتطلب هذه اللعبة تركيزًا عاليًا وانتباهًا للتفاصيل مع التخطيط وتحليل الموقف قبل اتخاذ القرار.',
                'video_url' => 'jenga.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 8,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create(['titre' => 'الأداة التاسعة – التنغرام',
                'description' => 'مجموعة من سبع قطع هندسية مسطحة يمكن تجميعها لتكوين أشكال مختلفة لا متناهية، مثل الحيوانات، الأشخاص، الأشياء، أو الأشكال الهندسية و تعزز الإبداع والخيال و أيضا تنمية مهارات التمييز البصري, التفكير المنطقي و التركيز.',
                'video_url' => 'tangram.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 9,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create([
                'titre' => 'الأداة العاشرة – المطابقة',
                'description' => 'مجموعة من الصور الكاملة المقسمة إلى قطع صغيرة بأحجام وأشكال وألوان مختلفة. يجب على الأطفال مطابقة القطع مع الأجزاء المناسبة من الصورة لإكمالها حيث تعزز التنسيق بين اليد و العين و أيضا التركيز و الانتباه, كما يتعلم الطفل كيفية التمييز بين الأشكال والأحجام والألوان المختلفة.',
                'video_url' => 'matching.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 10,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create([ 'titre' => 'الأداة الحادية عشرة – ألواح الأشكال المتداخلة',
                'description' => 'لوحة مقسمة إلى مربعات صغيرة، ومجموعة من الألواح الملونة بأشكال مختلفة. يجب وضع القطع الملونة في اللوحة بحيث تتناسب مع الفراغات وتكمل الشكل الكامل حيث تنمي مهارة التخطيط الاستراتيجي و التفكير التحليلي.',
                'video_url' => 'interlocking_shapes.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 11,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create([ 'titre' => 'الأداة الثانية عشرة – أوراق الأوريغامي',
                'description' => 'أوراق ملونة مخصصة لفن الأوريغامي مع دليل  يحتوي على صور توضح خطوات تشكيل الأشكال المختلفة حيث تساهم  في تعزيز الإبداع والتفكير الابتكاري, الاعتماد على النفس و أيضا الانتباه و التركيز.',
                'video_url' => 'origami.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 12,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create([ 'titre' => 'الأداة الثالثة عشرة – لعبة الذاكرة',
                'description' => 'لوحة مربعة تحتوي على بطاقات تتضمن أشكالًا ورموزًا مختلفة. يجب على الطفل تذكر الأشكال المتطابقة قبل تغطية البطاقات، ومحاولة العثور على الأشكال المتطابقة على تقوية الذاكرة البصرية, التركيز و الانتباه, أيضا مهارة التفكير السريع و التمييز البصري.',
                'video_url' => 'memory_game.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 13,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create([
                'titre' => 'الأداة الرابعة عشرة – كرة المتاهة الذكية',
                'description' => 'كرة شفافة تحتوي على متاهة ثلاثية الأبعاد داخلية، مع مسارات وأرقام. يجب على اللاعبين تحريك الكرة لتوجيهها صمن مسارات صغيرة عبر المتاهة، باتباع ترتيب الأرقام، مما يحتاج لتركيز عال و دقة في الحركة و التنسيق بين اليد و العين, كما تحتاج عدم التسرع و الهدوء للوصول للهدف.',
                'video_url' => 'maze_ball.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 14,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create(['titre' => 'الأداة الخامسة عشرة – الصلصال الملون',
                'description' => 'مجموعة من الرسومات المتنوعة لأشكال غير ملونة، مطبوعة على ورق مقوى. تأتي مع مجموعة من الصلصال الملون بألوان مختلفة. يمكن للأطفال استخدام الصلصال لتلوين الرسومات، تمامًا كما يستخدمون الملونات.',
                'video_url' => 'colored_clay.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 15,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create([ 'titre' => 'الأداة السادسة عشرة – لعبة الألغاز الدوارة والمنزلقة',
                'description' => 'مجموعة من الألغاز الأسطوانية الملونة، تتكون من حلقات دوارة ومنزلقة. يجب على اللاعبين تدوير الحلقات وتحريكها لترتيب الألوان بشكل صحيح، ومطابقة الأنماط الموجودة على الأسطوانة.',
                'video_url' => 'sliding_puzzles.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 16,
                'created_at' => $now,
                'updated_at' => $now
            ]);  Ressource::create(['titre' => 'الأداة السابعة عشرة – كرة الألوان المتطابقة',
                'description' => 'كرة مجوفة تحتوي على كرات صغيرة ملونة داخلها، تتوافق مع فتحات ملونة على السطح الخارجي للكرة. يجب على اللاعبين تحريك الكرات الصغيرة لتطابق ألوانها مع ألوان الفتحات الموجودة على السطح الخارجي للكرة.',
                'video_url' => 'matching_colors_ball.mp4',
                'categorie' => 'neuralbox',
                'visibilite' => 'abonne',
                'preview_image' => 'MrAbdessamad_video_covers-04.jpg',
                'ordre' => 17,
                'created_at' => $now,
                'updated_at' => $now
            ]); 
        







}}

@extends('layouts.app')

@section('title', 'نيورال بوكس | دلبل نيورال بوكس')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pedagogie.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo&family=Changa&family=Lalezar&family=Reem+Kufi&family=Noto+Naskh+Arabic&family=Scheherazade+New&family=El+Messiri&family=Markazi+Text&family=Harmattan&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!--<div class="wave-container wave-top">
  <div class="wave wave-1"></div>
  <div class="wave wave-2"></div>
  <div class="wave wave-3"></div>
</div> -->
<div class="banner-wrapper">
  <div class="banner-container">
    <div class="course-content-section1">
      <h1 class="course-title">محتوى نيورال بوكس</h1>

      <p class="instructor">
        من تقديم
        <span>
          <a href="https://www.instagram.com/mr.abdessamad.officiel/" target="_blank">
            ذ. عبدالصمد أشتاشن
          </a>
        </span>
      </p>

      <p class="course-detail">مدة الدورة: ساعتان و نصف / 30 فيديو</p>
      <p class="course-detail">اللغة: العربية</p>
      <p class="course-detail">فيديوهات مرفقة بمراجع وخطط اشتغال</p>

      <div class="course-buttons">
        <a href="subscribe" class="custom-btn">اشترك الآن</a>
        <a href="#" class="custom-btn" onclick="shareCourse(event)">
          <span>شارك الدورة</span>
          <i class="fas fa-share-alt"></i>
        </a>
      </div>
    </div>

    <div class="image-section">
      <div class="image5">
        <div class="video" style="position: relative;">
          <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" />

          <a href="javascript:void(0)" data-video="pourqoi.mp4" class="open-video overlay-box">
            <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
          </a>
          <video controls style="display: none;">
            <source src="{{ asset('videos/pourqoi.mp4') }}" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="wave-container wave-top">
  <div class="wave wave-1"></div>
  <div class="wave wave-2"></div>
  <div class="wave wave-3"></div>
</div>
<br>
<div class="content">
  <p class=" custom-title">
    سيقدم لك دليل نيورال بوكس جميع الأدوات العلمية و الألعاب التربوية التي تحتاجها و التي سترافقك طوال رحلتك مع الصندوق, أدوات تجمع بين المتعة و التعلم تم اختيارها على أسس علمية و بناءا على تجربة أخصائي معهد العلوم العصبية و المواكبة في مجال الكوتشينغ, المرافقة النفسية و العلوم العصبية مع شرح تفصيلي لكل أداة. </p>
</div><br>


<div class="video-section">


  <aside class="sidebar" dir="rtl">
    <header class="header">
      <h1>محتوى نيورال بوكس</h1>
    </header>

    <div class="course-section" id="free-section">
      <div class="section-header" onclick="toggleSection(this)">
        <h2>دروس مجانية</h2>
        <div class="arrow-icon">&#9650;</div>
      </div>
      <div class="section-content open">
        <div class="lesson-item">
          <!-- <div class="lesson-free">درس مجاني</div>-->
          <details class="tool-item">
            <summary>الأداة الأولى – ميكادو</summary>
            <p>
              مجموعة من الأعواد الخشبية الملونة، حيث يُمثل كل عود قيمة معينة. يتم وضعها بشكل عشوائي على سطح مستوٍ، ثم يقوم اللاعبون بمحاولة استخراج الأعواد واحدة تلو الأخرى دون تحريك الأعواد الأخرى مما يحسن التركيز و الانتباه و تعزز التنسيق الحركي و التفكير الاستراتيجي.
            </p>

            <div class="video" style="position: relative;">
              <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" />

              <a href="javascript:void(0)" data-video="Micado.mp4" class="open-video overlay-box">
                <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
              </a>
              <video controls style="display: none;">
                <source src="{{ asset('videos/Micado.mp4') }}" type="video/mp4">
              </video>
            </div>
          </details>
        </div>

        <div class="lesson-item">
          <!-- <div class="lesson-free">درس مجاني</div>-->
          <details class="tool-item">
            <summary>الأداة الثانية – الهلال</summary>
            <p>قاعدة خشبية نصف دائرية على شكل هلال، ومجموعة من القطع الخشبية الملونة بأحجام مختلفة. يتم تركيب هذه القطع فوق القاعدة دون إسقاطها و تتطلب دقة وتوازنًا عاليًا مما يحسن التركيز والانتباه و ينمي المهارات الحركية الدقيقة و المهارات التنظيمية.</p>

            <div class="video" style="position: relative;">
              <img src="images/MrAbdessamad_video_covers-02.jpg" alt="Aperçu vidéo" id="preview-image" />

              <a href="javascript:void(0)" data-video="Hilal.mp4" class="open-video overlay-box">
                <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
              </a>
              <video controls style="display: none;">
                <source src="{{ asset('videos/Hilal.mp4') }}" type="video/mp4">
              </video>
            </div>
          </details>
        </div>
      </div>
    </div>
    <div class="course-section">
      <div class="section-header" onclick="toggleSection(this)">
        <h2>الحلقات التالية</h2>
        <div class="arrow-icon">&#9650;</div>
      </div>
      <div class="section-content  ">



        <details class="tool-item">
          <summary>الأداة الثالثة – صناديق التوازن</summary>
          <p>لعبة الموازنة هي تحدٍّ دقيق يتطلب إدخال كرات صغيرة في ثقوب محددة داخل أكثر من عشرين صندوقًا صغيرًا. تعتمد اللعبة على تحريك الصناديق بمهارة لتحقيق التوازن المطلوب وتوجيه الكرات بدقة نحو أماكنها الصحيحة. مما يساعد على تطور مستوى التركيز، تعزيز الذكاء، وتحسين المهارات الحركية الدقيقة.</p>

          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>



        <details class="tool-item">
          <summary>الأداة الرابعة – ستيم</summary>
          <P>لعبة تتطلب الدقة و استعمال الأدوات و القطع المتاحة للبناء و التركيب، وتساعد في تنمية مهارات التفكير النقدي وحل المشكلات مما يعزز لديهم الإبداع والابتكار والاهتمام بمجالات العلوم والتكنولوجيا.</P>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1"
              style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                      width: 60px; height: 60px; background-image: url('images/lock.png');
                      background-size: cover; cursor: pointer; z-index: 2;">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة الخامسة – البطاقة البريدية</summary>
          <p>بطاقة بريدية تحتوي على رسومات لأشكال مختلفة مغطاة بطبقة قابلة للحك. عند حك هذه الطبقة، يكشف الطفل عن الشكل المخفي. تتطلب هذه العملية الدقة والصبر، وتشجع الطفل على عدم التسرع في الكشف عن الشكل، بل بالاستمتاع بعملية الاكتشاف خطوة بخطوة.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة السادسة – الصندوق الغامض</summary>
          <p>مجموعة من الصناديق الخشبية المغلقة، تختلف في الأحجام والأشكال. تحتوي كل منها على أجزاء سرية يمكن إزالتها, مما يعزز الانتباه و التركيز و مهارة حل المشكلات و حس الاكتشاف ضمن لعبة ممتعة.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة السابعة – قطع التركيب</summary>
          <p>مجموعة من القطع الصغيرة الملونة ذات الأشكال المختلفة، مصممة لتجميعها معًا لبناء أكثر من أربعة عشر شكلاً معقدًا تتطلب تركيزا كبير مع استخدام التفكير المنطقي و أيضا تنمية الصبر والمثابرة.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة الثامنة – جونغا</summary>
          <p>مجموعة من القطع الخشبية المستطيلة، يتم ترتيبها لتكوين برج عالٍ حيث يتم سحب قطعة واحدة من البرج ووضعها في الأعلى، مع الحرص على عدم إسقاط البرج و تتطلب هذه اللعبة تركيزًا عاليًا وانتباهًا للتفاصيل مع التخطيط وتحليل الموقف قبل اتخاذ القرار.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة التاسعة – التنغرام</summary>
          <p>مجموعة من سبع قطع هندسية مسطحة يمكن تجميعها لتكوين أشكال مختلفة لا متناهية، مثل الحيوانات، الأشخاص، الأشياء، أو الأشكال الهندسية و تعزز الإبداع والخيال و أيضا تنمية مهارات التمييز البصري, التفكير المنطقي و التركيز.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة العاشرة – المطابقة</summary>
          <p>مجموعة من الصور الكاملة المقسمة إلى قطع صغيرة بأحجام وأشكال وألوان مختلفة. يجب على الأطفال مطابقة القطع مع الأجزاء المناسبة من الصورة لإكمالها حيث تعزز التنسيق بين اليد و العين و أيضا التركيز و الانتباه, كما يتعلم الطفل كيفية التمييز بين الأشكال والأحجام والألوان المختلفة.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة الحادية عشرة – ألواح الأشكال المتداخلة</summary>
          <p>لوحة مقسمة إلى مربعات صغيرة، ومجموعة من الألواح الملونة بأشكال مختلفة. يجب وضع القطع الملونة في اللوحة بحيث تتناسب مع الفراغات وتكمل الشكل الكامل حيث تنمي مهارة التخطيط الاستراتيجي و التفكير التحليلي </p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة الثانية عشرة – أوراق الأوريغامي</summary>
          <p>أوراق ملونة مخصصة لفن الأوريغامي مع دليل يحتوي على صور توضح خطوات تشكيل الأشكال المختلفة حيث تساهم في تعزيز الإبداع والتفكير الابتكاري, الاعتماد على النفس و أيضا الانتباه و التركيز.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة الثالثة عشرة – لعبة الذاكرة</summary>
          <P> لوحة مربعة تحتوي على بطاقات تتضمن أشكالًا ورموزًا مختلفة. يجب على الطفل تذكر الأشكال المتطابقة قبل تغطية البطاقات، ومحاولة العثور على الأشكال المتطابقة على تقوية الذاكرة البصرية, التركيز و الانتباه, أيضا مهارة التفكير السريع و التمييز البصري.</P>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة الرابعة عشرة – كرة المتاهة الذكية</summary>
          <p>كرة شفافة تحتوي على متاهة ثلاثية الأبعاد داخلية، مع مسارات وأرقام. يجب على اللاعبين تحريك الكرة لتوجيهها صمن مسارات صغيرة عبر المتاهة، باتباع ترتيب الأرقام، مما يحتاج لتركيز عال و دقة في الحركة و التنسيق بين اليد و العين, كما تحتاج عدم التسرع و الهدوء للوصول للهدف</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة الخامسة عشرة – الصلصال الملون</summary>
          <p> مجموعة من الرسومات المتنوعة لأشكال غير ملونة، مطبوعة على ورق مقوى. تأتي مع مجموعة من الصلصال الملون بألوان مختلفة. يمكن للأطفال استخدام الصلصال لتلوين الرسومات، تمامًا كما يستخدمون الملونات</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة السادسة عشرة – لعبة الألغاز الدوارة والمنزلقة</summary>
          <p>مجموعة من الألغاز الأسطوانية الملونة، تتكون من حلقات دوارة ومنزلقة. يجب على اللاعبين تدوير الحلقات وتحريكها لترتيب الألوان بشكل صحيح، ومطابقة الأنماط الموجودة على الأسطوانة.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

        <details class="tool-item">
          <summary>الأداة السابعة عشرة – كرة الألوان المتطابقة</summary>
          <p>كرة مجوفة تحتوي على كرات صغيرة ملونة داخلها، تتوافق مع فتحات ملونة على السطح الخارجي للكرة. يجب على اللاعبين تحريك الكرات الصغيرة لتطابق ألوانها مع ألوان الفتحات الموجودة على السطح الخارجي للكرة.</p>
          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1">
            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>

      </div>
    </div>
  </aside>


</div>



<div id="popup" class="popup-overlay">
  <div class="popup-content">
    <span class="close" onclick="closeSubscriptionPopup()">×</span>
    <h3>اشترك الآن لمشاهدة هذا الفيديو</h3>
    <button onclick="subscribe()">اشترك الآن</button>
  </div>
</div>

<div id="shareModal" class="share-modal">
  <div class="share-modal-content">
    <button type="button" class="close-modal" id="closeModalBtn">&times;</button>
    <h3>شارك الدورة مع أصدقائك</h3>
    <div class="share-options">
      <a href="#" class="share-option" onclick="shareVia('facebook')">
        <i class="fab fa-facebook-f"></i>
        <span>Facebook</span>
      </a>
      <a href="#" class="share-option" onclick="shareVia('twitter')">
        <i class="fab fa-twitter"></i>
        <span>Twitter</span>
      </a>
      <a href="#" class="share-option" onclick="shareVia('whatsapp')">
        <i class="fab fa-whatsapp"></i>
        <span>WhatsApp</span>
      </a>
      <a href="#" class="share-option" onclick="shareVia('telegram')">
        <i class="fab fa-telegram-plane"></i>
        <span>Telegram</span>
      </a>
      <a href="#" class="share-option" onclick="shareVia('email')">
        <i class="fas fa-envelope"></i>
        <span>Email</span>
      </a>
    </div>
    <div class="copy-link">
      <input type="text" id="courseLink" value="https://neuralbox.ma/neuralbox" readonly>
      <button onclick="copyLink()">نسخ الرابط</button>
    </div>
  </div>
</div>
</div>
<div class="wave-container wave-bottom">
  <div class="wave wave-1"></div>
  <div class="wave wave-2"></div>
  <div class="wave wave-3"></div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.open-video').forEach(button => {
      button.addEventListener('click', function() {
        const container = this.closest('.video');
        container.querySelector('img').style.display = 'none';
        this.style.display = 'none';
        const video = container.querySelector('video');
        video.style.display = 'block';
        video.play();
      });
    });
  });

  function showPopup() {
    document.getElementById("popup").style.display = "flex";
  }

  function closeSubscriptionPopup() {
    document.getElementById("popup").style.display = "none";
  }

  function subscribe() {

    window.location.href = "/subscribe";
  }


  document.addEventListener('DOMContentLoaded', function() {
    const lockedVideos = document.querySelectorAll('.video-wrapper video');
    lockedVideos.forEach(video => {
      video.controls = false;
      video.addEventListener('play', function(e) {
        e.preventDefault();
        e.target.pause();
        showPopup();
      });
    });

    const overlays = document.querySelectorAll('.lock-overlay');
    overlays.forEach(overlay => {
      overlay.addEventListener('click', function() {
        showPopup();
      });
    });
  });
  document.addEventListener("DOMContentLoaded", function() {
    const previewImage = document.getElementById("preview-image");
    const videoPlayer = document.getElementById("video-player");
    const playButton = document.querySelector(".open-video");

    playButton.addEventListener("click", function() {
      previewImage.style.display = "none"; // cacher l'image
      playButton.style.display = "none"; // cacher le bouton
      videoPlayer.style.display = "block"; // afficher la vidéo
      videoPlayer.play(); // lancer la lecture
    });
  });

  function toggleSection(element) {
    const content = element.nextElementSibling;
    const arrow = element.querySelector('.arrow-icon');

    // Toggle class open
    content.classList.toggle('open');

    // Toggle arrow
    if (content.classList.contains('open')) {
      arrow.innerHTML = '&#9650;'; // 🔽 لتحت = مفتوح
    } else {
      arrow.innerHTML = '&#9660;'; // 🔼 لفوق = مسدود
    }
  }

  // Au chargement, s'assurer que tout est fermé
  document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.section-content');
    const headers = document.querySelectorAll('.section-header');
    const arrows = document.querySelectorAll('.arrow-icon');

    sections.forEach(section => {
      section.classList.remove('open');
    });

    headers.forEach(header => {
      header.classList.remove('active');
    });

    arrows.forEach(arrow => {
      arrow.innerHTML = '&#9660;'; // Flèche vers le bas
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    // Récupérer les éléments
    const modal = document.getElementById('shareModal');
    const closeBtn = document.getElementById('closeModalBtn');

    // Ajouter l'événement de clic au bouton de fermeture
    if (closeBtn) {
      closeBtn.addEventListener('click', function() {
        closePopup();
      });
    }

    // Ajouter l'événement pour fermer la modal en cliquant en dehors
    window.addEventListener('click', function(event) {
      if (event.target === modal) {
        closePopup();
      }
    });
  });

  function shareCourse(event) {
    event.preventDefault();
    const modal = document.getElementById('shareModal');
    if (modal) {
      modal.style.display = 'block';
      const modalContent = modal.querySelector('.share-modal-content');
      if (modalContent) {
        modalContent.classList.remove('fade-out');
      }
    }
  }

  function closePopup() {
    const modal = document.getElementById('shareModal');
    if (modal) {
      const modalContent = modal.querySelector('.share-modal-content');
      if (modalContent) {
        modalContent.classList.add('fade-out');

        setTimeout(function() {
          modal.style.display = 'none';
          modalContent.classList.remove('fade-out');
        }, 300);
      } else {
        modal.style.display = 'none';
      }
    }
  }

  function shareVia(platform) {
    const courseTitle = "محتوى نيورال بوكس";
    const courseUrl = "https://neuralbox.ma/neuralbox";
    const courseDescription = "دورة تعليمية مقدمة من الأستاذ عبدالصمد أشتاشن";

    let shareUrl;

    switch (platform) {
      case 'facebook':
        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(courseUrl)}`;
        break;
      case 'twitter':
        shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(courseUrl)}&text=${encodeURIComponent(courseTitle)}`;
        break;
      case 'whatsapp':
        shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(courseTitle + ' ' + courseUrl)}`;
        break;
      case 'telegram':
        shareUrl = `https://t.me/share/url?url=${encodeURIComponent(courseUrl)}&text=${encodeURIComponent(courseTitle)}`;
        break;
      case 'email':
        shareUrl = `mailto:?subject=${encodeURIComponent(courseTitle)}&body=${encodeURIComponent(courseDescription + '\n\n' + courseUrl)}`;
        break;
    }

    if (shareUrl) {
      window.open(shareUrl, '_blank');
    }
  }

  function copyLink() {
    const linkInput = document.getElementById('courseLink');
    if (linkInput) {
      linkInput.select();
      document.execCommand('copy');

      const copyButton = document.querySelector('.copy-link button');
      if (copyButton) {
        const originalText = copyButton.textContent;
        copyButton.textContent = 'تم النسخ!';

        setTimeout(function() {
          copyButton.textContent = originalText;
        }, 2000);
      }
    }
  }
</script>

@endsection
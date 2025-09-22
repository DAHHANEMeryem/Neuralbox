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
</div>-->
<div class="banner-wrapper">
  <div class="banner-container">
    <div class="course-content-section1">
      <h1 class="course-title">محتوى نيورال بوكس</h1>

      <p class="instructor">
        من تقديم
        <span>
          <a href="https://www.instagram.com/mr.abdessamad.officiel/" target="_blank">
            الأستاذ عبدالصمد أشتاشن
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

          <a href="javascript:void(0)" data-video="peda.mp4" class="open-video overlay-box">
            <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
          </a>
          <video controls style="display: none;">
            <source src="{{ asset('videos/peda.mp4') }}" type="video/mp4">
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
      <h1>محتوى الدورة</h1>
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
            <summary>الفرق بين الانتباه والتركيز</summary>
            <p>
              شرح مبسط للفرق بين المفهومين، وكيفية تنمية كل منهما لدى طفلك.
            </p>
            <div class="video" style="position: relative;">
              <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" />
              <a href="javascript:void(0)" data-video="pedavd1.mp4" class="open-video overlay-box">
                <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
              </a>
              <video controls style="display: none;">
                <source src="{{ asset('videos/pedavd1.mp4') }}" type="video/mp4">
              </video>
            </div>
          </details>
        </div>

        <div class="lesson-item">
          <!-- <div class="lesson-free">درس مجاني</div> -->
          <details class="tool-item">
            <summary>أنواع التركيز و الانتباه</summary>
            <p>كل نوع من الإنتباه و التركيز يعكس طريقة تعامل العقل مع المهام والمحفزات المحيطة...</p>
            <div class="video" style="position: relative;">
              <img src="images/MrAbdessamad_video_covers-05.jpg" alt="Aperçu vidéo" class="preview-image" />
              <a href="javascript:void(0)" data-video="pedavd2.mp4" class="open-video overlay-box">
                <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
              </a>
              <video controls style="display: none;">
                <source src="{{ asset('videos/pedavd2.mp4') }}" type="video/mp4">
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
          <summary>اضطراب فرط الحركة و تشتت الانتباه</summary>
          <p>اكتشفوا المكونات الثلاث الأساسية التي تميز هذا الإضطراب، وكيف تؤثر كل واحدة منها على السلوك والتعلم.</p>

          <div class="video" id="video-container" style="position: relative;">
            <img src="images/MrAbdessamad_video_covers-04.jpg" alt="Aperçu vidéo" id="preview-image" style="width: 100%; display: block;" />

            <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box">

            </a>
            <video id="video-player" controls style="width: 100%; display: none;">
              <source src="mikado.mp4" type="video/mp4">
            </video>
          </div>
        </details>


        <details class="tool-item">
          <summary> التمييز بين اضطراب فرط الحركة وتشتت الانتباه ومشكل فرط الحركة و تشتت الانتباه</summary>
          <P>ليس كل طفل كثير الحركة يعاني من اضطراب! هذا الفيديو يوضح الفروق الدقيقة لمساعدة الأهل على الفهم واتخاذ القرار الصحيح</P>
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
          <summary>تقدير الذات </summary>
          <p>مهارة تساعد الطفل على تقبّل نفسه، وبناء صورة إيجابية عنها، والشعور بالحب والثقة.</p>
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
          <summary> كلمات يجب أن يسمعها طفلك </summary>
          <p>عبارات يومية تعزز الثقة بالنفس، الشعور بالأمان، وتغذي الذكاء العاطفي.</p>
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
          <summary> الذكاء العاطفي </summary>
          <p>القدرة على فهم المشاعر والتحكم فيها والتفاعل بإيجابية مع الآخرين و مع مشاعره.</p>
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
          <summary>قيم النجاح الستة </summary>
          <p> مبادئ أساسية تساعد الطفل على بناء شخصية قوية وتحقيق أهدافه بثبات.</p>
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
          <summary>منارة الحياة </summary>
          <p>رؤية واضحة توجه الطفل في اتخاذ قراراته وتمنحه هدفًا يعيش من أجله.</p>
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
          <summary> القاعدة الثلاثية</summary>
          <p>تقنية تعتمد على ثلاث مراحل لترسيخ المعلومات في الذاكرة بشكل فعال.</p>
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
          <summary> الركائز السبع للتعلم </summary>
          <p>نموذج يربط بين سبعة عناصر تساعد في تحسين بيئة التعلم.</p>
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
          <summary> الخريطة الذهنية </summary>
          <p>أداة بصرية تنظم الأفكار وتساعد على الفهم والمراجعة.</p>
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
          <summary> الماندالا </summary>
          <P> تمارين تلوين دائرية تساعد على التركيز والاسترخاء.</P>
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
          <summary> منحنى الإنتاجية </summary>
          <p>أداة لفهم أفضل أوقات تركيز الطفل خلال اليوم.</p>
          <div class="video-wrapper">
            <div class="video" id="video-container" style="position: relative;">
              <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" style="cursor: pointer; width: 100%;" onclick="showPopup()" />
              <div class="lock-icon" onclick="showPopup()"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                      width: 50px; height: 50px;
                      background-image: url('images/lock.png'); background-size: cover;
                      cursor: pointer; z-index: 2;">
              </div>
            </div>
          </div>
        </details>

        <details class="tool-item">
          <summary>الساعة البيولوجية </summary>
          <p> تساعد في تنظيم وقت النوم والتعلم حسب نشاط الجسم الطبيعة.</p>
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
          <summary> تخطيط الأسابيع الثلاث </summary>
          <p>تقنية لتنظيم التعلم والمراجعة على مدى ثلاث أسابيع.</p>
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
          <summary> الطريقة الصحيحة للتعلم </summary>
          <p>خطوات لفهم الدرس، تلخيصه، تدريبه ثم اجتيازه بنجاح.</p>
          <div class="video-wrapper">
            <div class="video" id="video-container" style="position: relative;">
              <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" style="cursor: pointer; width: 100%;" onclick="showPopup()" />
              <div class="lock-icon" onclick="showPopup()"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                      width: 50px; height: 50px;
                      background-image: url('images/lock.png'); background-size: cover;
                      cursor: pointer; z-index: 2;">
              </div>
            </div>
          </div>
        </details>
        <details class="tool-item">
          <summary> تقنية 20-50 سؤالاً </summary>
          <p>تحفز الطفل على طرح أسئلة لفهم أعمق للمحتوى.</p>
          <div class="video-wrapper">
            <div class="video" id="video-container" style="position: relative;">
              <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" style="cursor: pointer; width: 100%;" onclick="showPopup()" />
              <div class="lock-icon" onclick="showPopup()"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                      width: 50px; height: 50px;
                      background-image: url('images/lock.png'); background-size: cover;
                      cursor: pointer; z-index: 2;">
              </div>
            </div>
          </div>
        </details>
        <details class="tool-item">
          <summary>الرابط الذهني </summary>
          <p>استخدام الحواس والمسرح والرسم لترسيخ المعلومة.</p>
          <div class="video-wrapper">
            <div class="video" id="video-container" style="position: relative;">
              <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" style="cursor: pointer; width: 100%;" onclick="showPopup()" />
              <div class="lock-icon" onclick="showPopup()"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                      width: 50px; height: 50px;
                      background-image: url('images/lock.png'); background-size: cover;
                      cursor: pointer; z-index: 2;">
              </div>
            </div>
          </div>
        </details>
        <details class="tool-item">
          <summary>VAKنمط </summary>
          <p>يوضح أساليب التعلم الثلاثة: البصري، السمعي، الحسي الحركي.</p>
          <div class="video-wrapper">
            <div class="video" id="video-container" style="position: relative;">
              <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" style="cursor: pointer; width: 100%;" onclick="showPopup()" />
              <div class="lock-icon" onclick="showPopup()"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                      width: 50px; height: 50px;
                      background-image: url('images/lock.png'); background-size: cover;
                      cursor: pointer; z-index: 2;">
              </div>
            </div>
          </div>
        </details>
        <details class="tool-item">
          <summary>التعلم النشيط </summary>
          <p>يجعل الطفل فاعلاً في التعلم من خلال الممارسة والمشاركة.</p>
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
          <summary> جدول القائد </summary>
          <p>وسيلة لتحفيز الطفل عبر تتبع الإنجازات وتعزيز الثقة بالنفس.</p>
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
      <input type="text" id="courseLink" value="https://neuralbox.ma/peda" readonly>
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
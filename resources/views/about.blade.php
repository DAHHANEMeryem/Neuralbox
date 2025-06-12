@extends('layouts.app')

@section('title', 'نورال بوكس | من نحن')

@section('content')
<link rel="stylesheet" href="{{ asset('css/About.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo&family=Changa&family=Lalezar&family=Reem+Kufi&family=Noto+Naskh+Arabic&family=Scheherazade+New&family=El+Messiri&family=Markazi+Text&family=Harmattan&display=swap" rel="stylesheet">
<section class="hero">
    <div class="hero-inner">
      
  
      <div class="hero-content">
        <h1 class="hero-title">من نحن؟</h1>
        <p class="hero-description">
          في معهد العلوم العصبية والمواكبة، نؤمن بأن التحوّل الحقيقي يبدأ من الداخل، ولهذا نكرّس جهودنا لتحرير الإمكانات الكامنة لدى الأفراد والأسر والمجتمعات، عبر مزيج فريد من الكوتشينغ، التكوين، وعلم النفس الديناميكي.
          
          بفضل خبرة تمتد لأكثر من 12 سنة من العمل الميداني والمعرفي، نرافق الأطفال، الآباء، والمدارس، في مسارات تطوير شاملة تدمج بين النجاح الدراسي، التوازن النفسي، واكتساب المهارات الحياتية.
          
          ومن خلال منصة نيورال بوكس، نضع هذه التجربة بين يدي الأسر والأطر التربوية في قالب رقمي حديث، يجمع بين الأدوات العلاجية، المحتوى البيداغوجي، التكوين التربوي، والتوجيه الشخصي، لمواكبة كل من يسعى إلى بناء مستقبل تعليمي ونفسي متكامل.
        </p>
      </div>
      <div class="video-container">
        <div class="video">
          <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" />
          <a href="javascript:void(0)" data-video="main.mp4" class="open-video overlay-box"></a>
          <video id="video-player" controls>
            <source src="تعريف الانتباه والتركيز.mp4" type="video/mp4" />
          </video>
        </div>
      </div>
    </div>
  
    <svg class="hero-wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" preserveAspectRatio="none">
      <path fill="#fff" d="M0,0 C280,60 720,0 1440,60 L1440,60 L0,60 Z"></path>
    </svg>
  </section>
  
  
   
    <section class="mission-section">
        <div class="cccontainer">
        <!-- <div class="lg:max-w-2xl max-w-5xl "> -->
            <h2 class="section-title">قيمنا:</h2>
            <p class="ccontainer">تشكل قيمنا الأساس الذي نبني عليه جميع قراراتنا وخدماتنا، وهي تعكس التزامنا العميق تجاه عملائنا وشركائنا:</p>
            <div class="mission-container">
                <div class="mission-card">
                    <h3 class="mission-title">الأخلاقيات:</h3>
                    <p class="mission-text">
                    نلتزم التزاماً كاملاً بأخلاقيات المهنة وقواعد السلوك المهني؛ نولي أهمية قصوى للسر المهني واحترام ميثاق الأخلاقيات؛ فهما من الركائز الأساسية التي تحكم جميع تعاملاتنا.
                    </p>
                </div>
                
                <div class="mission-card">
                    <h3 class="mission-title">الالتزام:</h3>
                    <p class="mission-text">
                    نحرص على بذل كل الجهود اللازمة لتحقيق الأهداف المتفق عليها مع عملائنا؛ لا يقتصر التزامنا على تقديم الخدمات فحسب؛ بل نعتبر أنفسنا شركاء حقيقيين في نجاح عملائنا واستدامة تطورهم.
                    </p>
                </div>
                
                <div class="mission-card">
                    <h3 class="mission-title">الإبداع والابتكار:</h3>
                    <p class="mission-text">
                    نؤمن بأن الإبداع والابتكار هما مفتاح النجاح والتفوق؛ في معهد العلوم العصبية والمواكبة، نوفر بيئة محفزة على التفكير الخلاق؛ وتقديم حلول جديدة تواكب التحديات المتغيرة؛ وتضمن استمرارية التميز.
                    </p>
                </div>
                <div class="mission-card">
                    <h3 class="mission-title">الموثوقية:</h3>
                    <p class="mission-text">
                    نضع الموثوقية في صميم تعاملاتنا؛ مدعومة باحترافية عالية وخبرة متقدمة؛ نحرص دائماً على تقديم خدمات دقيقة ونتائج تتجاوز توقعات عملائنا؛ مما يعزز ثقتهم بنا كشريك يعتمد عليه.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Section des Services -->
    <section id="services" class="services-section">
        <div class="cccontainer">
            <h2 class="services-title"> مجالات تخصص معهد العلوم العصبية و المواكبة:</h2>
            <p class="services-subtitle">نقدم مجموعة متنوعة من الخدمات المصممة خصيصًا لدعم أطفالكم ومساعدتهم على التغلب على التحديات</p>
            
            <div class="services-grid">
                <div class="mission-card">
                        <h3 class="service-title1"> الكوتشينغ والمواكبة النفسية:</h3>
                        <p class="service-description">نوفر برامج علاج نفسي ومواكبة  فردية وجماعية، تساعد الأطفال والبالغين على تخطي الصعوبات، اكتشاف الذات، وتحقيق نمو متوازن على المستويين الشخصي, الدراسي والمهني.</p>
                </div>
                
                <div class="mission-card">    
                        <h3 class="service-title11">تكوينات معتمدة:</h3>
                        <p class="service-description">نقدم دورات تدريبية تُنمّي المهارات، تقوي القدرات القيادية، وتُحدث تغييرًا ملموسًا في السلوك والممارسات التربوية والنفسية، موجهة لكل من أولياء الأمور، المربين، والمدرسين و المهنيين.</p>    
                </div>
                
                <div class="mission-card">
                    
                    
                        <h3 class="service-title1">بناء وتطوير الفرقTeam Building:</h3>
                        <p class="service-description">نعمل مع المؤسسات والشركات على تحسين التعاون والتواصل، وتعزيز الأداء الجماعي، من أجل بيئة عمل متناغمة وفعالة.</p>
                
                </div>
                
                <div class="mission-card">
                        <h3 class="service-title1">التوجيه الدراسي والعلاج التربوي:</h3>
                        <p class="service-description">عبر منصة نيورال بوكس، نمنح الأسر صندوق أدوات معرفية وتربوية، مرفقًا بدليل بيداغوجي، أدوات تعليمية، محتوى توعوي بالفيديو، وخدمة تقييم وتوجيه مستمر، مع مجتمع داعم على الواتساب وتخفيضات على الاستشارات والدورات.</p>       
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- Section de l'équipe avec images -->
    <section class="team-section">
    <div class="ccontainer">
        <h2 class="team-title">فريقنا المتخصص:</h2>
        <p class="about-description">
            سواء كنت تبحث عن استشارة لتحسين الأداء الدراسي، أو معالجة مشاكل التركيز والانتباه، الإدمان على الشاشات، أو التوجيه النفسي، فريقنا مستعد لتقديم حلول عملية ومخصصة تناسب احتياجات طفلك. اختر بين جلسات عن بُعد أو حضورياً، وكن على ثقة بأنك ستحصل على الدعم اللازم لإحداث تغيير حقيقي وإيجابي في حياة طفلك.
        </p>
        <div class="team-members-wrapper">
            <div class="team-members" id="teamSlider">
                <div class="team-member" onclick="window.location.href='/policy#coach-abdelhadi';" style="cursor: pointer;">
                    <div class="member-image">
                        <img src="images/resource/DSC00476.png" alt="صورة المختص">
                    </div>
                    <h3 class="member-name">Coach Abdelhadi</h3>
                    <p class="member-role">خبير التنويم المغناطيسي</p>
                </div>
                <div class="team-member" onclick="window.location.href='/policy#Coach-Abderrahim';" style="cursor: pointer;">
                    <div class="member-image">
                        <img src="{{ asset('images/resource/abderahim.png-removebg-preview.png') }}" alt="صورة المختص">
                    </div>
                    <h3 class="member-name">Coach Abderrahim</h3>
                    <p class="member-role">مدرب الحياة</p>
                </div>
                <div class="team-member" onclick="window.location.href='/policy#Mr-Abdessamad';" style="cursor: pointer;">
                    <div class="member-image">
                        <img src="{{ asset('images/resource/abdessmed1.png') }}" alt="صورة المختص">
                    </div>
                    <h3 class="member-name">Mr Abdessamad</h3>
                    <p class="member-role">خبير التوجيه المدرسي</p>
                </div>
               
                <div class="team-member" onclick="window.location.href='/policy#Coach-Khaoula';" style="cursor: pointer;">
                    <div class="member-image">
                        <img src="{{ asset('images/resource/khaoula1.png') }}" alt="صورة المختص">
                    </div>
                    <h3 class="member-name">Coach Khaoula</h3>
                    <p class="member-role">مدربة الحياة للفتيات</p>
                </div>
                <div class="team-member" onclick="window.location.href='/policy#Coach-Nisrine';" style="cursor: pointer;">
                    <div class="member-image">
                        <img src="{{ asset('images/resource/nisrin1.png') }}" alt="صورة المختص">
                    </div>
                    <h3 class="member-name">Coach Nisrine</h3>
                    <p class="member-role">مدربة التدريب الاجتماعي</p>
                </div>
                <div class="team-member" onclick="window.location.href='/policy#Coach-Malika';" style="cursor: pointer;">
                    <div class="member-image">
                        <img src="{{ asset('images/resource/malika1.png') }}" alt="صورة المختص">
                    </div>
                    <h3 class="member-name">Coach Malika</h3>
                    <p class="member-role">مدربة التدريب الاجتماعي</p>
                </div>
            </div>
        </div>
       
    </div>
</section>
    <svg class="wave-divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none">
        <path fill="#1a56db" d="M0,0 C320,100 420,0 740,50 C870,70 1360,100 1440,0 L1440,100 L0,100 Z"></path>
    </svg>
    
    <section class="hero2">
        <div class="ccontainer">
            <h2 class="cta-title">هل تريد مساعدة طفلك على تحقيق إمكاناته الكاملة؟</h2>
            <a href="#contact" class="cta-button">تواصل معنا اليوم</a>
        </div>
    </section>
    <script>
 document.addEventListener('DOMContentLoaded', function() {
  const previewImage = document.getElementById('preview-image');
  const videoPlayer = document.getElementById('video-player');
  const openVideoBtn = document.querySelector('.open-video');
  const videoContainer = document.getElementById('video-container');

  // Cacher la vidéo au départ
  videoPlayer.style.display = 'none';

  // Au clic sur l'image ou le bouton "play"
  if(previewImage) {
    previewImage.addEventListener('click', playVideo);
  }
  
  if(openVideoBtn) {
    openVideoBtn.addEventListener('click', playVideo);
  }

  function playVideo(e) {
    e.preventDefault();
    
    // Masquer l'image et le bouton
    previewImage.style.display = 'none';
    openVideoBtn.style.display = 'none';
    
    // Afficher et lancer la vidéo
    videoPlayer.style.display = 'block';
    videoPlayer.play();
    
    // Ajuster la taille du conteneur vidéo si nécessaire
    videoContainer.style.height = videoPlayer.offsetHeight + 'px';
  }

  // Quand la vidéo se termine, réafficher l'image
  videoPlayer.addEventListener('ended', function() {
    videoPlayer.style.display = 'none';
    previewImage.style.display = 'block';
    openVideoBtn.style.display = 'block';
  });
  
  // Ajout de l'effet d'animation pour les cards
  const missionCards = document.querySelectorAll('.mission-card');
  
  if(missionCards.length > 0) {
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries, observer) {
      entries.forEach(entry => {
        if(entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);
    
    missionCards.forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(20px)';
      card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      observer.observe(card);
    });
  }
});

</script>
   
@endsection

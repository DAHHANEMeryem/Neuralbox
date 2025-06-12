@extends('layouts.app')
 
@section('title', 'نورال بوكس | دليل نورال بوكس')
 
@section('content')
<link rel="stylesheet" href="{{ asset('css/pedagogie.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo&family=Changa&family=Lalezar&family=Reem+Kufi&family=Noto+Naskh+Arabic&family=Scheherazade+New&family=El+Messiri&family=Markazi+Text&family=Harmattan&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="banner-wrapper">
  <div class="banner-container">
    <div class="course-content-section1">
      <h1 class="course-title">محتوى نيورال بوكس</h1>

      <p class="instructor">
        من تقديم
        <span>
          <a href="https://www.instagram.com/mr.abdessamad.officiel/" target="_blank">
            الأستاذ عبدالصمد أشيتاشن
          </a>
        </span>
      </p>

      <p class="course-detail">مدة الدورة: ساعتان و نصف / 30 فيديو</p>
      <p class="course-detail">اللغة: العربية</p>
      <p class="course-detail">فيديوهات مرفقة بمراجع وخطط اشتغال</p>

      <div class="course-buttons">
           @if(!$estAbonne)
        <a href="{{ route('subscribe') }}" class="custom-btn">اشترك الآن</a>
        @else
        <a href="#" class="custom-btn" onclick="shareCourse(event)">
          <span>شارك الدورة</span>
          <i class="fas fa-share-alt"></i>
        </a>
      </div>
      @endif
    </div>

    <div class="image-section">
      <div class="image5">
        <div class="video" style="position: relative;">
          <img src="images/peda/1.png" alt="Aperçu vidéo" id="preview-image" />

          <a href="javascript:void(0)" data-video="storage/app/public/videos/علاشنيورالبوكس.mov" class="open-video overlay-box">
            <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
          </a>
          <video controls style="display: none;">
            <source src="{{ asset('storage/app/public/videos/علاشنيورالبوكس.mov') }}" type="video/mp4">
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
    سيقدم لك دليل نيورال بوكس جميع الأدوات العلمية و الألعاب التربوية التي تحتاجها و التي سترافقك طوال رحلتك مع الصندوق, أدوات تجمع بين المتعة و التعلم تم اختيارها على أسس علمية و بناءا على تجربة أخصائي معهد العلوم العصبية و المواكبة في مجال الكوتشينغ, المرافقة النفسية و العلوم العصبية مع شرح تفصيلي لكل أداة.  </p>
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
        @foreach($ressourcesGratuites as $ressource)
        <div class="lesson-item">
          <details class="tool-item">
            <summary>{{ $ressource->titre }}</summary>
            <p>{{ $ressource->description }}</p>
            <div class="video" style="position: relative;">
              <img src="{{ asset('/images/resource/' . $ressource->preview_image) }}" alt="Aperçu vidéo" class="preview-image" />
              <a href="javascript:void(0)" data-video="{{ $ressource->video_url }}" class="open-video overlay-box">
                <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
              </a>
              <video controls style="display: none;">
                <source src="{{ url('/video-url/'. $ressource->video_url) }}" type="video/mp4">
              </video>
            </div>
          </details>
        </div>
        @endforeach
      </div>
    </div>
    
    <div class="course-section">
      <div class="section-header" onclick="toggleSection(this)">
        <h2>الحلقات التالية</h2>
        <div class="arrow-icon">&#9650;</div>
      </div>
      <div class="section-content">
        @foreach($ressourcesPremium as $ressource)
        <details class="tool-item">
          <summary>{{ $ressource->titre }}</summary>
          <p>{{ $ressource->description }}</p>
          <div class="video-wrapper">
            <div class="video" id="video-container" style="position: relative;">
              <img src="{{ asset('/images/resource' . $ressource->preview_image) }}" alt="Aperçu vidéo" class="preview-image" style="cursor: pointer; width: 100%;" onclick="{{ $estAbonne ? '' : 'showPopup()' }}" />
              
              @if($estAbonne)
              <a href="javascript:void(0)" data-video="{{ $ressource->video_url }}" class="open-video overlay-box">
                <span class="icon flaticon-play-arrow"><i class="ripple"></i></span>
              </a>
              <video controls style="display: none;">
                <source src="{{ url('/video-url/'. $ressource->video_url) }}" type="video/mp4">
              </video>
              @else
              <div> <a href="javascript:void(0)" onclick="showPopup()" class="overlay-box-1"></a>
              </div>
              @endif
            </div>
          </div>
        </details>
        @endforeach
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
      <input type="text" id="courseLink" value="{{ url('/neuralbox') }}" readonly>
      <button onclick="copyLink()">نسخ الرابط</button>
    </div>
  </div>
</div>

<div class="wave-container wave-bottom">
  <div class="wave wave-1"></div>
  <div class="wave wave-2"></div>
  <div class="wave wave-3"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.open-video');

  buttons.forEach(button => {
    button.addEventListener('click', function () {
      const container = this.closest('.video');
      if (!container) return;

      const previewImage = container.querySelector('img');
      const video = container.querySelector('video');

      // Masquer l'image de prévisualisation
      if (previewImage) {
        previewImage.style.display = 'none';
      }

      // Masquer le bouton
      this.style.display = 'none';

      // Afficher la vidéo et la lancer
      if (video) {
        video.style.display = 'block';
        video.play().catch(error => {
          console.error("Erreur lors de la lecture de la vidéo :", error);
        });
      }
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
  window.location.href = "{{ route('subscribe') }}"; 
}

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
  const courseUrl = "{{ url('/peda') }}";
  const courseDescription = "دورة تعليمية مقدمة من الأستاذ عبدالصمد أشيتاشن";
  
  let shareUrl;
  
  switch(platform) {
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
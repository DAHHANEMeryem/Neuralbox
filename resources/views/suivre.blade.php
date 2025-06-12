@extends('layouts.app')
 
@section('title', 'نورال بوكس | دلبل نورال بوكس')
 
@section('content')
<link rel="stylesheet" href="{{ asset('css/suiv.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo&family=Changa&family=Lalezar&family=Reem+Kufi&family=Noto+Naskh+Arabic&family=Scheherazade+New&family=El+Messiri&family=Markazi+Text&family=Harmattan&display=swap" rel="stylesheet">


    <header>
        <div class="container11">
        <h1>فريق متكامل لدعم طفلك واكتشاف إمكانياته الحقيقية</h1>
        </div>

        <div class="container">
            <img src="images/coachs.jpg" alt="Neural Box Logo" class="logo">
        </div>
    </header>
    
    <section class="intro">
        <div class="container2">
            <p>في نيورال بوكس، ندرك أن لكل طفل احتياجات خاصة، وتحديات تمنعه من تحقيق التغيير المنشود، ومساعدته على اكتشاف قدراته الكاملة. توفر المنصة إمكانية التواصل المباشر مع فريق الخبراء والمتخصصين في مجالات متعددة؛ تشمل التوجيه الدراسي، التنويم المغناطيسي، المواكبة النفسية، والعلوم العصبية. سواء كنت تبحث عن استشارة لتحسين الأداء الدراسي، أو معالجة مشاكل التركيز والانتباه، الإدمان على الشاشات، أو التوجيه النفسي؛ فريقنا مستعد لتقديم حلول عملية ومخصصة تناسب احتياجات طفلك. اختر بين جلسات عن بُعد أو حضورياً، وكن على ثقة بأنك ستحصل على الدعم اللازم لإحداث تغيير حقيقي وإيجابي في حياة طفلك.</p>
        </div>
        <div class="container3">
           <img src="images/imag11.jpg" alt="la mere et la fille">
        </div>
    </section>
    
    <section class="team-container">
        <div class="container">
           <div class="team-categories">
                <button class="category-btn active" data-category="all">جميع التخصصات</button>
                <button class="category-btn" data-category="hypno">التنويم المغناطيسي</button>
                <button class="category-btn" data-category="life">الحياة التدريبية</button>
                <button class="category-btn" data-category="school">التوجيه المدرسي</button>
                <button class="category-btn" data-category="social">التدريب الاجتماعي</button>
            </div>

            
            <div class="team-grid">
                <!-- Coach 1 -->
                <div class="team-member"data-category="hypno">
                    <div class="member-header">
                        <div class="member-color coaching-color">
                            <img src="{{ asset('images/resource/DSC00476.png') }}" alt="Coach abdelhadi" class="member-img">
                        </div>
                    </div>
                    <div class="member-info">
                        <h3 class="member-name"  id="coach-abdelhadi">المدرب عبد الهادي</h3>
                        <p class="member-title">خبير التنويم المغناطيسي</p>
                        <p class="member-description">متخصص في تقنيات التنويم المغناطيسي التي تساعد الأطفال على تجاوز العوائق النفسية وتحسين التركيز.</p>
                
                    </div>
                </div>
                
                <!-- Coach 2 -->
                <div class="team-member"  data-category="life">
                    <div class="member-header">
                        <div class="member-color coaching-color">
                            <img src="{{ asset('images/resource/abderahim.png-removebg-preview.png') }}" alt="Coach Khaoula" class="member-img">
                        </div>
                    </div>
                    <div class="member-info">
                        <h3 class="member-name" id="Coach-Abderrahim">المدرب عبدالرحيم</h3>
                        <p class="member-title">مدرب الحياة</p>
                        <p class="member-description">يساعد الأطفال على تطوير مهارات الحياة الأساسية وتعزيز الثقة بالنفس لتحقيق أهدافهم.</p>
                       
                    </div>
                </div>
                
                <!-- Coach 3 -->
                <div class="team-member"  data-category="school">
                    <div class="member-header">
                        <div class="member-color coaching-color">
                            <img src="{{ asset('images/resource/abdessmed1.png') }}" alt="Coach Khaoula" class="member-img">
                        </div>
                    </div>
                    <div class="member-info">
                        <h3 class="member-name"id="Mr-Abdessamad">السيد عبدالصمد</h3>
                        <p class="member-title">خبير التوجيه المدرسي</p>
                        <p class="member-description">متخصص في مساعدة الطلاب على تحسين أدائهم الأكاديمي واختيار المسار الدراسي المناسب.</p>
                        
                    </div>
                </div>
                
                <!-- Coach 4 -->
                <div class="team-member" data-category="life">
                    <div class="member-header">
                        <div class="member-color coaching-color">
                            <img src="{{ asset('images/resource/khaoula.png') }}" alt="Coach Khaoula" class="member-img">
                        </div>
                    </div>
                    <div class="member-info">
                        <h3 class="member-name" id="Coach-Khaoula1">المدربة خولة</h3>
                        <p class="member-title">مدربة الحياة للفتيات</p>
                        <p class="member-description">متخصصة في تمكين الفتيات وتعزيز قدراتهن على التعبير والمشاركة الاجتماعية.</p>
                    </div>
                </div>
                
                
                <!-- Coach 5 -->
                <div class="team-member" data-category="social">
                    <div class="member-header">
                        <div class="member-color coaching-color">
                            <img src="{{ asset('images/resource/nisrin1.png') }}" alt="Coach Khaoula" class="member-img">
                        </div>
                    </div>
                    <div class="member-info">
                        <h3 class="member-name" id="Coach-Nisrine">المدربة نسرين</h3>
                        <p class="member-title">مدربة التدريب الاجتماعي</p>
                        <p class="member-description">تساعد الأطفال على تطوير مهارات التواصل والتفاعل الاجتماعي في بيئة آمنة وداعمة.</p>
                       
                    </div>
                </div>
                
                <!-- Coach 6 -->
                <div class="team-member" data-category="social">
                    <div class="member-header">
                        <div class="member-color coaching-color">
                            <img src="{{ asset('images/resource/malika1.png') }}" alt="Coach Khaoula" class="member-img">
                        </div>
                    </div>
                    <div class="member-info">
                        <h3 class="member-name" id="Coach-Malika">المدربة مليكة</h3>
                        <p class="member-title">مدربة التدريب الاجتماعي</p>
                        <p class="member-description">خبيرة في تنمية المهارات الاجتماعية للأطفال وتعزيز قدرتهم على بناء علاقات صحية.</p>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">ابدأ رحلة التغيير لطفلك اليوم!</h2>
                <p class="cta-description">انضم إلى العديد من العائلات التي وثقت بنا لمساعدة أطفالهم على تحقيق إمكاناتهم الكاملة.</p>
                <a href="/prendre-rendez-vous" class="cta-btn">احجز جلستك الأولى</a>

            </div>
        </div>
    </section>
    
    
    
    <script>
        // Simple filter functionality
        const categoryButtons = document.querySelectorAll('.category-btn');
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Here you would add filtering logic based on category
                // For now, this is just UI feedback
            });
        });
     
    const buttons = document.querySelectorAll('.category-btn');
    const members = document.querySelectorAll('.team-member');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Enlève la classe "active" des autres boutons
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const category = btn.getAttribute('data-category');

            members.forEach(member => {
                const memberCategory = member.getAttribute('data-category');

                if (category === 'all' || memberCategory === category) {
                    member.style.display = 'block';
                } else {
                    member.style.display = 'none';
                }
            });
        });
    });


    </script>
@endsection
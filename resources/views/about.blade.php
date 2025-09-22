@extends('layouts.app')

@section('title', 'نيورال بوكس | من نحن')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<section class="about-hero bg-white w-100 position-relative  p-5">
    <div class=" row my-0 px-2 justify-content-between flex-wrap align-items-center py-0 mx-auto">

        <div class=" col-6 mb-2 mb-md-0 ps-0 px-md-2 py-md-4">
            <h1 class=" fs-1 text-white fw-bold">من نحن؟</h1>
            <p class="text-white fs-5 lh-base mt-5">
                في معهد العلوم العصبية والمواكبة، نؤمن بأن التحوّل الحقيقي يبدأ من الداخل، ولهذا نكرّس جهودنا لتحرير الإمكانات الكامنة لدى الأفراد والأسر والمجتمعات، عبر مزيج فريد من الكوتشينغ، التكوين، وعلم النفس الديناميكي.

                بفضل خبرة تمتد لأكثر من 12 سنة من العمل الميداني والمعرفي، نرافق الأطفال، الآباء، والمدارس، في مسارات تطوير شاملة تدمج بين النجاح الدراسي، التوازن النفسي، واكتساب المهارات الحياتية.

                ومن خلال منصة نيورال بوكس، نضع هذه التجربة بين يدي الأسر والأطر التربوية في قالب رقمي حديث، يجمع بين الأدوات العلاجية، المحتوى البيداغوجي، التكوين التربوي، والتوجيه الشخصي، لمواكبة كل من يسعى إلى بناء مستقبل تعليمي ونفسي متكامل.
            </p>
        </div>
        <div class="video-container col-5 shadow-lg">

            <div class="position-relative rounded-4 overflow-hidden tra" >
                <a href="{{ route('video-link', ['filename' => 'Tool-1.mp4']) }}" class="html5lightbox ">
                    <img src="{{ asset('images/peda/1.png') }}" alt="suivre video neuralbox" class="w-100 " />
                </a>
            </div>
        </div>
    </div>

    <svg class="hero-wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" preserveAspectRatio="none">
        <path fill="#fff" d="M0,0 C280,60 720,0 1440,60 L1440,60 L0,60 Z"></path>
    </svg>
</section>

<section class="mission-section mw-75">
    <div class="cccontainer">
        <!-- <div class="lg:max-w-2xl max-w-5xl "> -->
        <h2 class="section-title">قيمنا:</h2>
        <p class="ccontainer">تشكل قيمنا الأساس الذي نبني عليه جميع قراراتنا وخدماتنا، وهي تعكس التزامنا العميق تجاه عملائنا وشركائنا:</p>
        <div class="mission-container mw-75">
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

<section id="services" class="services-section">
    <div class="cccontainer">
        <h2 class="services-title"> مجالات تخصص معهد العلوم العصبية و المواكبة:</h2>
        <p class="services-subtitle">نقدم مجموعة متنوعة من الخدمات المصممة خصيصًا لدعم أطفالكم ومساعدتهم على التغلب على التحديات</p>

        <div class="services-grid">
            <div class="mission-card">
                <h3 class="service-title1"> الكوتشينغ والمواكبة النفسية:</h3>
                <p class="service-description">نوفر برامج علاج نفسي ومواكبة فردية وجماعية، تساعد الأطفال والبالغين على تخطي الصعوبات، اكتشاف الذات، وتحقيق نمو متوازن على المستويين الشخصي, الدراسي والمهني.</p>
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

@endsection
@section('footer','footer')
@extends('layouts.app')

@section('title', 'نيورال بوكس | دلبل نيورال بوكس')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('css/About.css') }}"> -->



<section class="pager-section blog-version">
    <div class="container">
        <div class="pager-content text-center">
            <h2>{{ __('nav.suivre') }}</h2>
            <ul>

                <li><span>في نيورال بوكس، ندرك أن لكل طفل احتياجات خاصة، وتحديات تمنعه من تحقيق التغيير المنشود، ومساعدته على اكتشاف قدراته الكاملة. توفر المنصة إمكانية التواصل المباشر مع فريق الخبراء والمتخصصين في مجالات متعددة؛ تشمل التوجيه الدراسي، التنويم المغناطيسي، المواكبة النفسية، والعلوم العصبية. سواء كنت تبحث عن استشارة لتحسين الأداء الدراسي، أو معالجة مشاكل التركيز والانتباه، الإدمان على الشاشات، أو التوجيه النفسي؛ فريقنا مستعد لتقديم حلول عملية ومخصصة تناسب احتياجات طفلك. اختر بين جلسات عن بُعد أو حضورياً، وكن على ثقة بأنك ستحصل على الدعم اللازم لإحداث تغيير حقيقي وإيجابي في حياة طفلك.</span></li>
            </ul>

        </div><!--pager-content end-->
    </div>
</section>



<section class="newsletter-section call  bg-transparent">
    <div class="newsletter-sec w-75 mx-auto">
        <div class="d-flex flex-column text-center align-items-center">
            <div class="col-lg-6">
                <div class="newsz-ltr-text">
                    <h2>{{__("suivre.call_to_action")}}</h2>
                </div><!--newsz-ltr-text end-->
            </div>
            <div class="text-center col-lg-8">
                <p>{{__("suivre.call_to_action_desc")}}</p>
                <a href="{{ route('rendezvous.create') }}" title="" class="w-fit btn-default mt-2">{{__("suivre.call_to_action_btn")}} <i class="fa fa-long-arrow-alt-right"></i></a>

            </div>
        </div>
    </div>
</section>
<section class="team-section">
    <div class="container">
        <h2 class="team-title">فريقنا المتخصص:</h2>
        <p class="about-description">
            سواء كنت تبحث عن استشارة لتحسين الأداء الدراسي، أو معالجة مشاكل التركيز والانتباه، الإدمان على الشاشات، أو التوجيه النفسي، فريقنا مستعد لتقديم حلول عملية ومخصصة تناسب احتياجات طفلك. اختر بين جلسات عن بُعد أو حضورياً، وكن على ثقة بأنك ستحصل على الدعم اللازم لإحداث تغيير حقيقي وإيجابي في حياة طفلك.
        </p>

        <div class="team-members-wrapper">
            <div class="row g-4 justify-content-center flex-nowrap">
                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <a href="/policy#coach-abdelhadi" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="assets/img/coaches/DSC00476.png" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.abdelhadi_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.abdelhadi_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <a href="/policy#Coach-Abderrahim" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/abderahim1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.abderahim_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.abderahim_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <a href="/policy#Mr-Abdessamad" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/abdessmed1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.abdsamad_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.abdsamad_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <a href="/policy#Coach-Khaoula" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/khaoula1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.khaoula_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.khaoula_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <a href="/policy#Coach-Nisrine" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/nisrin1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.nisrin_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.nisrin_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <a href="/policy#Coach-Malika" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/malika1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.malika_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.malika_spec') }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer','footer')

<!-- 
<section class="team-section">
    <div class="container">
        <h2 class="team-title">فريقنا المتخصص:</h2>
        <p class="about-description">
            سواء كنت تبحث عن استشارة لتحسين الأداء الدراسي، أو معالجة مشاكل التركيز والانتباه، الإدمان على الشاشات، أو التوجيه النفسي، فريقنا مستعد لتقديم حلول عملية ومخصصة تناسب احتياجات طفلك. اختر بين جلسات عن بُعد أو حضورياً، وكن على ثقة بأنك ستحصل على الدعم اللازم لإحداث تغيير حقيقي وإيجابي في حياة طفلك.
        </p>

        <div class="team-members-wrapper">
            <div class="row g-4 justify-content-center flex-nowrap">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="/policy#coach-abdelhadi" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="assets/img/coaches/DSC00476.png" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.abdelhadi_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.abdelhadi_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="/policy#Coach-Abderrahim" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/abderahim1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.abderahim_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.abderahim_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="/policy#Mr-Abdessamad" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/abdessmed1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.abdsamad_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.abdsamad_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="/policy#Coach-Khaoula" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/khaoula1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.khaoula_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.khaoula_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="/policy#Coach-Nisrine" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/nisrin1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.nisrin_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.nisrin_spec') }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="/policy#Coach-Malika" class="text-decoration-none text-dark">
                        <div class="team-member">
                            <div class="member-image">
                                <img src="{{ asset('assets/img/coaches/malika1.png') }}" alt="صورة المختص" class="img-fluid">
                            </div>
                            <h3 class="member-name">{{ __('coaches.malika_name') }}</h3>
                            <p class="member-role mb-0">{{ __('coaches.malika_spec') }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> -->
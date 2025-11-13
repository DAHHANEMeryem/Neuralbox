@extends('layouts.app')

@section('title', 'نيورال بوكس | دلبل نيورال بوكس')

@section('content')

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
@endsection
@section('footer','footer')
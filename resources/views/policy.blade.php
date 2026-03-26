@extends('layouts.app')

@section('title', 'نيورال بوكس | سياسة الخصوصية')

@section('content')

<style>
    /* Tout le texte de cette page en noir */
    .privacy-page, 
    .privacy-page h1,
    .privacy-page h2,
    .privacy-page h3,
    .privacy-page h4,
    .privacy-page h5,
    .privacy-page h6,
    .privacy-page p,
    .privacy-page .alert {
        color: #000 !important;
    }
</style>

<div class="container py-5 privacy-page">
    <div class="mb-4">
        <h1 class="display-4 fw-bold">{!! trans('privacy.title') !!}</h1>
        <p>{!! trans('privacy.last_update') !!}</p>
    </div>

    <div class="my-4">
        <p class="lead">{!! trans('privacy.intro') !!}</p>

        <div class="alert alert-warning" role="alert">
            <p class="mb-0">{!! trans('privacy.alert') !!}</p>
        </div>
    </div>

    <hr class="my-5">

    <div class="row g-5">
        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.scope_title') !!}</h2>
            <p>{!! trans('privacy.scope') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.collect_title') !!}</h2>
            {!! trans('privacy.collect') !!}
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.use_title') !!}</h2>
            <p>{!! trans('privacy.use') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.protect_title') !!}</h2>
            <p>{!! trans('privacy.protect') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.cookies_title') !!}</h2>
            <p>{!! trans('privacy.cookies') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.rights_title') !!}</h2>
            <p>{!! trans('privacy.rights') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.children_title') !!}</h2>
            <p>{!! trans('privacy.children') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.changes_title') !!}</h2>
            <p>{!! trans('privacy.changes') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3">{!! trans('privacy.contact_title') !!}</h2>
            <p>{!! trans('privacy.contact') !!}</p>
        </div>
    </div>
</div>
@endsection
@section('footer','footer')
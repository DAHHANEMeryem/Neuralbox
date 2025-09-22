@extends('layouts.app')

@section('title', 'نيورال بوكس | سياسة الخصوصية')

@section('content')

<div class="container py-5">
    <div class="mb-4">
        <h1 class="display-4 text-secondary fw-bold">{!! trans('privacy.title') !!}</h1>
        <p class="text-muted">{!! trans('privacy.last_update') !!}</p>
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
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.scope_title') !!}</h2>
            <p>{!! trans('privacy.scope') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.collect_title') !!}</h2>
            {!! trans('privacy.collect') !!}
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.use_title') !!}</h2>
            <p>{!! trans('privacy.use') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.protect_title') !!}</h2>
            <p>{!! trans('privacy.protect') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.cookies_title') !!}</h2>
            <p>{!! trans('privacy.cookies') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.rights_title') !!}</h2>
            <p>{!! trans('privacy.rights') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.children_title') !!}</h2>
            <p>{!! trans('privacy.children') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.changes_title') !!}</h2>
            <p>{!! trans('privacy.changes') !!}</p>
        </div>

        <div class="col-12">
            <h2 class="h4 fw-bold mb-3 text-secondary">{!! trans('privacy.contact_title') !!}</h2>
            <p>{!! trans('privacy.contact') !!}</p>
        </div>
    </div>
</div>
@endsection
@section('footer','footer')
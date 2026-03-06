@extends('layouts.default')

@section('content')
<!-- Hero Section -->
<!-- Secção principal com a imagem de destaque e o título principal do site -->
<header class="hero-section text-white text-center d-flex align-items-center justify-content-center"
    style="min-height: 45vh;">
    <div class="container">
        <h1 class="display-3 fw-bold">{{__('front_end.index.adopt_a_friend')}}</h1>
        <!-- Mensagem de boas-vindas -->
        <p class="lead mb-4">{{__('front_end.index.give_a_home')}}</p>
        <!-- Botão CTA (Call to Action) que leva à galeria -->
        <a href="/gallery" class="btn btn-lg btn-orange px-5 rounded-pill">{{__('front_end.index.see_animals')}}</a>
    </div>
</header>
<!-- Intro Section -->
<!-- Pequena introdução sobre o contexto da PAP e parceria com o canil -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="section-title">{{__('front_end.index.welcome')}}</h2>
                <p>{{__('front_end.index.text_welcome_one')}}</p>
                <p>{{__('front_end.index.text_welcome_two')}}</p>
                <a href="/about" class="btn btn-outline-success">{{__('common.more_button')}}</a>
            </div>
            <div class="col-md-6 text-center">
                <!-- Placeholder for an image -->
                <img src="images/imgIndex.png" alt="Cachorro Canil"
                    class="img-fluid rounded shadow-lg mt-4 mt-md-0">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">{{__('front_end.index.why_adopt')}}</h2>
        </div>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-heart feature-icon"></i>
                <h4>{{__('front_end.index.unconditional_love')}}</h4>
                <p>{{__('front_end.index.text_love')}}</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-home feature-icon"></i>
                <h4>{{__('front_end.index.save_lifes')}}</h4>
                <p>{{__('front_end.index.text_save')}}<p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-smile feature-icon"></i>
                <h4>{{__('front_end.index.companionship')}}</h4>
                <p>{{__('front_end.index.text_companionship')}}</p>
            </div>
        </div>
    </div>
</section>
@endsection
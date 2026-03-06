@extends('layouts.default')


@section('content')
<header class="py-5 bg-success text-white">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">{{__('front_end.relevance.title')}}</h1>
        <p class="lead">{{__('front_end.relevance.subtitle')}}</p>
    </div>
</header>

<section class="section-padding">
    <div class="container">
        <!-- Stats Row -->
        <div class="row text-center mb-5">
            <div class="col-md-4 mb-3">
                <div class="p-4 bg-white shadow rounded">
                    <h2 class="display-4 text-orange fw-bold">50+</h2>
                    <p class="text-muted">{{__('front_end.relevance.card1')}}</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-4 bg-white shadow rounded">
                    <h2 class="display-4 text-orange fw-bold">30%</h2>
                    <p class="text-muted">{{__('front_end.relevance.card2')}}</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-4 bg-white shadow rounded">
                    <h2 class="display-4 text-orange fw-bold">100%</h2>
                    <p class="text-muted">{{__('front_end.relevance.card3')}}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <h3 class="section-title mb-4">{{__('front_end.relevance.useful')}}</h3>
                <p>{{__('front_end.relevance.text_useful')}}</p>

                <h5 class="mt-4 mb-3 text-success">{{__('front_end.relevance.abandonment')}}</h5>
                <p>{{__('front_end.relevance.text_abandonment')}}</p>

                <h5 class="mt-4 mb-3 text-success">{{__('front_end.relevance.community')}}</h5>
                <p>{{__('front_end.relevance.text_community')}}</p>

                <h5 class="mt-4 mb-3 text-success">{{__('front_end.relevance.support')}}</h5>
                <p>{{__('front_end.relevance.text_support')}}</p>
            </div>
            <div class="col-lg-4">
                <div class="card card-custom bg-light mb-4">
                    <div class="card-body">
                        <h4 class="card-title text-dark-green">{{__('front_end.relevance.news')}}</h4>
                        <hr>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <small class="text-muted">12 Dez, 2024</small><br>
                                <a href="#" class="fw-bold text-decoration-none text-dark">{{__('front_end.relevance.news_one')}}</a>
                            </li>
                            <li class="mb-3">
                                <small class="text-muted">05 Nov, 2026</small><br>
                                <a href="#" class="fw-bold text-decoration-none text-dark">{{__('front_end.relevance.news_two')}}</a>
                            </li>
                            <li class="mb-3">
                                <small class="text-muted">20 Out, 2025</small><br>
                                <a href="#" class="fw-bold text-decoration-none text-dark">{{__('front_end.relevance.news_three')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card card-custom bg-orange text-black">
                    <div class="card-body text-center">
                        <h4 class="card-title text-black">{{__('front_end.relevance.volunteer')}}</h4>
                        <p class="card-text">{{__('front_end.relevance.text_volunteer')}}</p>
                        <a href="/contact" class="btn btn-light text-orange fw-bold">{{__('front_end.relevance.volunteer_button')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.default')

@section('content')
<section class="py-5 bg-dark text-white header-small">
    <div class="container text-center">
        <h1 class="display-4">{{__('front_end.about.acronym')}}</h1>
        <p class="lead">{{__('front_end.about.text_acronym')}}</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12 mx-auto">
                <h3 class="section-title">{{__('front_end.about.acronym')}}</h3>
                <p>{!!__('front_end.about.text_about_one')!!}</p>
                <p>{!!__('front_end.about.text_about_two')!!}</p>
                <div class="alert alert-success border-0 shadow-sm" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{__('front_end.about.text_info')}}
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-md-6 order-md-2">
                <img src="images/imgAbout.png" class="img-fluid rounded shadow"
                    alt="Batalha Landscape">
            </div>
            <div class="col-md-6 order-md-1">
                <h3 class="section-title">{{__('front_end.about.mission')}}</h3>
                <p>{{__('front_end.about.text_mission_one')}}</p>
                <p>{{__('front_end.about.text_mission_two')}}</p>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item bg-transparent"><i class="fas fa-check text-success me-2"></i>{{__('front_end.about.kennel')}}</li>
                    <li class="list-group-item bg-transparent"><i class="fas fa-check text-success me-2"></i>{{__('front_end.about.community')}}</li>
                    <li class="list-group-item bg-transparent"><i class="fas fa-check text-success me-2"></i>{{__('front_end.about.future_adopters')}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
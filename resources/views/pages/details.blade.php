@extends('layouts.default')

@section('content')
<div class="container py-5">
    <!-- Back Button & Title -->
    <div class="row align-items-center mb-5">
        <div class="col-md-3">
            <a href="/gallery" class="btn btn-outline-success rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i>{{__('front_end.details.all_animals_button')}}
            </a>
        </div>
    </div>

    <!-- Animal Details Card -->
    <div class="card shadow-lg border-0 overflow-hidden" style="border-radius: 20px;">
        <div class="row g-0">

            <livewire:photo-details :animal="$animal" />

            <!-- Info Section -->
            <div class="col-lg-6 p-5 d-flex flex-column justify-content-center bg-white">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h2 class="display-4 fw-bold text-dark mb-1">
                            {{ $animal->nome}}
                        </h2>
                        <span class="text-muted fs-5">{{__('front_end.details.form_n')}}
                            {{ $animal->id}}
                        </span>
                    </div>
                    @if ($animal->nome)
                        <span class="badge bg-success fs-6 rounded-pill px-3 py-2">{{__('front_end.details.avaliable')}}</span>
                    @else
                        <span class="badge bg-secondary fs-6 rounded-pill px-3 py-2">{{__('front_end.details.unavaliable')}}</span>
                    @endif
                </div>

                <!-- Attributes Strip -->
                <div class="bg-light rounded-3 p-3 mb-4 border-start border-4 border-success">
                    <div class="d-flex flex-wrap gap-3 align-items-center fw-bold text-success">
                        <span><i class="fas {{ $animal->sexo == 'Macho' ? 'fa-mars' : 'fa-venus' }}"></i>
                            {{ $animal->sexo}}
                        </span>
                        <span class="text-muted">|</span>
                        <span><i class="fas fa-paw"></i>
                            {{ $animal->category->type}}
                        </span>
                        <span class="text-muted">|</span>
                        <span><i class="fas fa-birthday-cake"></i>
                            {{ $animal->idade}}
                        </span>
                        <span class="text-muted">|</span>
                        <span><i class="fas fa-ruler"></i>
                            Porte {{ $animal->porte}}
                        </span>
                    </div>
                </div>

                <!-- Description -->
                    <div class="mb-5">
                    <p class="lead text-muted" style="line-height: 1.8;">
                        {!! $animal->storytelling ?? $animal->observacoes ?? __('front_end.details.description') !!}</p>
                    @if(!empty($animal->comportamento))
                        <p class="text-muted">
                            <i class="fas fa-info-circle me-2"></i>
                            {!!__('front_end.details.behavior')!!}
                            {{ $animal->comportamento }}
                        </p>
                    @endif
                </div>  

                <!-- Action Button -->
                <div>
                    <a href="/contact"
                        class="btn btn-orange btn-lg rounded-pill px-5 fw-bold shadow-sm w-100">
                        {{__('front_end.details.adopt_button')}}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center gap-3 mt-5">
        
    </div>

    
</div>
@endsection
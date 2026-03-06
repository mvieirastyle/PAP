@extends('layouts.default')

@section('content')
<header class="py-5 bg-dark-green text-white header-small" style="background-color: var(--dark-green);">
    <div class="container text-center">
        <h1 class="display-4">{{__('front_end.contact.title')}}</h1>
        <p class="lead">{{__('front_end.contact.subtitle')}}</p>
    </div>
</header>

<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-5 mb-5">
                <h3 class="section-title">{{__('front_end.contact.info')}}</h3>
                <p class="mb-4">{{__('front_end.contact.text_info')}}</p>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 btn-lg btn-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="ms-3">
                        <h5>{{__('front_end.contact.loc')}}</h5>
                        <p class="text-muted mb-0">Rua Cabeço da Freiria, 2440-036 Batalha<br>Portugal</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 btn-lg btn-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="ms-3">
                        <h5>{{__('front_end.contact.phone')}}</h5>
                        <p class="text-muted mb-0">+351 967 287 901</p>
                        <small class="text-muted">{{__('front_end.contact.obs')}}</small>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 btn-lg btn-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="ms-3">
                        <h5>Email</h5>
                        <p class="text-muted mb-0">geral@cm-batalha.pt</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4">{{__('front_end.contact.title_message')}}</h3>
                        <?php
                        $subject_val = isset($_REQUEST['subject']) ? htmlspecialchars($_REQUEST['subject']) : '';
                        ?>
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="contactName" class="form-label">{{__('front_end.contact.name')}}</label>
                                    <input type="text" class="form-control" id="contactName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contactEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="contactEmail" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="contactSubject" class="form-label">{{__('front_end.contact.topic')}}</label>
                                <input type="text" class="form-control" id="contactSubject"
                                    value="<?php echo $subject_val; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="contactMessage" class="form-label">{{__('front_end.contact.message')}}</label>
                                <textarea class="form-control" id="contactMessage" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-green btn-lg px-4">{{__('front_end.contact.message_button')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Maps -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="rounded overflow-hidden shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!4v1765966150509!6m8!1m7!1sH-DqlEaMf4UB7DC2kveqcw!2m2!1d39.65381560946641!2d-8.815888337049582!3f316.4919631772255!4f-13.93150059145529!5f0.7820865974627469"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
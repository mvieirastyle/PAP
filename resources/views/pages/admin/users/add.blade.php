@extends('layouts.admin')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> {{__('users.form.add_user')}}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/admin/users/add" enctype="multipart/form-data">
                        @csrf
                        <!-- Identificação Básica -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{__('users.form.identification')}}</h5>
                        <div class="row">
                            <div class="col-md-3 d-flex justify-content-center">
                                <div class="position-relative" style="width:150px; height:150px;">

                                    <img src="/images/profilePicture.png"
                                        class="rounded-circle object-fit-cover w-100 h-100" id="preview">

                                    <div class="position-absolute top-0 start-0 w-100 h-100 
                                    d-flex align-items-center justify-content-center
                                    bg-dark bg-opacity-50 text-white rounded-circle overlay-camera">
                                        <x-heroicon-o-camera style="width:35px; height:35px;" />
                                    </div>

                                    <input type="file" name="foto"
                                        class="position-absolute top-0 start-0 w-100 h-100 opacity-0 rounded-circle"
                                        style="cursor:pointer;" onchange="previewImage(event)">

                                    <label for="profilePicture"
                                        class="form-label d-flex align-items-center justify-content-center">
                                        {{__('users.form.edit_picture')}}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-5 mb-2">
                            </br>
                                <label for="first_name" class="form-label">{{__('users.form.first_name')}}</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>

                                <label for="last_name" class="form-label">{{__('users.form.last_name')}}</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>

                        <!-- Dados Administrativos -->
                        <h5 class="mb-3 text-muted border-bottom pb-2 mt-3">
                            {{__('users.form.administrative_details_data')}}</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">{{__('users.form.email')}}</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">{{__('users.form.username')}}</label>
                                <input type="name" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="password" class="form-label">{{__('common.pass')}}</label>
                                <input type="password" class="form-control" placeholder="••••••••" id="password"
                                    name="password" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="password" class="form-label">{{__('common.confirm_pass')}}</label>
                                <input type="password" class="form-control" placeholder="••••••••" id="password"
                                    name="password_confirmation" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <label class="form-check-label"
                                        for="admin">{{__('users.form.user_an_administrator')}}</label>
                                    <input class="form-check-input" type="checkbox" id="admin" name="admin">
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="/admin/users/list"
                                    class="btn btn-secondary me-md-2">{{__('common.cancel')}}</a>
                                <button type="submit" class="btn btn-success">{{__('common.save')}}</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
    const input = event.target;
    const img = document.getElementById('preview');

    if (input.files && input.files[0]) {
        img.src = URL.createObjectURL(input.files[0]);
    }
}
</script>

@endsection
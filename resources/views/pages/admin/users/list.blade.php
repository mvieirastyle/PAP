@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-tools text-orange"></i> {{__('common.administration_panel')}}</h1>
            <a href="/admin/users/add" class="btn btn-success"><i class="fas fa-plus"></i> {{__('users.add_user')}}</a>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">{{__('users.registered_users')}}</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>{{__('users.columns.picture')}}</th>
                                <th>{{__('users.columns.username')}}</th>
                                <th>{{__('users.columns.email')}}</th>
                                <th>{{__('users.columns.type')}}</th>
                                <th class="text-end">{{__('users.columns.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($users as $user)
                                <tr>
                                    <td>#{{ $user->id }}</td>
                                    <td>
                                        @if ($user->fotos->isNotEmpty())
                                            <img src="{{Storage::url($user->fotos->first()?->path)}}" alt="{{ $user->nome }}" class="rounded"
                                                style="width:90px; height:90px; object-fit: cover;">
                                        @else
                                            <span class="text-muted small">{{__('users.lines.no_image')}}</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">{{ $user->name }}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>
                                        @if ($user->admin)
                                            <span class="badge bg-success">{{__('users.lines.admin')}}</span>
                                        @else
                                            <span class="badge bg-secondary">{{__('users.lines.user')}}</span>
                                        @endif
                                    </td>
                     
                                    <td class="text-end">
                                        <a href="/admin/users/edit/{{$user->id}}"
                                            class="btn btn-sm btn-primary me-1" title="Editar"><i class="fas fa-edit"></i></a>

                                        <form action="/admin/users/delete/{{$user->id}}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('{{__('animal.confirmed')}}');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">Nenhum utilizador encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
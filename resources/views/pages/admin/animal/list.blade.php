@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-tools"></i> {{__('common.administration_panel')}}</h1>
        <a href="/admin/animal/add" class="btn btn-success"><i class="fas fa-plus"></i> {{__('animal.add_animal')}}</a>
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
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <div class="align-items-start">
                <h5 class="mb-0">{{__('animal.registered_animals')}}</h5>
            </div>
            <div class="text-end">
                <a href="list/export" class="btn text-white">
                    <i class="fa-regular fa-file-excel"></i> Export Excel
                </a>
                <a href="list/animais-pdf" class="btn text-white">
                    <i class="fa-regular fa-file-pdf"></i> Export PDF
                </a>
            </div>

        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>{{__('animal.columns.picture')}}</th>
                            <th>{{__('animal.columns.name')}}</th>
                            <th>{{__('animal.columns.category')}}</th>
                            <th>{{__('animal.columns.sex')}}</th>
                            <th>{{__('animal.columns.state')}}</th>
                            <th class="text-end">{{__('animal.columns.actions')}}</th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($animals as $animal)
                        <tr>
                            <td>#{{ $animal->id }}</td>
                            <td>
                                @if ($animal->fotos->isNotEmpty())
                                <img src="{{Storage::url($animal->fotos->first()?->path)}}" alt="{{ $animal->nome }}"
                                    class="rounded" style="width:90px; height:90px; object-fit: cover;">
                                @else
                                <span class="text-muted small">{{__('animal.lines.no_image')}}</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $animal->nome }}</td>
                            <td>{{ $animal->category ? $animal->category->type : 'N/A' }}</td>
                            <td>{{ $animal->sexo }}</td>
                            <td>
                                @if ($animal->disponivel)
                                <span class="badge bg-success">{{__('animal.lines.avaliable')}}</span>
                                @else
                                <span class="badge bg-secondary">{{__('animal.lines.unavailable')}}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="/admin/animal/edit/{{$animal->id}}" class="btn btn-sm btn-primary me-1"
                                    title="Editar"><i class="fas fa-edit"></i></a>

                                <form action="/admin/animal/delete/{{$animal->id}}" method="POST" class="d-inline"
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
                            <td colspan="7" class="text-center py-4">{{__('animal.not_found')}}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
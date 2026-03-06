@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> {{__('animal.form.edit_animal')}}</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/admin/animal/edit/{{ $animal->id}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <!-- Identificação Básica -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{__('animal.form.identification')}}</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">{{__('animal.form.name')}}</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="{{ $animal->nome }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">{{__('animal.form.category')}}</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">{{__('animal.form.select')}}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{$animal->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Características Físicas -->
                        <h5 class="mb-3 text-muted border-bottom pb-2 mt-3">{{__('animal.form.physical_characteristics')}}</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label d-block">{{__('animal.form.sex')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexM" value="Macho"
                                        {{ $animal->sexo == 'Macho' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sexM">{{__('animal.form.male')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexF" value="Fêmea"
                                        {{ $animal->sexo == 'Fêmea' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sexF">{{__('animal.form.female')}}</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="idade" class="form-label">{{__('animal.form.life_stage')}}</label>
                                <select class="form-select" id="idade" name="idade" required>
                                    <option value="">{{__('animal.form.select')}}</option>
                                    <option value="Filhote" {{ $animal->idade == 'Filhote' ? 'selected' : '' }}>{{__('animal.form.young_animal')}}</option>
                                    <option value="Adulto" {{ $animal->idade == 'Adulto' ? 'selected' : '' }}>{{__('animal.form.adult')}}</option>
                                    <option value="Idoso" {{ $animal->idade == 'Idoso' ? 'selected' : '' }}>{{__('animal.form.old')}}</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="porte" class="form-label">{{__('animal.form.size')}}</label>
                                <select class="form-select" id="porte" name="porte" required>
                                    <option value="">{{__('animal.form.select')}}</option>
                                    <option value="Pequeno" {{$animal->porte == 'Pequeno' ? 'selected' : '' }}>{{__('animal.form.small')}}</option>
                                    <option value="Médio" {{$animal->porte == 'Médio' ? 'selected' : '' }}>{{__('animal.form.medium')}}</option>
                                    <option value="Grande" {{$animal->porte == 'Grande' ? 'selected' : '' }}>{{__('animal.form.large')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="coloracao" class="form-label">{{__('animal.form.coloring')}}</label>
                                <input type="text" class="form-control" id="coloracao" name="coloracao"
                                    value="{{ $animal->coloracao }}">
                            </div>

                            <div class="col-md-8 mb-3">
                                <label for="vacinas" class="form-label">{{__('animal.form.vaccines')}}</label>
                                <select multiple class="form-select" id="vacinas" name="vacinas[]">
                                    @foreach ($vacinas as $vacina)
                                        <option value="{{$vacina->id}}" @if(in_array($vacina->id, $vacinasSelecionadas)){ selected }                                  
                                        @endif>
                                            {{$vacina->type}}</option>
                                    @endforeach
                                </select></br>
                                <i class="fas fa-info-circle me-2"></i><label>{{__('animal.form.info')}}
                                </label>
                            </div>

                        <!-- Comportamento e Detalhes -->
                        <h5 class="mb-3 text-muted border-bottom pb-2 mt-3">{{__('animal.form.details_behavior')}}</h5>
                        <div class="mb-3">
                            <label for="comportamento" class="form-label">{{__('animal.form.behavior')}}</label>
                            <input type="text" class="form-control" id="comportamento" name="comportamento"
                                value="{{ $animal->comportamento }}"
                                placeholder="{{__('animal.form.ex')}}">
                        </div>

                        <div class="mb-3">
                            <label for="storytelling" class="form-label">{{__('animal.form.storytelling')}}</label>
                            <textarea class="form-control" id="storytelling" name="storytelling"
                                rows="3">{{ $animal->storytelling }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="observacoes" class="form-label">{{__('animal.form.interval_notes')}}</label>
                            <textarea class="form-control" id="observacoes" name="observacoes"
                                rows="2">{{ $animal->observacoes }}</textarea>
                        </div>
                        <!-- Dados Administrativos -->
                        <h5 class="mb-3 text-muted border-bottom pb-2 mt-3">{{__('animal.form.administrative_details_data')}}</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="data_entrada" class="form-label">{{__('animal.form.entry_date')}}</label>
                                <input type="date" class="form-control" id="data_entrada" name="data_entrada"
                                    value="{{ $animal->data_entrada}}"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="data_adocao" class="form-label">{{__('animal.form.adoption_date')}}</label>
                                <input type="date" class="form-control" id="data_adocao" name="data_adocao"
                                    value="{{ $animal->data_adocao}}"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label d-block">Microchip</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="microchip" name="microchip" @checked($animal->microchip)>
                                    <label class="form-check-label" for="microchip">{{__('animal.form.have_microchip')}}</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="disponivel" class="form-label">{{__('animal.form.state')}}</label>
                                <select class="form-select" id="disponivel" name="disponivel">
                                    <option value="1" {{ $animal->disponivel == 1 ? 'selected' : '' }}>{{__('animal.form.avaliable')}}</option>
                                    <option value="0" {{ $animal->disponivel === 0 ? 'selected' : '' }}>{{__('animal.form.unavailable')}}</option>
                                </select>
                            </div>
                        </div>

                        <livewire:photo :animal="$animal"/>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="/admin/animal/list" class="btn btn-secondary me-md-2">{{__('common.cancel')}}</a>
                            <button type="submit" class="btn btn-success">{{__('common.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

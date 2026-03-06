@extends('layouts.admin')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fa-solid fa-chart-line"></i> Dashboard Area</h1>
    </div>

    <div class="charts-wrapper row">

        <div class="col-md-4">
            <div class="chart-card">
                {!! $chartMicrochips->container() !!}

                <div>
                    <a href="#" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> Export Excel
                    </a>
                    <a href="#" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> Export PDF
                    </a>
                </div>

            </div>

            <div class="chart-card">
                {!! $chartAnimals->container() !!}

                <div>
                    <a href="animais-excel" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> Export Excel
                    </a>
                    <a href="animais-pdf" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> Export PDF
                    </a>
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="chart-card">

                <form method="GET" class="filter-form">
                    <div>
                        <label>Data Inicial:</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}">
                    </div>

                    <div>
                        <label>Data Final:</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success btn-sm">
                            Filtrar
                        </button>
                    </div>
                </form>

                {!! $chartAdocoes->container() !!}

                <div>
                    <a href="adocoes-excel" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> Export Excel
                    </a>
                    <a href="adocoes-pdf" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> Export PDF
                    </a>
                </div>

            </div>

            <div class="chart-card">

                <form method="GET" class="filter-form">
                    <div>
                        <label>Data Inicial:</label>
                        <input type="date" name="startDate" value="{{ request('startDate') }}">
                    </div>

                    <div>
                        <label>Data Final:</label>
                        <input type="date" name="endDate" value="{{ request('endDate') }}">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success btn-sm">
                            Filtrar
                        </button>
                    </div>
                </form>

                {!! $chartEntradas->container() !!}

                <div>
                    <a href="#" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> Export Excel
                    </a>
                    <a href="#" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> Export PDF
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>


<script src="{{ $chartAnimals->cdn() }}"></script>
<script src="{{ $chartAdocoes->cdn() }}"></script>
<script src="{{ $chartEntradas->cdn() }}"></script>
<script src="{{ $chartMicrochips->cdn() }}"></script>

{{ $chartAnimals->script() }}
{{ $chartAdocoes->script() }}
{{ $chartEntradas->script() }}
{{ $chartMicrochips->script() }}

@endsection
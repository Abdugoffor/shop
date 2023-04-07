@extends('layout')
@section('con')
    <style>
        .dataTables_paginate {
            display: none;
        }
    </style>
    <div class="main-content app-content">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden bg-primary">
                                    <div class="card-body">
                                        <a href="{{ route('xisob', 1) }}" class="text-light">
                                            <div class="d-flex">
                                                <div class="mt-2">
                                                    <h2 class="">Qolgan</h2>
                                                    <h2 class="mb-0 number-font">
                                                        {{ count($models->where('soni', '>', 0)) }}
                                                    </h2>
                                                </div>
                                                <div class="ms-auto">
                                                    <div class="chart-wrapper mt-1">
                                                        <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden bg-success">
                                    <div class="card-body">
                                        <a href="{{ route('xisob', 2) }}" class="text-light">
                                            <div class="d-flex">
                                                <div class="mt-2">
                                                    <h2 class="">Sotilgan </h2>
                                                    <h2 class="mb-0 number-font">
                                                        {{ $zakaz }}
                                                    </h2>
                                                </div>
                                                <div class="ms-auto">
                                                    <div class="chart-wrapper mt-1">
                                                        <canvas id="leadschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden bg-warning">
                                    <div class="card-body">
                                        <a href="{{ route('xisob', 3) }}" class="text-light">
                                            <div class="d-flex">
                                                <div class="mt-2">
                                                    <h2 class="">10 dan kam </h2>
                                                    <h2 class="mb-0 number-font">
                                                        {{ count($models->where('soni', '<', 10)) }}
                                                    </h2>
                                                </div>
                                                <div class="ms-auto">
                                                    <div class="chart-wrapper mt-1">
                                                        <canvas id="profitchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden bg-danger">
                                    <div class="card-body">
                                        <a href="{{ route('xisob', 4) }}" class="text-light">
                                            <div class="d-flex">
                                                <div class="mt-2">
                                                    <h2 class="">Tugagan </h2>
                                                    <h2 class="mb-0 number-font">
                                                        {{ count($models->where('soni', 0)) }}
                                                    </h2>
                                                </div>
                                                <div class="ms-auto">
                                                    <div class="chart-wrapper mt-1">
                                                        <canvas id="costchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 END -->
                <div class="card-body mt-0">
                    <form action="{{ route('date') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Dan</label>
                                    <input type="date" name="date1" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Gacha</label>
                                    <input type="date" name="date2" class="form-control">
                                </div>
                            </div>
                            <div class="col-2 mt-5">
                                <div class="form-group mt-3">
                                    <input type="submit" name="ok" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ROW-2 -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tavarlar</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive col-12">
                                <table id="file-datatable"
                                    class="table table-bordered text-nowrap key-buttons border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 w-1">#</th>
                                            <th class="border-bottom-0 w-4">Nom</th>
                                            <th class="border-bottom-0 w-10">Img</th>
                                            <th class="border-bottom-0 w-4">Soni</th>
                                            <th class="border-bottom-0 w-4">Summa</th>
                                            <th class="border-bottom-0 w-4">Sana</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($zakazs as $z)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $z->tavar->name }}</td>
                                                <td>
                                                    <img src="{{ asset($z->tavar->img) }}" width="100px" alt="">
                                                </td>
                                                <td>{{ number_format($z->soni) }} </td>
                                                <td>{{ number_format($z->sum) }} </td>
                                                <td>{{ $z->created_at->format('H:m, d-M-Y') }}</td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $zakazs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-4 END -->
        </div>
        <!-- CONTAINER END -->
    </div>
    </div>
@endsection

@extends('layout')
@section('con')
    @php

    @endphp
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
                                                <th class="border-bottom-0 w-4">Tan narx</th>
                                                <th class="border-bottom-0 w-4">Sotilishi</th>
                                                <th class="border-bottom-0 w-4">Soni</th>
                                                <th class="border-bottom-0">Sana</th>
                                                <th class="border-bottom-0">Sana</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($zakazs as $model)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $model->name }}</td>
                                                    <td><img src="{{ asset($model->img) }}" width="100px" alt="">
                                                    </td>
                                                    <td>{{ number_format($model->narx1) }} so'm</td>
                                                    <td>{{ number_format($model->narx2) }} so'm</td>
                                                    <td>{{ number_format($model->soni) }} </td>
                                                    <td>{{ $model->created_at->format('H:m, d-M-Y') }}</td>
                                                    <td>
                                                        <div class="col-sm-6 col-md-6 col-xl-3">
                                                            <a class="btn btn-outline-primary"
                                                                data-bs-effect="effect-flip-vertical"
                                                                data-bs-toggle="modal"
                                                                href="#modaldemo8{{ $model->id }}"><i
                                                                    class="fe fe-edit"></i></a>

                                                            {{-- Delete --}}
                                                            <a class="btn btn-outline-danger"
                                                                data-bs-effect="effect-flip-vertical"
                                                                data-bs-toggle="modal"
                                                                href="#modaldemo81{{ $model->id }}"><i
                                                                    class="fe fe-trash-2"></i></a>
                                                        </div>

                                                        <!-- MODAL Update -->
                                                        <div class="modal fade" id="modaldemo8{{ $model->id }}">
                                                            <div class="modal-dialog modal-dialog-centered text-center"
                                                                role="document">
                                                                <div class="modal-content modal-content-demo">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title">O'zgartirish</h6>
                                                                        <button aria-label="Close" class="btn-close"
                                                                            data-bs-dismiss="modal"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                    </div>
                                                                    <form action="{{ route('tavaredit', $model->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <input type="text" name="name"
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Tavarlar nomi"
                                                                                    value="{{ $model->name }}"
                                                                                    autocomplete="username">

                                                                            </div>
                                                                            <div class="card">
                                                                                <input type="text"
                                                                                    value="{{ $model->brend }}"
                                                                                    name="brend" class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Brend nomi"
                                                                                    autocomplete="username">
                                                                            </div>
                                                                            <div class="card">
                                                                                <input type="file"
                                                                                    value="{{ $model->img }}"
                                                                                    name="img" class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Brend nomi"
                                                                                    autocomplete="username">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                {{-- <label for="ss" class="align-left">Categorya tanlang</label> --}}
                                                                                <select id="ss"
                                                                                    class="form-control" name="cate_id">
                                                                                    <option>Categorya tanlang </option>
                                                                                    @foreach ($cates as $cate)
                                                                                        <option
                                                                                            value="{{ $cate->id }}"
                                                                                            @if ($model->cate_id == $cate->id) {{ 'selected' }} @endif>
                                                                                            {{ $cate->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="card">
                                                                                <input type="number" min="1"
                                                                                    value="{{ $model->narx1 }}"
                                                                                    name="narx1" class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Tan narx"
                                                                                    autocomplete="username">

                                                                            </div>
                                                                            <div class="card">
                                                                                <input type="number" min="1"
                                                                                    value="{{ $model->narx2 }}"
                                                                                    name="narx2" class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Sotilishi narx"
                                                                                    autocomplete="username">

                                                                            </div>
                                                                            <div class="card">
                                                                                <input type="number" min="0"
                                                                                    value="{{ $model->soni }}"
                                                                                    name="soni" class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Soni"
                                                                                    autocomplete="username">

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="submit" class="btn btn-primary"
                                                                                value="Saqlash" name="ok">
                                                                            <button class="btn btn-light"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- MODAL Delete -->
                                                        <div class="modal fade" id="modaldemo81{{ $model->id }}">
                                                            <div class="modal-dialog modal-dialog-centered text-center"
                                                                role="document">
                                                                <div class="modal-content modal-content-demo">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title">O'chirish</h6>
                                                                        <button aria-label="Close" class="btn-close"
                                                                            data-bs-dismiss="modal"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                    </div>
                                                                    <form action="{{ route('tavardelete', $model->id) }}"
                                                                        method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="col-md-12">
                                                                                <h2>{{ $model->name }} : o'chirishni
                                                                                    hohlaysizmi ?</h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="submit" class="btn btn-primary"
                                                                                value="O'chirish" name="ok">
                                                                            <button class="btn btn-light"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
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

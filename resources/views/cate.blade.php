@extends('layout')
@section('con')
    <div class="main-content app-content mt-5">
        <div class="side-app">

            <div class="col-sm-6 col-md-6 col-xl-3">
                <a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-flip-vertical"
                    data-bs-toggle="modal" href="#modaldemo8">Kategorya qo'shish</a>
            </div>

            <!-- MODAL EFFECTS -->
            <div class="modal fade" id="modaldemo8">
                <div class="modal-dialog modal-dialog-centered text-center" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Kategorya qo'shish</h6><button aria-label="Close" class="btn-close"
                                data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('cateadd') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="card">
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                            placeholder="Kategorya nomi" autocomplete="username">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Saqlash" name="ok">
                                <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kategorya</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="file-datatable"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">Name</th>
                                                <th class="border-bottom-0">Salary</th>
                                                <th class="border-bottom-0">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($models as $model)
                                                <tr>
                                                    <td>{{ $loop->index+1}}</td>
                                                    <td>{{ $model->name }}</td>
                                                    <td>{{ $model->created_at->format('H:m, d-M-Y') }}</td>
                                                    <td>
                                                        <div class="col-sm-6 col-md-6 col-xl-3">
                                                            <a class="btn btn-outline-primary"
                                                                data-bs-effect="effect-flip-vertical" data-bs-toggle="modal"
                                                                href="#modaldemo8{{ $model->id }}"><i
                                                                    class="fe fe-edit"></i></a>

                                                            {{-- Delete --}}
                                                            <a class="btn btn-outline-danger"
                                                                data-bs-effect="effect-flip-vertical" data-bs-toggle="modal"
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
                                                                    <form action="{{ route('cateedit', $model->id) }}"
                                                                        method="POST">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="col-md-12">
                                                                                <div class="card">
                                                                                    <input type="text"
                                                                                        value="{{ $model->name }}"
                                                                                        name="name" class="form-control"
                                                                                        id="exampleInputEmail1"
                                                                                        placeholder="Kategorya nomi"
                                                                                        autocomplete="username">

                                                                                </div>
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
                                                                    <form action="{{ route('delete', $model->id) }}"
                                                                        method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="col-md-12">
                                                                                <h2>{{ $model->name }} : o'chirishni hohlaysizmi ?</h2>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>
    </div>
@endsection

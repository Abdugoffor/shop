@extends('layout')
@section('con')
    <div class="main-content app-content mt-0">
        <div class="side-app">


            <!-- CONTAINER -->
            <div class="main-container container-fluid mt-5">

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-10">
                        <div class="card cart">
                            <div class="card-header">
                                <h3 class="card-title">Shopping Cart</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-vcenter">
                                        <thead>
                                            <tr class="border-top">
                                                <th>IMG</th>
                                                <th>Nom</th>
                                                <th>Nrax</th>
                                                <th>Soni</th>
                                                <th>Sum</th>
                                                <th>O'chirish</th>
                                            </tr>
                                            @php
                                                $sum = 0;
                                                $sum_count = 0;
                                            @endphp

                                        </thead>
                                        @if (session('cart'))
                                            <tbody>
                                                @foreach (session('cart') as $id => $product)
                                                    @php
                                                        $sum_count = $product['narx'] * $product['soni'];
                                                        $sum = $sum + $sum_count;
                                                    @endphp

                                                    <tr>
                                                        <td>
                                                            <div class="text-center">
                                                                <img src="{{ $product['img'] }}" alt=""
                                                                    class="cart-img text-center">
                                                            </div>
                                                        </td>
                                                        <td>{{ $product['name'] }}</td>
                                                        <td class="fw-bold">${{ $product['narx'] }}</td>
                                                        <td>
                                                            <form action="{{ route('soni', $id) }}" method="post">
                                                                @csrf
                                                                <div class="handle-counter" id="handleCounter4">
                                                                    <button type="submit" name="change" value="down"
                                                                        class="counter-minus btn btn-white lh-2 shadow-none">
                                                                        @if ($product['soni'] === 1)
                                                                            x
                                                                        @else
                                                                            <i class="fa fa-minus text-muted"></i>
                                                                        @endif
                                                                    </button>
                                                                    <input type="text" dis value="{{ $product['soni'] }}"
                                                                        class="qty" max="{{ $product['max'] }}" disabled>
                                                                    <button type="submit" name="change" value="top"
                                                                        class="counter-plus btn btn-white lh-2 shadow-none">
                                                                        <i class="fa fa-plus text-muted"></i>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td>${{ $sum_count }}</td>
                                                        <td>
                                                            <div class=" d-flex g-2">
                                                                <a href="{{ route('deletecart', $id) }}"
                                                                    class="btn text-danger bg-danger-transparent btn-icon py-1"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Delete"><span
                                                                        class="bi bi-trash fs-16"></span></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        @endif
                                        <h2>Jami : {{ number_format($sum) }}</h2>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('savdo') }}" class="btn btn-outline-info me-md-2">Saqlash</a>
                                    </div>
                                    <form method="GET" action="{{ route('search') }}">
                                        @csrf
                                        <div class="mt-3">
                                            <div class="input-group mb-1">
                                                <input type="text" class="form-control" name="text"
                                                    placeholder="Qidiruv ...">
                                                <input type="submit" name="ok" value="Qidiruv"
                                                    class="input-group-text btn btn-outline-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Cart Totals</div>
                            </div>
                            <div class="card-body py-2">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="text-start">Sub Total</td>
                                                <td class="text-end"><span class="fw-bold  ms-auto">$568</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start">Additional Discount</td>
                                                <td class="text-end"><span class="fw-bold text-success">- $55</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start">Delivery Charges</td>
                                                <td class="text-end"><span class="fw-bold text-green">0 (Free)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start">Tax</td>
                                                <td class="text-end"><span class="fw-bold text-danger">+ $39</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start">Coupon Discount</td>
                                                <td class="text-end"><span class="fw-bold text-success">- $15%</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start">Vat Tax</td>
                                                <td class="text-end"><span class="fw-bold">+ $9</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start fs-18">Total Bill</td>
                                                <td class="text-end"><span class="ms-2 fw-bold fs-23">$568</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="btn-list">
                                    <a href="shop.html" class="btn btn-primary"><i
                                            class="fa fa-arrow-left me-1"></i>Continue Shopping</a>
                                    <a href="checkout.html" class="btn btn-success float-sm-end">Check out<i
                                            class="fa fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                @if (isset($models))
                    <div class="col-xl-10 col-lg-6">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-11">
                                <div class="row">
                                    @foreach ($models as $model)
                                        <div class="col-2">
                                            <div class="card">
                                                <div class="product-grid6">
                                                    <div class="card-body pt-2">
                                                        <div class="product-content text-center">
                                                            <h1 class="title fw-bold fs-20"><a
                                                                    href="#">{{ $model->name }}</a></h1>
                                                            <img src="{{ $model->img }}" alt="">
                                                            <div class="price">{{ number_format($model->narx2) }} So'm
                                                                <b class="price">{{ number_format($model->soni) }}
                                                                </b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <a href="{{ route('add-cart', $model->id) }}"
                                                            class="btn btn-primary mb-1"><i
                                                                class="fe fe-shopping-cart mx-1"></i>Savatcha</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- COL-END -->
                    </div>
                @endif
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="/home">Home</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="/stock">Stock</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="/product">Produto</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/debt">Dívidas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/debt" >Venda Rápida</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container mt-5 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card p-3 mb-2">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div class="icon"><i class="bx bxl-mailchimp"></i></div>
                                                <div class="ms-2 c-details">
                                                    <h4 class="mb-0"><b>Produtos</b></h4> <span>{{date("d/m/Y H:m:s")}}</span>
                                                </div>
                                            </div>
                                            <div class="badge"><span>Design</span></div>
                                        </div>
                                        <div class="mt-5">
                                            <h5 class="heading">Quantidade de Produtos:<br></h5>
                                            <h3 class="heading">{{\App\Models\Products::get()->sum('amount') - \App\Models\Stocks::get()->sum('amount')}} unidades</h3>
                                            <div class="mt-5">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%"
                                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="mt-3"><span class="text1">Processado <span class="text2">{{date('H:m:s')}}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-3 mb-2">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                                <div class="ms-2 c-details">
                                                    <h4 class="mb-0"><b>Devedor</b></h4> <span>{{date("d/m/Y H:m:s")}}</span>
                                                </div>
                                            </div>
                                            <div class="badge"><span>Product</span></div>
                                        </div>
                                        <div class="mt-5">
                                            <h5 class="heading">Valor total:<br></h5>
                                            <h3 class="heading">{{\App\Models\Debts::get()->sum('value')}},00 Kz</h3>
                                            <div class="mt-5">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%"
                                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="mt-3"><span class="text1">Processado <span class="text2">{{date('H:m:s')}}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-3 mb-2">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div class="icon"><i class="bx bxl-reddit"></i></div>
                                                <div class="ms-2 c-details">
                                                    <h4 class="mb-0"><b>Vendas</b></h4> <span>{{date("d/m/Y H:m:s")}}</span>
                                                </div>
                                            </div>
                                            <div class="badge"><span>Design</span></div>
                                        </div>
                                        <div class="mt-5">
                                            @foreach(\App\Models\Products::all() as $product)
                                            <h6 class="heading"> {{$product->name}}: {{\App\Models\Stocks::where('product_id',$product->id)->sum("amount") * $product->price }},00 Kz , Lucro *** Kz</h6>
                                            @endforeach
                                            <div class="mt-5">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%"
                                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="mt-3"><span class="text1">Processado <span class="text2">{{date('H:m:s')}}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

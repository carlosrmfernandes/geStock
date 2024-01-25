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
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                        aria-label="Toggle navigation">
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
                        <div class="bg-light clearfix">
                            <button type="button" class="btn btn-primary register_product_modal" >Registrar Produto
                            </button>
                        </div>
                        <br>
                        <table class="table table-bordered table-hover table-sm table-responsive-md">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Identificador</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Preço</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Acção</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Products::all() as $product)
                                <tr>
                                    <td>{{$product->id}}</td>

                                    <td>{{$product->name}}</td>

                                    <td>{{$product->amount - \App\Models\Stocks::where('product_id', $product->id)->sum('amount') }} </td>

                                    <td>{{$product->price}}</td>

                                    <td>
                                        <button class="btn btn-link btn-edit" data-id="{{$product->id}}">Editar</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-show" data-id="{{$product->id}}">Mostrar</button>
                                    </td>
                                    <td>
                                        <form method="post" class="delete_form" action="{{ route('product.delete',$product->id)}}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" data-id="{{$product->id}}" disabled>Apagar</button>
                                        </form>


                                    </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="register_product"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('product.store') }}">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="price">Preço</label>
                                <input class="form-control" type="number" id="price" name="price" required>
                            </div>
                            <div class="col-md-4">
                                <label for="amount">Quantidade</label>
                                <input class="form-control" type="number" id="amount" name="amount" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" id="salvar" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/bootstrapmini.js')}}"></script>

    <script type="module">
        $(document).ready(function () {
            editar();
            show();
            function editar(){
                $(".btn-edit").click(function () {
                    var id = $(this).data("id");
                    var url = 'http://127.0.0.1:8000';
                    $.get(url+'/product/'+id).done(function (data) {
                        $('#name').val(data.name).prop("disabled", false);
                        $('#price').val(data.price).prop("disabled", false);
                        $('#amount').val(data.amount).prop("disabled", false);
                        $('#id').val(data.id).prop("disabled", false);
                    });

                    $("#register_product").modal("show");

                });
            }

            function show(){
                $(".btn-show").click(function () {
                    var id = $(this).data("id");
                    var url = 'http://127.0.0.1:8000';
                    $.get(url+'/product/'+id).done(function (data) {
                        $('#name').val(data.name).prop("disabled", true);
                        $('#price').val(data.price).prop("disabled", true);
                        $('#amount').val(data.amount).prop("disabled", true);
                        $('#id').val(data.id).prop("disabled", true);
                    });

                    $("#register_product").modal("show");

                });

            }


            $(".register_product_modal").click(function () {

                $('#name').val(null).prop("disabled", false);
                $('#price').val(null).prop("disabled", false);
                $('#amount').val(null).prop("disabled", false);
                $('#id').val(null).prop("disabled", false);

                $("#register_product").modal("show");
            });

        });
    </script>
@endsection


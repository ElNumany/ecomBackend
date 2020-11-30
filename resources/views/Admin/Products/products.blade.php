@extends('layouts\app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Products') }} <a class="btn btn-primary" href="{{ route('new-product') }}"><i class="fas fa-plus"></i></a></div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-md-4">
                                    <div class="alert alert-primary" role="alert">
                                        <h6>Categeory :
                                            {{ is_object($product->category) ? $product->category->category_name : '' }}
                                        </h6>
                                        <h5> Price = {{ $product->price }} {{ $currency_code }}</h5>
                                        {!! count($product->image) > 0 ? '<img class="img-thumbnail card-img"
                                            src="' . $product->image[0]->url . '" />' : '' !!}
                                            <a class="btn btn-success mt-2" href="{{ route('update-product' , ['id' => $product->id ]) }}"> Update product</a>
                                    </div>
                                </div>
                            @endforeach
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

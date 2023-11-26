
@extends('user-page.layouts.user_main')

@section('content-pages')

<div class="explain-product my-4">
    <div class="heading text-center ">
        <div class="pt-3">
        <h3 style="font-size: 26px; font-weight: 600"> {{$title}} </h3>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($wishlist as $item)
            <div class="mt-3 p-3 card shadow-lg">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>{{$item->trainingsTitle}}</h2>
                        <span class="alert alert-info py-0"> {{$item->category}}</span>
                        <p class="mt-2">{{$item->description}}</p>
                        <span class="alert alert-warning py-0">Gelombang {{$item->gelombang}}</span>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{asset('/storage/'.$item->image)}}" class="w-75" alt="serviceImg">
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection

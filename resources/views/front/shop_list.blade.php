@extends('front.layout')

@section('main')

    <section class="pricing-page">
        <div class="container">
            <div class="center">
                <h2>Available Shops</h2>
            </div>
            <div class="pricing-area text-center">
                <div class="row">

                    @foreach($shops as $shop)
                    <div class="col-sm-6 col-md-3 plan price-two wow fadeInDown">
                        <ul>
                            <li>
                                <img src="{{ $shop->get_logo() }}" class="img-thumbnail img-responsive" />
                            </li>
                            <li> <strong>{{ $shop->name }}</strong></li>
                            <li>{!! nl2br($shop->address) !!}</li>
                            <li class="plan-action">
                                <a href="{{ route('shop_single', $shop->slug) }}" class="btn btn-primary">View</a>
                            </li>
                        </ul>
                    </div>
                    @endforeach

                </div>
            </div><!--/pricing-area-->
        </div><!--/container-->
    </section><!--/pricing-page-->



@endsection
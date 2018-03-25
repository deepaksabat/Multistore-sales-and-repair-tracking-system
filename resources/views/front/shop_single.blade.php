@extends('front.layout')
@section('title') {{ empty($title) ? '' : $title.' - ' }} @parent  @stop

@section('main')

    <section class="pricing-page">
        <div class="container">

            <div class="row">
                    <div class="col-md-5">
                        <img src="{{ $shop->get_logo() }}" class="img-thumbnail img-responsive" />
                    </div>

                    <div class="col-md-7">
                        <h1 class="pull-left">{{ $shop->name }}</h1>





                        @if(Auth::check())
                            @if($lUser->isUser())
                                @if( ! $is_joined)
                                    <a  class="pull-right btn btn-info" href="{{ route('join_referral_shop', $shop->slug) }}">Join Referral Program</a>
                                @else <!-- $is_joined -->
                                    <p class="text text-success pull-right"> <i class="fa fa-check-circle"></i> You have joined</p>
                                @endif <!-- $is_joined -->
                            @else <!--  $lUser->isUser() -->
                                <p class="text text-danger pull-right"><strong> <i class="fa fa-ban"></i> Sorry,</strong> Your are not an agent</p>
                            @endif <!--  $lUser->isUser() -->
                        @else <!--  if Auth::check() -->
                                    <a  class="pull-right btn btn-info" href="{{ route('join_referral_shop', $shop->slug) }}">Join Referral Program</a>
                        @endif <!--  if Auth::check() -->




                        <div class="clearfix"></div>


                        @if(session('join_success'))
                            <div class="alert alert-success">
                               <i class="fa fa-check-circle-o"></i> {!! session('join_success') !!}
                            </div>
                        @endif

                        <hr />

                        {{ $shop->address }}
                        <hr />

                        {{ $shop->description }}

                    </div>
            </div>


        </div><!--/container-->
    </section><!--/pricing-page-->



@endsection
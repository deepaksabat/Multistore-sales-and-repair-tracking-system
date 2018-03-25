@extends('front.layout')
@section('title') {{ empty($title) ? '' : $title.' - ' }} @parent  @stop

@section('main')

    <section id="contact-page">
        <div class="container">
            <div class="center">
                <h2>{{ $title }}</h2>
                {{--<p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
            </div>
            <div class="row contact-wrap">
                <div class="status alert alert-success" style="display: none"></div>


                @if(request()->segment(3) == 'sign-up')


                    @if(Auth::check())
                        @if($lUser->isUser())

                            @if( ! $is_joined)

                                <div class="col-sm-10 col-sm-offset-1">
                                    <p> Hello {{ $lUser->get_fullname() }}, <br />
                                        you have registered on {{ Helpers::get_option('company_name') }}, confirm if you want to join <strong>{{ $shop->name }}</strong> referral program </p>

                                    {!! Form::open(['route' => ['join_referral_program', $shop->slug ]]) !!}
                                    <button class="btn btn-success">I accept terms and condition and agree to join</button>
                                    <a href="{{ route('shop') }}" class="btn btn-danger">Cancel</a>

                                    {!! Form::close() !!}

                                </div>

                            @else <!-- $is_joined -->

                                <div class="alert alert-warning">
                                    <strong>Hi {{ $lUser->get_fullname() }},</strong> You are already an agent of <strong> {{ $shop->name }} </strong>
                                </div>

                            @endif <!-- $is_joined -->

                        @else <!--  $lUser->isUser() -->

                        <div class="alert alert-warning">
                            <strong>Sorry,</strong> Your current profile is not an agent, please try with new profile.
                        </div>

                        @endif <!--  $lUser->isUser() -->

                    @else <!--  if Auth::check() -->

                    <div class="col-sm-5 col-sm-offset-1">

                        <h4>Register as new agent</h4>
                        {!! Form::open(['class' => 'contact-form']) !!}

                        <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First name">
                            {!! $errors->has('first_name')? '<p class="help-block"> '.$errors->first('first_name').' </p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('last_name')? 'has-error' : '' }}">
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" />
                            {!! $errors->has('last_name')? '<p class="help-block"> '.$errors->first('last_name').' </p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                            {!! $errors->has('email')? '<p class="help-block"> '.$errors->first('email').' </p>':'' !!}
                        </div>


                        <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            {!! $errors->has('password')? '<p class="help-block"> '.$errors->first('password').' </p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation')? 'has-error' : '' }}">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                            {!! $errors->has('password_confirmation')? '<p class="help-block"> '.$errors->first('password_confirmation').' </p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('mobile_number')? 'has-error' : '' }}">
                            <input type="number" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" placeholder="Mobile Number">
                            {!! $errors->has('mobile_number')? '<p class="help-block"> '.$errors->first('mobile_number').' </p>':'' !!}
                        </div>


                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Signup</button>
                        </div>

                        {!! Form::close() !!}

                    </div>


                    <div class="col-sm-5">
                        <h4>Register as existing agent</h4>

                        {!! Form::open(['route' => ['sign_in_referral_shop', request()->segment(2) ] ])  !!}
                        <div class="form-group has-feedback {{ $errors->has('e_email') ? 'has-error':'' }}">
                            <input type="email" class="form-control" name="e_email" placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            {!! $errors->has('e_email') ? '<p class="help-block"> '.$errors->first('e_email').' </p>': '' !!}
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('e_password') ? 'has-error':'' }}">
                            <input type="password" class="form-control" name="e_password" placeholder="Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            {!! $errors->has('e_password') ? '<p class="help-block"> '.$errors->first('e_password').' </p>': '' !!}
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox"> Remember Me
                                    </label>
                                </div>
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat"> <i class="fa fa-sign-in"></i> Sign In</button>
                            </div><!-- /.col -->
                        </div>
                        {!! Form::close() !!}

                    </div>

                    @endif <!--  if Auth::check() -->


                @else
                    {!! Form::open(['class' => 'contact-form']) !!}

                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                            <label class="control-label">First Name *</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                            {!! $errors->has('first_name')? '<p class="help-block"> '.$errors->first('first_name').' </p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('last_name')? 'has-error' : '' }}">
                            <label class="control-label">Last Name *</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" />
                            {!! $errors->has('last_name')? '<p class="help-block"> '.$errors->first('last_name').' </p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                            <label class="control-label">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            {!! $errors->has('email')? '<p class="help-block"> '.$errors->first('email').' </p>':'' !!}
                        </div>

                    </div>
                    <div class="col-sm-5">

                        <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}">
                            <label class="control-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            {!! $errors->has('password')? '<p class="help-block"> '.$errors->first('password').' </p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation')? 'has-error' : '' }}">
                            <label class="control-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                            {!! $errors->has('password_confirmation')? '<p class="help-block"> '.$errors->first('password_confirmation').' </p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('mobile_number')? 'has-error' : '' }}">
                            <label class="control-label">Mobile Number</label>
                            <input type="number" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}">
                            {!! $errors->has('mobile_number')? '<p class="help-block"> '.$errors->first('mobile_number').' </p>':'' !!}
                        </div>


                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Signup</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    @endif

            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

@endsection
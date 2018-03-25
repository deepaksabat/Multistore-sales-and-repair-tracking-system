@extends('front.layout')

@section('main')

    <section id="contact-page">
        <div class="container">
            <div class="center">
                <h2>Signup as Shop</h2>
                {{--<p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
            </div>
            <div class="row contact-wrap">
                <div class="status alert alert-success" style="display: none"></div>

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

                    </div>
                    <div class="col-sm-5">

                        <div class="form-group {{ $errors->has('shop_name')? 'has-error' : '' }}">
                            <label class="control-label">Shop Name</label>
                            <input type="text" name="shop_name" class="form-control" value="{{ old('shop_name') }}">
                            {!! $errors->has('shop_name')? '<p class="help-block"> '.$errors->first('shop_name').' </p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('shop_mobile_number')? 'has-error' : '' }}">
                            <label class="control-label">Shop Mobile Number</label>
                            <input type="text" name="shop_mobile_number" class="form-control" value="{{ old('shop_mobile_number') }}">
                            {!! $errors->has('shop_mobile_number')? '<p class="help-block"> '.$errors->first('shop_mobile_number').' </p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('shop_address')? 'has-error' : '' }}">
                            <label class="control-label">Shop Address *</label>
                            <input type="text" name="shop_address" class="form-control"  value="{{ old('shop_address') }}">
                            {!! $errors->has('shop_address')? '<p class="help-block"> '.$errors->first('shop_address').' </p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('bank_details')? 'has-error' : '' }}">
                            <label class="control-label">Bank Details *</label>
                            <textarea name="bank_details" id="message" class="form-control" rows="4">{{ old('bank_details') }}</textarea>
                            {!! $errors->has('bank_details')? '<p class="help-block"> '.$errors->first('bank_details').' </p>':'' !!}
                        </div>


                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Signup</button>
                        </div>
                    </div>
                </form>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

@endsection
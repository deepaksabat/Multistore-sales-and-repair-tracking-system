@extends('front.layout')

@section('main')

    <section id="contact-page">
        <div class="container">
            <div class="center">
                <h2>Sign In</h2>
                {{--<p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
            </div>
            <div class="row contact-wrap">
                <div class="status alert alert-success" style="display: none"></div>

                <div class="col-md-6 col-md-offset-3">
                    @if(session('login_error'))
                        <p class="login-box-msg text-danger">{{ session('login_error') }}</p>
                    @endif
                    @if(session('success'))
                        <p class="login-box-msg text-success">{{ session('success') }}</p>
                    @endif

                    {!! Form::open()  !!}
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error':'' }}">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        {{ $errors->has('email') ? $errors->first('email'): '' }}
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error':'' }}">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        {{ $errors->has('password') ? $errors->first('password'): '' }}
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
                    </form>
                </div>

            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

@endsection
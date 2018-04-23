@extends('layouts.app')

@section('content')

        <div class="row singin-scroll">
            <div class="col-sm-6 col-md-4 col-md-offset-12">
            </div>
            <div class="col-sm-6 col-md-4 col-md-offset-12">
                <img class="profile-img" src="{{ url('image/logo_login.png') }}" alt="">
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="{{ route('login') }}" role="form" id="login-form" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="username" required autofocus>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    <script type="text/javascript">
        function showPassword() {
    
            var key_attr = $('#key').attr('type');
            
            if(key_attr != 'text') {
                
                $('.checkbox').addClass('show');
                $('#key').attr('type', 'text');
                
            } else {
                
                $('.checkbox').removeClass('show');
                $('#key').attr('type', 'password');
                
            }
            
        }
    </script>
@endsection

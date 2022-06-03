@extends('layouts.auth')

@section('content')

<div class="content d-flex justify-content-center align-items-center">

                <!-- Password recovery form -->
                    <form class="login-form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                    <div class="card mb-0">
                        <div class="card-body">
                                
                                @if (session('status'))
                                <div class="alert alert-primary alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                    {{ session('status') }}
                                </div>

                                @endif


                            <div class="text-center mb-3">                                  
                                <img src="{{ url('img/cache/original/logo_light.png')}}" alt="{{ config('app.name', 'Cloud MLM Software') }}" class="" style="height:150px;width:300px;margin-left:8px;">
                                <h5 class="mb-0">Password recovery</h5>
                                <span class="d-block text-muted">We'll send you instructions in email</span>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-group form-group-feedback form-group-feedback-right">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Your email">
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn bg-blue btn-block"><i class="icon-spinner11 mr-2"></i> Reset password</button>
                        </div>
                    </div>
                </form>
                <!-- /password recovery form -->

            </div>

@endsection

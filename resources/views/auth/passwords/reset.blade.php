@extends('layouts.auth')

@section('content')

<div class="content d-flex justify-content-center align-items-center">

                <!-- Password recovery form -->
                    <form class="login-form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">

                    <div class="card mb-0">
                        <div class="card-body">
                                
                                @if (session('status'))
                                <div class="alert alert-primary alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                    {{ session('status') }}
                                </div>

                                @endif


                                

                            <div class="text-center mb-3">
                                <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Password reset</h5>
                                <span class="d-block text-muted">Reset your password</span>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-group form-group-feedback form-group-feedback-right">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Your email">
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-group form-group-feedback form-group-feedback-right">
                                <input id="password" type="password" class="form-control" name="password" value="" required placeholder="New password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock5 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} form-group form-group-feedback form-group-feedback-right">
                                <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" value="" required placeholder="Confirm new password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock5 text-muted"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn bg-blue btn-block"><i class="icon-spinner11 mr-2"></i> Reset password </button>
                        </div>
                    </div>
                </form>
                <!-- /password recovery form -->

            </div>

@endsection


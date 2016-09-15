@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                   <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Link to Social Accounts</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            @if (!$user->isLinkedToSocialLogin('google'))
                                <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-md btn-primary btn-block google" type="submit">Google</a>
                            @else
                                <a href="" class="btn btn-md btn-primary btn-block google" type="submit" disabled>Google</a>
                            @endif
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            @if (!$user->isLinkedToSocialLogin('facebook'))
                                <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-md btn-primary btn-block facebook" type="submit">Facebook</a>
                            @else
                                <a href="" class="btn btn-md btn-primary btn-block facebook" type="submit" disabled>Facebook</a>
                            @endif
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            @if (!$user->isLinkedToSocialLogin('twitter'))
                                <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-md btn-primary btn-block twitter" type="submit">Twitter</a>
                            @else
                                <a href="" class="btn btn-md btn-primary btn-block twitter" type="submit" disabled>Twitter</a>
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin.app')

@section('content')


    <div class="card"  style="float: right; width: 85%;">
        <div class="card-body">
            <form class="row login_form" action="{{route('admin.password.edit')}}"  method="post" id="contactForm" >
                @csrf

                <div class="col-md-12 form-group">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning" role="alert">
                            {{session('error')}}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cтарый пароль</label>
                        <input id="oldPassword" type="password"  placeholder="Cтарый пароль" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" required autocomplete="new-password">

                        @error('oldPassword')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Новый пароль</label>
                        <input id="password" type="password" placeholder="Новый пароль" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <label for="exampleInputPassword1">Повторно новый пароль</label>
                        <input id="password-confirm" type="password"  placeholder="Повторно новый пароль" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-"   style="   background: #0098f0;
                                        background: linear-gradient(
                                        0deg
                                        ,#0098f0,#00f2c3);" >Submit</button>
                </div>
            </form>
        </div>
    </div>


@endsection

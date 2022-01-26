@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Вход</div>

                    <div class="card-body">
                        <form method="POST" action="" id="loginForm">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>

                                <div class="col-md-6">
                                    <input id="username" type="text"
                                           class="form-control" name="username"
                                           value="{{ old('name') }}"  autocomplete="name" autofocus>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control" name="password"
                                            autocomplete="current-password">

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Войти
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script type="text/javascript">

        function showError(text) {
            $('#modalText').html(text);
            $('#modalError').modal('show');
        }

        $('#loginForm').submit(function (e) {
            e.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();

            $.ajax({

                url: "{{route('forteLogin')}}",
                type: "post",
                data: {
                    username: username,
                    password: password,
                    _token: '{{csrf_token()}}'

                },
                success: function (data) {
                    if (data.code == 200) {

                        window.location.href = '/agent-home';

                    } else {
                        showError("Ошибка аунтефикации");
                    }
                }
            })
        });

    </script>


    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p id="modalText" style="color: crimson;"></p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


@endsection

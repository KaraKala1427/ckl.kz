@extends('layouts.admin.app')

@section('content')
    <div class="row" style="float: right; width: 85%;">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Таблица добавления Меню</h4>
                </div>
                <div class="card-body">
                    <div class="" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="" role="document">
                            <div class="">
                                <form action="{{route('admin.menuCreate')}}" method="post">
                                    {{method_field('post')}}
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills" role="tablist">
                                            <li role="presentation" class="nav-item"><a href="#ru" aria-controls="ru" role="tab" data-toggle="tab" class="nav-link active">Русский</a></li>
                                            <li role="presentation" class="nav-item"><a href="#kz" aria-controls="kz" role="tab" data-toggle="tab" class="nav-link">Казахский</a></li>
                                            <li role="presentation" class="nav-item"><a href="#en" aria-controls="en" role="tab" data-toggle="tab" class="nav-link">Английский</a></li>
                                        </ul>
                                        <br>

                                        @csrf
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="ru">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Название</label>
                                                    <input value="" type="text" class="form-control" id="exampleFormControlInput1"  name="name_ru">
                                                    @error('name_ru')
                                                    <small id="emailHelp" class="form-text text-danger">Укажите название</small>
                                                    @enderror
                                                </div>

                                                <input type="hidden"  class="form-control" value="{{$link}}" name="link" >


                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="kz">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Название</label>
                                                    <input value="" type="text" class="form-control" id="exampleFormControlInput1"  name="name_kz">
                                                    @error('name_kz')
                                                    <small id="emailHelp" class="form-text text-danger">Укажите название</small>
                                                    @enderror
                                                </div>
                                                <input type="hidden"  class="form-control" value="{{$link}}" name="link" >

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="en">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Название</label>
                                                    <input value="" type="text" class="form-control" id="exampleFormControlInput1"  name="name_en">
                                                    @error('name_en')
                                                    <small id="emailHelp" class="form-text text-danger">Укажите название</small>
                                                    @enderror
                                                </div>
                                                <input type="hidden"  class="form-control" value="{{$link}}" name="link" >
                                            </div>
                                        </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-"      style="   background: #0098f0;
                                        background: linear-gradient(
                                        0deg
                                        ,#0098f0,#00f2c3);">Добавить запись</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>


@endsection


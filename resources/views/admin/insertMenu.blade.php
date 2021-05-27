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
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleFormControlInput1">Имя</label>--}}
{{--                                            <input value="" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name" name="name_ru">--}}
{{--                                            @error('name_ru')--}}
{{--                                            <small id="emailHelp" class="form-text text-danger">Укажите имя</small>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleFormControlSelect1">Дата</label>--}}
{{--                                            <input value="{{Carbon\Carbon::now()->addHour(6)->format('Y-m-d\TH:i')}}" type="datetime-local" class="form-control" id="exampleFormControlInput1" placeholder="item name" name="dat" style="width:200px">--}}
{{--                                            @error('dat')--}}
{{--                                            <small id="emailHelp" class="form-text text-danger">Выберите дату</small>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}



{{--                                        <input type="hidden"  class="form-control" value="{{$link}}" name="link" >--}}


{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleFormControlTextarea1">Описание</label>--}}
{{--                                            <input  class="form-control" id="descc" name="description_ru" rows="3"></input>--}}

{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleFormControlTextarea1">Заголовок</label>--}}
{{--                                            <input  class="form-control" id="headerr" name="head_ru" rows="3"></input>--}}

{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleFormControlTextarea1">Текст</label>--}}
{{--                                            <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
{{--                                            <script>--}}
{{--                                                window.onload = function () {--}}

{{--                                                    tinymce.init({--}}

{{--                                                        selector: '#textt',--}}
{{--                                                        height: 300,--}}
{{--                                                        plugins: 'image',--}}
{{--                                                        menubar: 'insert',--}}
{{--                                                        toolbar: 'bold italic underline | image',--}}
{{--                                                        image_caption: true,--}}
{{--                                                        file_browser_callback_types: 'file image media',--}}
{{--                                                        file_picker_callback: filemanager.tinyMceCallback,--}}
{{--                                                    });--}}
{{--                                                    // tinymce.init({--}}
{{--                                                    //     selector: 'textarea',  // change this value according to your HTML--}}
{{--                                                    //     file_browser_callback_types: 'file image media'--}}
{{--                                                    // });--}}



{{--                                                };--}}
{{--                                            </script>--}}
{{--                                            <textarea  class="form-control" id="textt" name="tex_ru" rows="3"></textarea>--}}

{{--                                        </div>--}}




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


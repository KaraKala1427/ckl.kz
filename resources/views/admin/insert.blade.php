@extends('layouts.admin.app')
@section('content')
    <div class="row" style="float: right; width: 85%;">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Таблица добавления</h4>
                </div>
                <div class="card-body">
                    <div class="" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="" role="document">
                            <div class="">
                                <form action="{{route('admin.itemInsert')}}" method="post" enctype="multipart/form-data">
                                    {{method_field('post')}}
                                    <div>
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
                                                    <small id="emailHelp" class="form-text text-danger">Укажите имя</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Дата</label>
                                                    <input value="{{(new \Illuminate\Support\Carbon)->format('Y-m-d')}}" type="date" class="form-control" id="exampleFormControlInput1" placeholder="item name" name="dat" style="width:200px">
                                                    @error('dat')
                                                    <small id="emailHelp" class="form-text text-danger">Выберите дату</small>
                                                    @enderror
                                                </div>
                                                <input type="hidden"  class="form-control" value="{{$link}}" name="link" >
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Описание</label>
                                                    <input value="" class="form-control" id="descc" name="description_ru" rows="3">
                                                </div>
                                                <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">{{$isCity ? "Координаты" : "Заголовок"}}</label>
                                                        <input value="" class="form-control" id="headerr" name="head_ru" rows="3">
                                                </div>
                                                <div>
                                                    <label for="img_ru">Картинка </label>
                                                    <input type="file" value="" class="form-control" id="img_ru" name="img_ru" onchange="loadFile(event)" accept="image/*" rows="3">
                                                    <img id="preview" src=""  style="width: 350px; border:1px solid black"/><br><br>
                                                </div>
                                                <div class="form-group">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="showImageInText" id="showImageInText" class="checkbox-cov">
                                                        <span class="checkbox__label">Показать в тексте</span>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <select name="showThumb" id="showThumb" class="field input-check">
                                                        <option value="0">Не показывать на обложке</option>
                                                        <option value="1">Показывать маленькой на обложке</option>
                                                        <option value="2">Показывать большой на обложке</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текст</label>
                                                    <textarea  class="form-control" id="textt" name="tex_ru" rows="3"></textarea>

                                                    <script src="{{asset('filemanager2/js/tinymce/tinymce.min.js')}}" ></script>
                                                    {{--                                                    <script src="//cdn.tinymce.com/4/tinymce.min.js" ></script>--}}
                                                    <script>
                                                        window.onload = function () {

                                                            tinymce.init({
                                                                height: 300,
                                                                mode : "textareas",
                                                                plugins: "link image table",
                                                                menubar: 'insert table' ,
                                                                toolbar: 'bold italic underline | link | image',
                                                                image_caption: true,
                                                                file_browser_callback_types: 'file image media',
                                                                file_picker_callback: filemanager.tinyMceCallback,
                                                            });
                                                        };

                                                    </script>


                                                </div>

                                            </div>
                                        <div role="tabpanel" class="tab-pane" id="kz">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Название</label>
                                                <input value="" type="text" class="form-control" id="exampleFormControlInput1"  name="name_kz">
                                                @error('name_kz')
                                                <small id="emailHelp" class="form-text text-danger">Укажите имя</small>
                                                @enderror
                                            </div>
                                            <input type="hidden"  class="form-control" value="{{$link}}" name="link" >
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Описание</label>
                                                <input value="" class="form-control" id="descc" name="description_kz" rows="3">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">{{$isCity ? "Координаты" : "Заголовок"}}</label>
                                                <input value="" class="form-control" id="headerr" name="head_kz" rows="3">
                                            </div>
                                            <div>
                                                <label for="img_kz">Картинка </label>
                                                <input type="file" value="" class="form-control" id="img_kz" name="img_kz" onchange="loadFileKz(event)" accept="image/*" rows="3">
                                                <img id="previewkz" src=""  style="width: 300px; height: 300px;"/><br><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Текст</label>
                                                <textarea  class="form-control" id="textt" name="tex_kz" rows="3"></textarea>

                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="en">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Название</label>
                                                <input value="" type="text" class="form-control" id="exampleFormControlInput1"  name="name_en">
                                                @error('name_en')
                                                <small id="emailHelp" class="form-text text-danger">Укажите имя</small>
                                                @enderror
                                            </div>
                                            <input type="hidden"  class="form-control" value="{{$link}}" name="link" >
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Описание</label>
                                                <input value="" class="form-control" id="descc" name="description_en" rows="3">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">{{$isCity ? "Координаты" : "Заголовок"}}</label>
                                                <input value="" class="form-control" id="headerr" name="head_en" rows="3">

                                            </div>
                                            <div>
                                                <label for="img_en">Картинка </label>
                                                <input type="file" value="" class="form-control" id="img_en" name="img_en" onchange="loadFileEn(event)" accept="image/*" rows="3">
                                                <img id="previewen" src=""  style="width: 300px; height: 300px;"/><br><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Текст</label>
                                                <textarea  class="form-control" id="textt" name="tex_en" rows="3"></textarea>
                                            </div>
                                        </div>
                                        </div>

                                    </div>
                                    <div class="">

                                        <button type="submit" class="btn btn-" style="   background: #0098f0;
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

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        var loadFileKz = function(event) {
            var outputKz = document.getElementById('previewkz');
            outputKz.src = URL.createObjectURL(event.target.files[0]);
            outputKz.onload = function() {
                URL.revokeObjectURL(outputKz.src) // free memory
            }
        };

        var loadFileEn = function(event) {
            var outputEn = document.getElementById('previewen');
            outputEn.src = URL.createObjectURL(event.target.files[0]);
            outputEn.onload = function() {
                URL.revokeObjectURL(outputEn.src) // free memory
            }
        };
    </script>


@endsection


@extends('layouts.admin.app')

@section('content')


    <div class="row" style="float: right; width: 85%;">
        <div class="col-lg-12 col-md-12">
            @if(session('success'))
                <div class="text-center alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Table</h4>
                </div>
                <div class="card-body">
                    <div class="" id="updateItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="" role="document">
                            <div class="">

                                <form action="{{ route('admin.itemUpdate', $article->id) }}" method="post" enctype="multipart/form-data">
                                    {{method_field('put')}}
                                    <div>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills" role="tablist">
                                            <li role="presentation" class="nav-item"><a href="#ru" aria-controls="ru" role="tab" data-toggle="tab" class="nav-link active">Русский</a></li>
                                            <li role="presentation" class="nav-item"><a href="#kz" aria-controls="kz" role="tab" data-toggle="tab" class="nav-link">Казахский</a></li>
                                            <li role="presentation" class="nav-item"><a href="#en" aria-controls="en" role="tab" data-toggle="tab" class="nav-link">Английский</a></li>
                                        </ul>
                                        <br>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="ru">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Название</label>
                                                    <input value="{{$article->name_ru}}" type="text" class="form-control" id="exampleFormControlInput1"  name="name_ru">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Дата</label>
                                                    <input value="{{(new \Illuminate\Support\Carbon($article->dat))->format('Y-m-d')}}" type="date" class="form-control" id="exampleFormControlInput1" placeholder="item name" name="dat" style="width:200px">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Description</label>
                                                    <input value="{{$article->description_ru}}" class="form-control" id="descc" name="description_ru" rows="3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">{{$isCity ? "Координаты" : "Заголовок"}}</label>
                                                    <input value="{{$article->head_ru}}" class="form-control" id="headerr" name="head_ru" rows="3">

                                                </div>
                                                <div>
                                                    <label for="img_ru">Картинка </label>
                                                    <input type="file" value="" class="form-control" id="img_ru" name="img_ru" onchange="loadFile(event)" accept="image/*" rows="3">
                                                    <img id="preview" src="{{ asset("storage/".$article->img_ru)}}"  style="width: 350px; border:1px solid black"/><br><br>
                                                </div>
                                                <div class="form-group">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="showImageInText" id="showImageInText" class="checkbox-cov" @if($article->show_image_in_text == 'on') checked @endif>
                                                        <span class="checkbox__label">Показать в тексте</span>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <select name="showThumb" id="showThumb" class="field input-check">
                                                        <option value="0" {{ "0" == ($article->show_thumb ?? '') ? 'selected' : ''}}>Не показывать на обложке</option>
                                                        <option value="1" {{ "1" == ($article->show_thumb ?? '') ? 'selected' : ''}}>Показывать маленькой на обложке</option>
                                                        <option value="2" {{ "2" == ($article->show_thumb ?? '') ? 'selected' : ''}}>Показывать большой на обложке</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текст</label>
                                                    <textarea  class="form-control" id="textt" name="tex_ru" rows="3">{{$article->tex_ru}}</textarea>

{{--                                                    <script src="https://cdn.tiny.cloud/1/o65lxpcmzh1b9m7amf72e0rvw485mdj8m5y6reaoe65r8z35/tinymce/5/tinymce.min.js"  referrerpolicy="origin"></script>--}}
                                                    <script src="{{asset('filemanager2/js/tinymce/tinymce.min.js')}}" ></script>
                                                    <script>
                                                        window.onload = function () {
                                                            tinymce.init({
                                                                height: 250,
                                                                mode : "textareas",
                                                                plugins: "link image code table",
                                                                menubar: 'insert tools table',
                                                                toolbar: 'bold italic underline | link | image code | copy aligncenter alignjustify alignleft alignnone alignright',
                                                                image_caption: true,
                                                                file_browser_callback_types: 'file image media',
                                                                file_picker_callback: filemanager.tinyMceCallback,
                                                            });
                                                        };
                                                    </script>


                                                </div>
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="exampleFormControlTextarea1">Изображение</label>--}}
{{--                                                    <input value="{{$article->img_ru}}" class="form-control" id="imgru" name="img_ru" rows="3" style="width:350px">--}}
{{--                                                    <a data-toggle="modal"  href="javascript:;" data-target="#myModalf" class="btn" type="button">Изображение</a>--}}
{{--                                                </div>--}}

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="kz">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Название</label>
                                                    <input value="{{$article->name_kz}}" type="text" class="form-control" id="exampleFormControlInput1"  name="name_kz" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Description</label>
                                                    <input value="{{$article->description_kz}}" class="form-control" id="descc" name="description_kz" rows="3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">{{$isCity ? "Координаты" : "Заголовок"}}</label>
                                                    <input value="{{$article->head_kz}}" class="form-control" id="headerr" name="head_kz" rows="3">

                                                </div>
                                                <div>
                                                    <label for="img_kz">Картинка </label>
                                                    <input type="file" value="" class="form-control" id="img_kz" name="img_kz" onchange="loadFileKz(event)" accept="image/*" rows="3">
                                                    <img id="previewkz" src="{{ asset("storage/".$article->img_kz)}}"  style="width: 300px; height: 300px;"/><br><br>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текст</label>
                                                    <textarea  class="form-control" id="" name="tex_kz" rows="3">{{$article->tex_kz}}</textarea>

                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="en">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Название</label>
                                                    <input value="{{$article->name_en}}" type="text" class="form-control" id="exampleFormControlInput1" name="name_en">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Description</label>
                                                    <input value="{{$article->description_en}}" class="form-control" id="descc" name="description_en" rows="3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">{{$isCity ? "Координаты" : "Заголовок"}}</label>
                                                    <input value="{{$article->head_en}}" class="form-control" id="headerr" name="head_en" rows="3">

                                                </div>
                                                <div>
                                                    <label for="img_en">Картинка </label>
                                                    <input type="file" value="" class="form-control" id="img_en" name="img_en" onchange="loadFileEn(event)" accept="image/*" rows="3">
                                                    <img id="previewen" src="{{ asset("storage/".$article->img_en)}}"  style="width: 300px; height: 300px;"/><br><br>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текст</label>

                                                    <textarea  class="form-control" id="" name="tex_en" rows="3">{{$article->tex_en}}</textarea>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="" style=" display: none">
                                        <label for="exampleFormControlInput1">Id</label>
                                        <h5 class="" id="exampleModalLabel">
                                            <input value="{{$article->id}}" disabled class="form-control" id="exampleFormControlInput1" placeholder="item name" name="id" style="width: 80px;">
                                        </h5>

                                    </div>


                                    <div class="">
                                        <button type="submit" class="btn btn-"      style="   background: #0098f0;
                                        background: linear-gradient(
                                        0deg
                                        ,#0098f0,#00f2c3);"  >Сохранить изменения</button>
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

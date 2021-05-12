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

                                <form action="{{ route('admin.itemUpdate', $article->id) }}" method="post">
                                    {{method_field('put')}}
                                    <div>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills" role="tablist">
                                            <li role="presentation" class="nav-item"><a href="#ru" aria-controls="ru" role="tab" data-toggle="tab" class="nav-link active">Русский</a></li>
                                            <li role="presentation" class="nav-item"><a href="#kz" aria-controls="kz" role="tab" data-toggle="tab" class="nav-link">Казахский</a></li>
                                            <li role="presentation" class="nav-item"><a href="#en" aria-controls="en" role="tab" data-toggle="tab" class="nav-link">Английский</a></li>
                                        </ul>

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
                                                    <label for="exampleFormControlTextarea1">Заголовок</label>
                                                    <input value="{{$article->head_ru}}" class="form-control" id="headerr" name="head_ru" rows="3">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текст</label>
                                                    <script src="https://cdn.tiny.cloud/1/o65lxpcmzh1b9m7amf72e0rvw485mdj8m5y6reaoe65r8z35/tinymce/5/tinymce.min.js"  referrerpolicy="origin"></script>
{{--                                                    <script src="//cdn.tinymce.com/4/tinymce.min.js" ></script>--}}
                                                    <script>
                                                        window.onload = function () {

                                                            tinymce.init({
                                                                height: 300,
                                                                mode : "textareas",
                                                                plugins: 'link image ',
                                                                menubar: 'insert',
                                                                toolbar: 'bold italic underline |link  | image',
                                                                image_caption: true,
                                                                file_browser_callback_types: 'file image media',
                                                                file_picker_callback: filemanager.tinyMceCallback,
                                                            });

                                                        };

                                                    </script>
                                                    <textarea  class="form-control" id="textt" name="tex_ru" rows="3">{{$article->tex_ru}}</textarea>

                                                </div>

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="kz">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Название</label>
                                                    <input value="{{$article->name_kz}}" type="text" class="form-control" id="exampleFormControlInput1"  name="name_kz">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Дата</label>
                                                    <input value="{{(new \Illuminate\Support\Carbon($article->dat))->format('Y-m-d')}}" type="date" class="form-control" id="exampleFormControlInput1" placeholder="item name" name="dat" style="width:200px">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Description</label>
                                                    <input value="{{$article->description_kz}}" class="form-control" id="descc" name="description_kz" rows="3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Заголовок</label>
                                                    <input value="{{$article->head_kz}}" class="form-control" id="headerr" name="head_kz" rows="3">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текст</label>
{{--                                                    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
                                                    <script>
                                                        // window.onload = function () {
                                                        //
                                                        //     tinymce.init({
                                                        //         height: 300,
                                                        //         mode : "textareas",
                                                        //         plugins: 'image',
                                                        //         menubar: 'insert',
                                                        //         toolbar: 'bold italic underline | image',
                                                        //         image_caption: true,
                                                        //         file_browser_callback_types: 'file image media',
                                                        //         file_picker_callback: filemanager.tinyMceCallback,
                                                        //     });
                                                        //
                                                        // };
                                                    </script>
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
                                                    <label for="exampleFormControlSelect1">Дата</label>
                                                    <input value="{{(new \Illuminate\Support\Carbon($article->dat))->format('Y-m-d')}}" type="date" class="form-control" id="exampleFormControlInput1" placeholder="item name" name="dat" style="width:200px">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Description</label>
                                                    <input value="{{$article->description_en}}" class="form-control" id="descc" name="description_en" rows="3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Заголовок</label>
                                                    <input value="{{$article->head_en}}" class="form-control" id="headerr" name="head_en" rows="3">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текст</label>
{{--                                                    <script src="https://cdn.tiny.cloud/1/o65lxpcmzh1b9m7amf72e0rvw485mdj8m5y6reaoe65r8z35/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
                                                    <script>
                                                        // window.onload = function () {
                                                        //
                                                        //     tinymce.init({
                                                        //         height: 300,
                                                        //         mode : "textareas",
                                                        //         plugins: 'image imagetools, jbimages, code, table, paste, link',
                                                        //         menubar: 'insert',
                                                        //         toolbar: 'bold italic underline | image',
                                                        //         image_caption: true,
                                                        //         file_browser_callback_types: 'file image media',
                                                        //         file_picker_callback: filemanager.tinyMceCallback,
                                                        //     });
                                                        //
                                                        // };
                                                    </script>
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


@endsection

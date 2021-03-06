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
                                    <div class="">
                                        <label for="exampleFormControlInput1">Id</label>
                                        <h5 class="" id="exampleModalLabel">
                                            <input value="{{$article->id}}" disabled class="form-control" id="exampleFormControlInput1" placeholder="item name" name="id" style="width: 80px">
                                        </h5>

                                    </div>

                                    <div class="">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Name</label>
                                            <input value="{{$article->name_ru}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="item name" name="name_ru">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">????????</label>
                                            <input value="{{(new \Illuminate\Support\Carbon($article->dat))->format('Y-m-d')}}" type="date" class="form-control" id="exampleFormControlInput1" placeholder="item name" name="dat" style="width:200px">

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <input value="{{$article->description_ru}}" class="form-control" id="descc" name="description_ru" rows="3">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">??????????????????</label>
                                            <input value="{{$article->head_ru}}" class="form-control" id="headerr" name="head_ru" rows="3">

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">??????????</label>
                                            <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
                                            <script>
                                                window.onload = function () {

                                                    tinymce.init({

                                                        selector: '#textt',
                                                        height: 300,
                                                        plugins: 'image',
                                                        menubar: 'insert',
                                                        toolbar: 'bold italic underline | image',
                                                        image_caption: true,
                                                        file_browser_callback_types: 'file image media',
                                                        file_picker_callback: filemanager.tinyMceCallback,
                                                    });
                                                    // tinymce.init({
                                                    //     selector: 'textarea',  // change this value according to your HTML
                                                    //     file_browser_callback_types: 'file image media'
                                                    // });



                                                };
                                            </script>
                                            <textarea  class="form-control" id="textt" name="tex_ru" rows="3">{{$article->tex_ru}}</textarea>

                                        </div>



                                    </div>
                                    <div class="">

                                        <button type="submit" class="btn btn-"      style="   background: #0098f0;
                                        background: linear-gradient(
                                        0deg
                                        ,#0098f0,#00f2c3);"  >?????????????????? ??????????????????</button>



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

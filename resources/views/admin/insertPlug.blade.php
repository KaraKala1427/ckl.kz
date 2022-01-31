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
                                <form action="{{route('admin.plug-covid-post', $article->id)}}" method="post" enctype='multipart/form-data'>
                                    {{method_field('post')}}
                                    <div>
                                        @csrf
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="ru">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="showImageInText" id="showImageInText" class="checkbox-cov">
                                                        <span class="checkbox__label">Включить заглушку</span>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <select name="showThumb" id="showThumb" class="field input-check">
                                                        <option value="0">ЕСБД временно не работает, попробуйте позже</option>
                                                        <option value="1">Сервер временно не работает, попробуйте позже</option>
                                                        <option value="2">КИАС временно не работает, попробуйте позже</option>
{{--                                                        <option value="0">{{__('navbar.plug_text_esbd')}}</option>--}}
{{--                                                        <option value="1">{{__('navbar.plug_text_server')}}</option>--}}
{{--                                                        <option value="2">{{__('navbar.plug_text_kias')}}</option>--}}
                                                    </select>
                                                </div>
                                            </div>
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


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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="text-right">
                            @if(!empty($link1))
                                <a href="{{route('admin.menu.add',["link" => $link1])}}" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                                    <i class="tim-icons icon-simple-add"></i>
                                </a>
                            @endif

                        </div>
                        <thead class=" text-primary">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($child_menus as $menu)
                                <tr>
                                    <td class="text-center">{{$menu->orderid}}</td>
                                    <td>{{$menu->name_ru}}</td>
                                    <td class="td-actions text-right">

{{--                                        <a href="{{route('admin.one.menu.edit', ["link"=>$article->raz,'id'=>$article->id])}}" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">--}}
{{--                                        <a href="" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">--}}
{{--                                            <i class="tim-icons icon-settings"></i>--}}

{{--                                        </a>--}}

                                        <a href="{{route('admin.menu.delete', ["link"=>$link1,"id"=>$menu->id])}}" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </thead>

                    </div>
                </div>

            </div>


        </div>

    </div>


@endsection

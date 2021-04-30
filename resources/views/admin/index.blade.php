@extends('layouts.admin.app')

@section('content')
    <div class="row" style="float: right; width: 85%;">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <thead class=" text-primary">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th class="text-right">Created</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td class="text-center">{{$article->orderid}}</td>
                                <td>{{$article->name_ru}}</td>
                                <td>{{$article->pubdat}}</td>
{{--                                <td class="text-right"></td>--}}
                                <td class="td-actions text-right">

                                    <a href="{{route('admin.one.menu.edit', ["link"=>$article->raz,'id'=>$article->id])}}" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                                        <i class="tim-icons icon-settings"></i>

                                    </a>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                                        <i class="tim-icons icon-simple-remove"></i>
                                    </button>
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

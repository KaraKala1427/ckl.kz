@extends('layouts.admin.app', ['menu' => $menu])

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
                                <a href="{{route('admin.one.menu.add',["link" => $link1])}}" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
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
                                <th class="text-right">Created</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td class="text-center">{{$article->orderid}}</td>
                                    <td>{{$article->name_ru}}</td>
                                    <td>{{$article->dat}}</td>
                                    {{--                                <td class="text-right"></td>--}}
                                    <td class="td-actions text-right">

                                        <a href="{{route('admin.one.menu.edit', ["link"=>$article->raz,'id'=>$article->id])}}" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                                            <i class="tim-icons icon-settings"></i>

                                        </a>

                                        <form method="post" action="{{url('/admin/link/' . $article->id)}}">

                                            @csrf
                                            {{method_field('delete')}}

                                            <button type="submit" onclick="return confirm('Вы уверенны?')" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm">
                                                <i class="tim-icons icon-simple-remove"></i>
                                            </button>
                                        </form>
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

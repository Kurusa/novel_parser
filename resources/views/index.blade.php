@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <form method="post" action="{{route('parse-novel')}}">
                    @csrf
                    <div class="form-group">
                        <input id="novel_url" type="text" class="form-control" name="novel_url" required
                               placeholder="Введите url новеллы">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary parse-button" disabled>@lang('Спарсить')</button>
                    </div>
                </form>
            </div>
        </div>

        @isset($success)
            <div class="novel">
                <h4 id="novel-title">{{$title}}</h4>
                <div id="accordion">
                    @foreach($volumes_data as $key => $volume)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseVolume-{{$key}}" aria-expanded="true">
                                        {{$volume['title']}}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseVolume-{{$key}}" class="collapse show" aria-labelledby="headingOne">
                                <div class="card-body">
                                    {{$volume['context']}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endisset

    </div>
@endsection

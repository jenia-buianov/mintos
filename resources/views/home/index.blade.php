@extends('layouts.app')

@section('title') Feed @endsection

@section('content')
    <h2>Words</h2>
    <div id="words" class="words content-block">
        <words :check_url="{{json_encode(route('words'))}}" inline-template>
            <div class="row">
                <div class="bg-info text-center col-12" style="color:white" v-if="loaded == false">
                    Loading....
                </div>
                <div v-else v-for="(word, index) in words" class="col-md-2">
                    @{{ word.word }}
                    <span class="badge badge-success">@{{ word.count }}</span>
                </div>
            </div>
        </words>
    </div>
    <h2>Feed</h2>
    <div class="content-block feed">
        <div class="row">
        @foreach($feed as $i=>$item)
            <?php if ($i%3==0) echo '</div><div class="row">';  ?>
            <div class="col-md-4 box-shadow">
                <a href="{{$item['link']['@attributes']['href']}}" target="_blank" class="text-info">{{$item['title']}}</a>
                <div class="description">
                    {!! $item['summary'] !!}
                </div>
                <div class="date p-right">
                    {{date('d.m.Y H:i',strtotime($item['updated']))}}
                </div>
                <div class="author">
                    <a href="{{$item['author']['uri']}}" target="_blank">{{$item['author']['name']}}</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/home.js')}}"></script>
@endsection

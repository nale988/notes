@extends('layouts.app')
@section('content')
<div class="content">
    <div class="px-card py-10 border-bottom">
    <h2 class="content-title">
        <span class="float-left">
            {{ $note -> title }}
        </span>
        <span class="float-right text-muted font-size-12">
            <small>{{ date('d. m. Y. H:i', strtotime($note -> updated_at)) }}</small>&nbsp;&nbsp;&nbsp;
            <a href="{{ route('edit', [$note -> id, $type])}}"  data-placement="left" data-toggle="tooltip" data-title="Uredi" data-target-breakpoint="md" >
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-down-right" fill="black" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.636 12.5a.5.5 0 0 1-.5.5H1.5A1.5 1.5 0 0 1 0 11.5v-10A1.5 1.5 0 0 1 1.5 0h10A1.5 1.5 0 0 1 13 1.5v6.636a.5.5 0 0 1-1 0V1.5a.5.5 0 0 0-.5-.5h-10a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h6.636a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M16 15.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h3.793L6.146 6.854a.5.5 0 1 1 .708-.708L15 14.293V10.5a.5.5 0 0 1 1 0v5z"/>
                </svg>
            </a>
        </span>
    </h2>
    </div>

    <div class="px-car py-10 pl-10 pr-10 border-bottom">
        <div class="text-right">
            <span class="badge-group" role="group" aria-label="Badge group example">
            @foreach($note_tags as $tag)
                <span class="badge badge-primary">{{ $tag -> tag }}</span>
            @endforeach
            </span>
        </div>
    </div>

    <div class="px-car py-10 pl-10 pr-10">
        <pre style="overflow-x:auto;">
            <code class="{{ $note -> language }}">
            {!! $note -> note !!}
            </code>
        </pre>
    </div>

    <div class="px-car py-10 pl-10 pr-10 border-top">
        <div class="text-right">Verzije:
            <div class="btn-group btn-group-sm" role="group" aria-label="Large button group">
                @if($type == 1)
                    @foreach($versions as $version)
                    @if($loop->last)
                        <a class="btn btn-primary" href="{{ route('show', [$version -> id, 2]) }}"><strong>{{$version -> version}}</strong></a>
                    @else
                        <a class="btn" href="{{ route('show', [$version -> id, 2]) }}">{{$version -> version}}</a>
                    @endif
                    @endforeach
                @else
                    @foreach($versions as $version)
                    @if($version -> id == $note -> id)
                        <a class="btn" href="{{ route('show', [$version -> id, 2]) }}"><strong>{{$version -> version}}</strong></a>
                    @else
                        <a class="btn" href="{{ route('show', [$version -> id, 2]) }}">{{$version -> version}}</a>
                    @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>


    </div>
  </div>
@endsection

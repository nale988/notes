@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-light">
        <span class="float-left"><strong>{{ $note -> title }}</strong> </span>
        <span class="float-right">
            <small>{{ date('d. m. Y. H:i', strtotime($note -> updated_at)) }}</small>&nbsp;&nbsp;&nbsp;
            <a href="{{ route('edit', [$note -> id, $type])}}">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-down-right" fill="black" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.636 12.5a.5.5 0 0 1-.5.5H1.5A1.5 1.5 0 0 1 0 11.5v-10A1.5 1.5 0 0 1 1.5 0h10A1.5 1.5 0 0 1 13 1.5v6.636a.5.5 0 0 1-1 0V1.5a.5.5 0 0 0-.5-.5h-10a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h6.636a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M16 15.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h3.793L6.146 6.854a.5.5 0 1 1 .708-.708L15 14.293V10.5a.5.5 0 0 1 1 0v5z"/>
            </svg>
            </a>
        </span>
    </div>
    <div class="card-body"><pre class="pre-scrollable">{!! $note -> note !!}</pre></div>
    <div class="card-footer bg-light">
        <div class="row">
            <div class="col">
                @foreach($note_tags as $tag)
                    <span class="badge badge-pill badge-primary">{{ $tag -> tag }}</span>
                @endforeach
            </div>
            <div class="col">
            </div>
            <div class="col text-right">
                <small>Ver:&nbsp;</small>
                @if($type == 1)
                @foreach($versions as $version)
                    @if($loop->last)
                        <a href="{{ route('show', [$version -> id, 2]) }}" class="badge badge-danger" title="{{ date('d. m. Y. H:i', strtotime($version -> created_at)) }}">
                    @else
                        <a href="{{ route('show', [$version -> id, 2]) }}" class="badge badge-light" title="{{ date('d. m. Y. H:i', strtotime($version -> created_at)) }}">
                    @endif
                        {{$version -> version}}
                    </a>
                @endforeach
                @else
                    @foreach($versions as $version)
                        @if($version -> id == $note -> id)
                            <a href="{{ route('show', [$version -> id, 2]) }}" class="badge badge-danger" title="{{ date('d. m. Y. H:i', strtotime($version -> created_at)) }}">
                                {{$version -> version}}
                            </a>
                        @else
                            <a href="{{ route('show', [$version -> id, 2]) }}" class="badge badge-light" title="{{ date('d. m. Y. H:i', strtotime($version -> created_at)) }}">
                                {{$version -> version}}
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-light">
        <span class="float-left">
            @isset($favorite)
            <a href="{{ route('favorite', $note -> id) }}" style="text-decoration: none;">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4 0a2 2 0 0 0-2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4zm4.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z"/>
                </svg>
            </a>
            @endisset

            @empty($favorite)
            <a href="{{ route('favorite', $note -> id) }}" style="text-decoration: none;">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z"/>
                </svg>
            </a>
            @endempty
            <strong>{{ $note -> title }}</strong>
        </span>
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

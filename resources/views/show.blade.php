@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-light">
        <div class="row">
            <div class="col">
                <strong>{{ $note -> title }}</strong><small class="text-muted">&nbsp;&nbsp;{{ date('d. m. Y. H:i', strtotime($note -> updated_at)) }}</small>
            </div>
            <div class="col-2 text-right mr-3 pr-3">
                <div class="dropdown">
                    <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opcije
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('edit', [$note -> id, $type])}}">Uredi</a>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" data-toggle="modal" data-target="#deleteOldVersions">Obriši stare verzije</button>
                        <button class="dropdown-item" data-toggle="modal" data-target="#deleteNote">Obriši</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-left">
            @foreach($note_tags as $tag)
                <span class="badge badge-pill badge-info">{{ $tag -> tag }}</span>
            @endforeach
            </div>
        </div>
    </div>
    <div class="card-body"><pre class="pre-scrollable"><code class="{{ $note -> language }}">{!! $note -> note !!}</code></pre></div>
    <div class="card-footer bg-light">
        <div class="row">
            <div class="col text-left">
                <small class="text-muted">Jezik: <strong>{{ $note -> language }}</strong></small>

            </div>
            <div class="col text-right">
                <small>Ver:&nbsp;</small>
                @if($type == 1)
                @foreach($versions as $version)
                    @if($loop->last)
                        <a href="{{ route('show', [$version -> id, 2]) }}" class="badge badge-primary" title="{{ date('d. m. Y. H:i', strtotime($version -> created_at)) }}">
                    @else
                        <a href="{{ route('show', [$version -> id, 2]) }}" class="badge badge-light" title="{{ date('d. m. Y. H:i', strtotime($version -> created_at)) }}">
                    @endif
                        {{$version -> version}}
                    </a>
                @endforeach
                @else
                    @foreach($versions as $version)
                        @if($version -> id == $note -> id)
                            <a href="{{ route('show', [$version -> id, 2]) }}" class="badge badge-primary" title="{{ date('d. m. Y. H:i', strtotime($version -> created_at)) }}">
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

<div class="modal fade" id="deleteNote" tabindex="-1" role="dialog" aria-labelledby="modalDeleteNote" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteNoteTitle">Obrisati?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Potpuno obrisati: <strong>{{ $note -> title }}</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Zatvori</button>
          <button type="button" class="btn btn-primary btn-sm">Obriši</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="deleteOldVersions" tabindex="-1" role="dialog" aria-labelledby="modalDeleteOldVersion" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteOldVersionsTitle">Obriši stare verzije</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Pronađeno {{ count($versions)}} - obrisati ih?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Zatvori</button>
          <button type="button" class="btn btn-primary btn-sm">Obriši</button>
        </div>
      </div>
    </div>
</div>
@endsection

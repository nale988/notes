<ul class="list-group">
    @if(count($favorites) > 0)
    <li class="list-group-item list-group-item-action list-group-item-primary">
        <a data-toggle="collapse" style="text-decoration: none; color: #000;" href="#cFavoriteNotes" role="button" aria-expanded="false" aria-controls="cFavoriteNotes">
            <div class="d-flex justify-content-between align-items-center">
                Favorites
                <span  class="badge badge-primary badge-pill">{{ count($favorites) }}</span>
            </div>
        </a>

        <div class="collapse" id="cFavoriteNotes">
            <ul class="list-unstyled">
                @foreach($favorites as $note)
                <li>
                    <a class="btn btn-link" style="color: #000;" href="{{ route('show', [$note -> notes -> id, 1]) }}" title="{{ $note -> title }}">
                        <span class="text-truncate ">{{ $note -> notes -> title}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </li>
    @endif


    @foreach($tags as $tag)
    @if(count($tag -> notes) > 0)
    <li class="list-group-item list-group-item-action list-group-item-light">
        <a data-toggle="collapse" style="text-decoration: none; color: #000;" href="#c{{ preg_replace('/[^a-z0-9.]+/i', '-', $tag -> tag) }}" role="button" aria-expanded="false" aria-controls="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $tag -> tag) }}">
        <div class="d-flex justify-content-between align-items-center">
                {{ $tag -> tag }}
                <span  class="badge badge-primary badge-pill">{{ count($tag -> notes) }}</span>
            </div>
        </a>

        <div class="collapse" id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $tag -> tag) }}">
            <ul class="list-unstyled">
                @foreach($tag -> notes as $note)
                <li>
                    <a class="btn btn-link" href="{{ route('show', [$note -> id, 1]) }}" title="{{ $note -> title }}">
                        {{-- @if(strlen($note -> title) > 20)
                        {{ substr($note -> title, 0, 20) }}...
                        @else
                        {{ $note -> title}}
                        @endif --}}
                        <span class="text-truncate ">{{ $note -> title}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </li>
    @endforeach
</ul>

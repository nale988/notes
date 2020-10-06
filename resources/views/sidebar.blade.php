<ul class="list-group">
    @foreach($tags as $tag)
    @isset($tag)
        @if(count($tag -> notes) > 0)
            <li class="list-group-item list-group-item-action" id="tag{{ preg_replace('/[^a-z0-9.]+/i', '-', $tag -> tag) }}">
            <a data-toggle="collapse" style="text-decoration: none; color: #000;" href="#c{{ preg_replace('/[^a-z0-9.]+/i', '-', $tag -> tag) }}" role="button" aria-expanded="false" aria-controls="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $tag -> tag) }}">
            <div class="d-flex justify-content-between align-items-center">
                @if($tag -> tag == "#important")
                    <span class="text-danger"><strong>{{ $tag -> tag }}</strong></span>
                @elseif($tag -> tag == "#favorite")
                    <span class="text-primary"><strong>{{ $tag -> tag }}</strong></span>
                @elseif($tag -> tag == "#todo")
                    <span class="text-info"><strong>{{ $tag -> tag }}</strong></span>
                @else
                <span class="text-muted">{{ $tag -> tag }}</span>
                @endif

                <span  class="badge badge-primary badge-pill">{{ count($tag -> notes) }}</span>
            </div>
            </a>

            <div class="collapse" id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $tag -> tag) }}">
                <ul class="list-unstyled">
                    @foreach($tag -> notes as $note)
                    <li>
                        <a class="btn btn-link" href="{{ route('show', [$note -> id, 1]) }}" title="{{ $note -> title }}">
                            <span class="text-truncate ">{{ $note -> title}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </li>
    @endisset
    @endforeach
</ul>

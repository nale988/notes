<ul class="list-group">
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
                    <a class="badge badge-primary" href="{{ route('show', [$note -> id, 1]) }}" title="{{ $note -> title }}">
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

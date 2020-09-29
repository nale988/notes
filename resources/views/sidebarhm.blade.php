<div class="collapse-group">
@foreach($tags as $tag)
    @isset($tag)
    @if(count($tag -> notes) > 0)
        <details class="collapse-panel"> <!-- w-400 = width: 40rem (400px), mw-full = max-width: 100% -->
            <summary class="collapse-header">
                @if($tag -> tag === '#important')
                    <span class="text-danger"><strong>{{ $tag -> tag }}</strong></span>
                @elseif($tag -> tag === '#favorite')
                    <span class="text-primary"><strong>{{ $tag -> tag }}</strong></span>
                @elseif($tag -> tag === '#todo')
                    <span class="text-success"><strong>{{ $tag -> tag }}</strong></span>
                @else
                    <span>{{ $tag -> tag }}</span>
                @endif
                <span class="float-right badge badge-primary badge-pill">{{ count($tag -> notes)}}</span>
            </summary>
            <div class="collapse-content">
                <ul>
                @foreach($tag -> notes as $note)
                    <li>
                        <a class="hyperlink" href="{{ route('show', [$note -> id, 1]) }}" title="{{ $note -> title }}">{{ $note -> title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </details>
    @endif
    @endisset
@endforeach
</div>

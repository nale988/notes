{{-- @if(!empty($notes))
    @foreach($notes as $title => $note)
        {{ $title }}
        @foreach($note as $noteitem)
        <a href="{{ route('show', $noteitem -> id)}}">
            {{ $noteitem -> title }}
        </a>
        @endforeach
    @endforeach
@endif --}}

@if(!empty($categories))
    @foreach($categories as $category)
    <a class="text-white dropdown-toggle" data-toggle="collapse" href="#c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category) }}" role="button" aria-expanded="false" aria-controls="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category) }}">
        {{ $category -> description }}
    </a>

    <div class="collapse" id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category) }}">
        @foreach($category -> notes as $note)
            {{ $note -> title }}
        @endforeach
    </div>
    @endforeach
@endif

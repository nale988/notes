@if(!empty($categories))
    @foreach($categories as $category)
    <a class="dropdown-toggle" data-toggle="collapse" style="text-decoration: none; color: #000;" href="#c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category->description) }}" role="button" aria-expanded="false" aria-controls="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category->description) }}">
        {{ $category -> description }}
        <span class="badge badge-pill badge-danger">{{ count($category -> notes) }}</span>
    </a>

    <div class="collapse" id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category->description) }}">
        <ul class="list-unstyled">
        @foreach($category -> notes as $note)
            <li>
                <a href="{{ route('show', $note -> id) }}" >
                    &#9900; {{ $note -> title }}
                </a>
            </li>
        @endforeach
        </ul>
    </div>
    @endforeach
@endif

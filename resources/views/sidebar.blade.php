@if(!empty($categories))
<ul class="list-group">
    @foreach($categories as $category)
    <li class="list-group-item">
        <div class=" d-flex justify-content-between align-items-center">
            <a class="dropdown-toggle" data-toggle="collapse" style="text-decoration: none; color: #000;" href="#c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category->description) }}" role="button" aria-expanded="false" aria-controls="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category->description) }}">
                {{ $category -> description }}
            </a>
            <span  class="badge badge-primary badge-pill">{{ count($category -> notes) }}</span>
        </div>

    <div class="collapse" id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $category->description) }}">
        <ul class="list-unstyled">
        @foreach($category -> notes as $note)
            <li>
                <a class="btn btn-link" href="{{ route('show', $note -> id) }}" >
                    {{ $note -> title }}
                </a>
            </li>
        @endforeach
        </ul>
    </div>
    </li>
    @endforeach
</ul>
@endif

@extends('layouts.app')
@section('content')

<form action="{{ route('update') }}" method="POST">
    @csrf
    <input type="hidden" name="note_id" value="{{ $note -> id }}" />
    <div class="row">
        <div class="form-group col-6">
        <input type="text" class="form-control" name="title" value="{{ $note -> title }}" />
        </div>
    </div>
    <div class="my-2">
        <textarea id="summernote" name="editordata">{!! $note -> note !!}</textarea>
    </div>
    <div class="form-row">
        <div class="col-3">
            <div class="form-group">
                <select class="form-control" name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category -> id }}" {{ $note->id == $category->id ? 'selected':'' }}>{{ $category -> description }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col"></div>
        <div class="col-1">
            <button class="btn btn-primary" type="submit">Sačuvaj</button>
        </div>
    </div>
</form>

@endsection

@extends('layouts.app')
@section('content')

<form action="{{ route('update') }}" method="POST">
    @csrf
    <input type="hidden" name="note_id" value="{{ $note -> id }}" />
    <input type="hidden" name="type" value="{{$type}}" />

    <div class="row">
        <div class="form-group col-12">
        <input type="text" class="form-control" name="title" value="{{ $note -> title }}" />
        </div>
    </div>

    <div class="my-2">
        <textarea id="summernote" name="editordata">{!! $note -> note !!}</textarea>
    </div>

    <div class="form-row">
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" name="tags" value="{{ $tags_string }}">
            <small id="tags" class="form-text text-muted">Posebne grupe:
                <span class="badge badge-primary">#favorite</span>
                <span class="badge badge-info">#todo</span>
                <span class="badge badge-danger">#important</span>
            </small>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" name="language" value="{{ $note -> language}}" >
            <small id="tags" class="form-text text-muted">Primjeri:
                <span class="badge badge-success">none</span>
                <span class="badge badge-primary">bash</span>
                <span class="badge badge-primary">python</span>
                <span class="badge badge-primary">html</span>
            </small>
        </div>
        <div class="col-sm-2">
            <button class="btn btn-primary btn-sm float-right" type="submit">Sačuvaj</button>
        </div>
    </div>
</form>

@endsection

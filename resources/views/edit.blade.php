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
    <div class="form-row mt-3">
        <div class="col-sm-8 col-md-6">
            <input type="text" class="form-control form-control-sm" name="tags" value="{{ $tags_string }}">
        </div>
        <div class="col-sm">
            <button class="btn btn-primary btn-sm float-right" type="submit">Sačuvaj</button>
        </div>
    </div>
</form>

@endsection

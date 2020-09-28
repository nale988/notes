@extends('layouts.app')
@section('content')

<form action="{{ route('savenote') }}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col">
            <input type="text" class="form-control form-control-sm" name="title" placeholder="Naslov">
        </div>
    </div>
    <div class="my-2">
        <textarea id="summernote" name="editordata"></textarea>
    </div>
    <div class="form-row">
        <div class="col-sm">
            <input type="text" class="form-control form-control-sm" name="tags" placeholder="#tag #tag2 #tag3">
        </div>
        <div class="col-sm-2">
            <button class="btn btn-primary btn-sm float-right pr-2" type="submit">Sačuvaj</button>
        </div>
    </div>
</form>

@endsection

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
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" name="tags" placeholder="#tag #tag2 #tag3">
            <small id="tags" class="form-text text-muted">Posebne grupe:
                <span class="badge badge-primary">#favorite</span>
                <span class="badge badge-info">#todo</span>
                <span class="badge badge-danger">#important</span>
            </small>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" name="language" value="plaintext" >
            <small id="tags" class="form-text text-muted">Primjeri:
                <span class="badge badge-succes">none</span>
                <span class="badge badge-primary">bash</span>
                <span class="badge badge-primary">python</span>
                <span class="badge badge-primary">html</span>
            </small>
        </div>
        <div class="col-sm-2">
            <button class="btn btn-primary btn-sm float-right pr-2" type="submit">Sačuvaj</button>
        </div>
    </div>
</form>

@endsection

@extends('layouts.app')
@section('content')

<div class="ml-10 mt-10 z-50">
<form action="{{ route('savenote') }}" method="POST" id="saveQuill">
    @csrf
    <textarea id="summernote" name="editordata"></textarea>

      <div class="form-row">
        <div class="col-sm">
            <input type="text" class="form-control form-control-sm" name="tags" placeholder="#tag #tag2 #tag3">
        </div>
        <div class="col-sm-2">
            <button class="btn btn-primary btn-sm float-right pr-2" type="submit">Sačuvaj</button>
        </div>
    </div>
</form>
</div>

@endsection

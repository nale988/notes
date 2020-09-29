@extends('layouts.app')
@section('content')

<div class="ml-10 mt-10 z-50">
<form action="{{ route('savenote') }}" method="POST" id="saveQuill">
    @csrf
    <span class="pt-10 z-30">
    <textarea id="summernote" name="editordata"></textarea>
    </span>

      <div class="form-row pt-10 mt-10">
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

@extends('layouts.app')
@section('content')

<div class="ml-10 mt-10">
<form action="{{ route('savenote') }}" method="POST">
    <textarea id="summernote" name="editordata" style="display:none;"></textarea>
</form>
</div>

@endsection

@extends('layouts.app')
@section('content')

<form action="{{ route('savenote') }}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col">
        <input type="text" class="form-control" name="title" placeholder="Naslov">
        </div>
    </div>
    <div class="my-2">
        <textarea id="summernote" name="editordata"></textarea>
    </div>
    <div class="form-row">
        <div class="col-6">
            <div class="form-group">
                <select class="form-control" name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category -> id }}">{{ $category -> description }}</option>
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

@extends('layouts.template_guru')
@section('contents')

<x-alert />
    <form action="{{ route('categories.update' , $category_soal->id) }}" method="POST">
        @csrf
        <input type="text" name="name" id="name" value="{{ $category_soal->name }}" class="form-control">
        <input type="submit" class="btn btn-primary mt-2" value="save">
    </form>
@endsection
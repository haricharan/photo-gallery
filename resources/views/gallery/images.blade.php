@extends('layouts.master')

@section('title', 'Image List')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
	@foreach ($images as $image)
		<p>ID: {{ $image->id }}</p>
		<p>Filename: {{ $image->filename }}</p>
		<p>Path: {{ $image->path }}</p>
		<p>Image Hash: {{ $image->image_hash }}</p>
		<br/>
	@endforeach
@endsection
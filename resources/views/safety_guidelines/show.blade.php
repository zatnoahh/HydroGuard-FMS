@extends('layouts.master')
@section('content')

<div class="container">
    <h1>Safety Guidelines Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $safetyGuideline->title }}
        </div>
        <div class="card-body">
            <p class="card-text">Description: {{ $safetyGuideline->description }}</p>
            
            <a href="{{ route('safety_guidelines.edit', $safetyGuideline->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('safety_guidelines.destroy', $safetyGuideline->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
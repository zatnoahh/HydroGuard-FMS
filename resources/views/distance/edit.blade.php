@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Edit Distance</h1>
    <form action="{{ route('distance.update', $distance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="number" class="form-control" id="value" name="value" value="{{ $distance->value }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
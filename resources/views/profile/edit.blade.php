@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" class="form-control" name="name"
                   value="{{ old('name', $user->name) }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control" name="email"
                   value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input id="phone_number" type="text" class="form-control" name="phone_number"
                   value="{{ old('phone_number', $user->phone_number) }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password <small class="text-muted">(leave blank to keep current)</small></label>
            <input id="password" type="password" class="form-control" name="password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-success">Update Profile</button>
        <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

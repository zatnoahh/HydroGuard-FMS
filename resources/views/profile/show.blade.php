@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Your Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <tr><th>Name:</th><td>{{ $user->name }}</td></tr>
        <tr><th>Email:</th><td>{{ $user->email }}</td></tr>
        <tr><th>Password:</th><td>********</td></tr>
        <tr><th>Role:</th><td>{{ ucfirst($user->role) }}</td></tr>
        <tr><th>Phone:</th><td>{{ $user->phone_number }}</td></tr>
    </table>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection

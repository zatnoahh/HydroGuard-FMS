@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}" required>
                            <label for="name"><i class="fas fa-user me-2"></i>Name</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" required>
                            <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ $user->phone_number }}" required>
                            <label for="phone_number"><i class="fas fa-phone me-2"></i>Phone Number</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="role" name="role" placeholder="Role" value="{{ $user->role }}" required>
                            <label for="role"><i class="fas fa-user-tag me-2"></i>Role</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

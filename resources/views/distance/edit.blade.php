@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Distance</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('distance.update', $distance->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-4">
                            <input type="number" class="form-control" id="value" name="value" placeholder="Value" value="{{ $distance->value }}" required>
                            <label for="value"><i class="fas fa-ruler me-2"></i>Value</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('distance.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success px-4">
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
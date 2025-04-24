@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Threshold</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('threshold.update', $threshold->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="status" name="status" placeholder="Status" value="{{ ucfirst($threshold->status) }}" readonly>
                            <label for="status"><i class="fas fa-info-circle me-2"></i>Status</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" placeholder="Threshold Value (cm)" value="{{ old('value', $threshold->value) }}" min="0" step="1" required>
                            <label for="value"><i class="fas fa-ruler me-2"></i>Threshold Value (cm)</label>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('threshold.index') }}" class="btn btn-secondary">
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

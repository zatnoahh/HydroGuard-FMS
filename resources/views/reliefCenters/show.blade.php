@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Relief Center Details</h4>
                </div>
                <div class="card-body">
                    <h6 class="text-muted">Details</h6>
                    <p class="card-text"><strong><i class="fas fa-map-marker-alt me-2"></i>Location:</strong> {{ $reliefCenter->location }}</p>
                    <p class="card-text"><strong><i class="fas fa-users me-2"></i>Capacity:</strong> {{ $reliefCenter->capacity }}</p>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('reliefCenters.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <div>
                            <a href="{{ route('reliefCenters.edit', $reliefCenter->id) }}" class="btn btn-warning me-2">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <form action="{{ route('reliefCenters.destroy', $reliefCenter->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Water Level Detail</h4>
                </div>
                <div class="card-body">
                    <h6 class="text-muted">Details</h6>
                    <p class="card-text"><strong><i class="fas fa-ruler-vertical me-2"></i>Water Level:</strong> {{ $distance->value }} cm</p>
                    <p class="card-text"><strong><i class="fas fa-tint me-2"></i>Status:</strong> {{ ucfirst($distance->status) }} </p>
                    <p class="card-text"><strong><i class="fas fa-calendar-alt me-2"></i>Recorded Date:</strong> {{ $distance->created_at->format('d.m.Y') }}</p>
                    <p class="card-text"><strong><i class="fas fa-clock me-2"></i>Recorded Time:</strong> {{ $distance->created_at->format('H:i:s') }}</p>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('distance.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <div>
                            <!-- <a href="{{ route('distance.edit', $distance->id) }}" class="btn btn-warning me-2">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a> -->
                            <form action="{{ route('distance.destroy', $distance->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this?')">
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
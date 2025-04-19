@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Safety Guideline Details</h4>
                </div>
                <div class="card-body">
                    <h6 class="text-muted">Details</h6>
                    <p class="card-text"><strong><i class="fas fa-book me-2"></i>Title:</strong> {{ $safetyGuideline->title }}</p>
                    <p class="card-text"><strong><i class="fas fa-align-left me-2"></i>Description:</strong> {{ $safetyGuideline->description }}</p>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('safety_guidelines.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <div>
                            <a href="{{ route('safety_guidelines.edit', $safetyGuideline->id) }}" class="btn btn-warning me-2">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <form action="{{ route('safety_guidelines.destroy', $safetyGuideline->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this?')">
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

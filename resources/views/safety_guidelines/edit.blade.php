@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Safety Guideline</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('safety_guidelines.update', $safetyGuideline->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $safetyGuideline->title }}" required>
                            <label for="title"><i class="fas fa-heading me-2"></i>Title</label>
                        </div>
                        <!-- Category Selection -->
                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold"><i class="fas fa-tags me-1"></i>Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled>Select a category</option>
                                <option value="Before a Flood" {{ $safetyGuideline->category == 'Before a Flood' ? 'selected' : '' }}>Before a Flood</option>
                                <option value="During a Flood" {{ $safetyGuideline->category == 'During a Flood' ? 'selected' : '' }}>During a Flood</option>
                                <option value="After a Flood" {{ $safetyGuideline->category == 'After a Flood' ? 'selected' : '' }}>After a Flood</option>
                                <option value="Special Consideration" {{ $safetyGuideline->category == 'Special Consideration' ? 'selected' : '' }}>Special Consideration</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a category.
                            </div>
                        </div>

                        <!-- Description Input -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold"><i class="fas fa-align-left me-1"></i>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter the guideline description..." required>{{ $safetyGuideline->description }}</textarea>
                            <small class="text-muted"><span id="charCount">0</span> / 300 characters</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('safety_guidelines.index') }}" class="btn btn-secondary">
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

<!-- Character Count Script -->
<script>
    const desc = document.getElementById('description');
    const count = document.getElementById('charCount');
    // Initialize the character count with the current length of the description
    count.textContent = desc.value.length;
    desc.addEventListener('input', () => {
        count.textContent = desc.value.length;
    });
</script>


@endsection

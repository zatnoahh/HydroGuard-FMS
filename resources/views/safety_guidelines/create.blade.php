@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add Safety Guideline</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('safety_guidelines.store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                            <label for="title"><i class="fas fa-heading me-2"></i>Title</label>
                        </div>
                        <!-- Category Selection -->
                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold"><i class="fas fa-tags me-1"></i>Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled selected>Select a category</option>
                                <option value="Before a Flood">Before a Flood</option>
                                <option value="During a Flood">During a Flood</option>
                                <option value="After a Flood">After a Flood</option>
                                <option value="Special Consideration">Special Consideration</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a category.
                            </div>
                        </div>
                        <!-- Description Input -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold"><i class="fas fa-align-left me-1"></i>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter the guideline description..." required></textarea>
                            <small class="text-muted"><span id="charCount">0</span> / 300 characters</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('safety_guidelines.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                                <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-plus-circle me-1"></i> Add Guideline
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
    desc.addEventListener('input', () => {
        count.textContent = desc.value.length;
    });
</script>

@endsection

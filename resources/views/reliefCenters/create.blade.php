@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Create Relief Center</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reliefCenters.store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            <label for="name"><i class="fas fa-building me-2"></i>Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location" required>
                            <label for="location"><i class="fas fa-map-marker-alt me-2"></i>Location</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity" required>
                            <label for="capacity"><i class="fas fa-users me-2"></i>Capacity</label>
                        </div>                        
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="service" name="service" placeholder="Service Provided" required>
                            <label for="service"><i class="fas fa-concierge-bell me-2"></i>Service Provided</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="contact_info" name="contact_info" placeholder="Additional Contact Information" style="height: 100px;" required></textarea>
                            <label for="contact_info"><i class="fas fa-info-circle me-2"></i>Additional Contact Information</label>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('reliefCenters.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-plus-circle me-1"></i> Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit"></i> Edit Course</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('courses.update', $course) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Course Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $course->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (Rp.)</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" value="{{ old('price', $course->price) }}" min="0" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Course
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
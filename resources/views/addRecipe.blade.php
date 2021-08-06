@extends('layouts')

@section('content')
<div class="container">

  <div class="margin-tb-45px full-width">
    <h4 class="padding-lr-30px padding-tb-20px background-white box-shadow border-radius-10"><i class="far fa-list-alt margin-right-10px text-main-color"></i>Basic Informations</h4>
    <div class="padding-30px padding-bottom-30px background-white border-radius-10">
      <form action="{{ route('post-add-recipe') }}" method="POST" enctype="multipart/form-data">
        @if(Session::get('success'))
          <div class="alert alert-danger">
            {{ Session::get('success') }}
          </div>
        @endif
        @csrf
        <div class="form-group margin-bottom-20px">
          <label><i class="far fa-list-alt margin-right-10px"></i> Recipe Title</label>
          <input type="text" class="form-control form-control-sm" name="name" placeholder="Listing Title">
        </div>
        @error('name')
          <div class="alert alert-danger"> {{ $message }} </div>
        @enderror

        <div class="form-group margin-bottom-20px">
          <label><i class="far fa-folder-open margin-right-10px"></i>Recipe Category</label>
          <select name="category" class"form-control form-control-sm">
            @foreach($categories as $category)
              <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        @error('category')
          <div class="alert alert-danger"> {{ $message }} </div>
        @enderror

        <div class="form-group margin-bottom-20px">
          <label><i class="far fa-list-alt margin-right-10px"></i> Recipe Description</label>
          <textarea class="ckeditor form-control" name="description"></textarea>
        </div>
        @error('description')
          <div class="alert alert-danger"> {{ $message }} </div>
        @enderror
        <div class="form-group margin-bottom-20px">
          <label><i class="fas fa-images"></i> Upload Image</label>
          <input type="file" name="image" class="form-control">
        </div>
        @error('image')
          <div class="alert alert-danger"> {{ $message }} </div>
        @enderror
        <div class="form-group margin-bottom-20px">
          <button type="submit" class="btn btn-md btn-primary full-width">Add Recipe </button>
        </div>
      </form>
    </div>
  </div>
@endsection

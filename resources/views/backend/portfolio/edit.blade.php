@extends('layouts.backend')
@section('title', 'Edit Portfolio')
@section('content')
  <div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
      <div class="flex">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
          </ol>
        </nav>
        <h1 class="m-0">Portfolio</h1>
      </div>
    </div>
  </div>
  <section>
    <div class="container-fluid" >
      <div class="row justify-content-center" >
        <div class="col-lg-8" >
          <div class="card">
            <div class="card-header">
              <h1 class="text-center ">Edit Portfolio</h1>
            </div>
            <div class="card-body">
              <form action="{{ route('backend.portfolio.update',$portfolio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class=" form-group">
                  <label for="">Category</label>
                <select name="category" class=" form-control" >
                  <option selected disabled>Select Category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                </div>

                <div class=" form-group">
                  <b>Photo:</b>
                  <input type="file" name="photo" class=" form-control" >
                  <img src="{{ asset('storage/portfolio/' . $portfolio->photo) }}" width="60" alt="image">
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

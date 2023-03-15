@extends('layouts.backend')
@section('title', 'Edit Category')
@section('content')
  <div class="container-fluid page__heading-container text-white" style="background: #9b9999; padding-top:10px">
    <div class="page__heading d-flex align-items-end">
      <div class="flex">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
          </ol>
        </nav>
        <h1 class="m-0">Category</h1>
      </div>
    </div>
  </div>
  <section style="background: #9b9999;padding-bottom:10px">
    <div class="container-fluid text-dark" >
      <div class="row justify-content-center" >
        <div class="col-lg-8" >
          <div class="card" >
            <div class="card-header">
              <h1 class="text-center text-white p-3" style="background: #9b9999;padding-bottom:10px">Edit Category</h1>
            </div>
            <div class="card-body">
              <form action="{{ route('backend.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class=" form-group">
                  <b>Name:</b>
                  <input type="text" name="name" class=" form-control" value="{{ $category->name }}">
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

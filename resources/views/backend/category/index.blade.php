@extends('layouts.backend')
@section('title', 'All categorys')
@section('content')
<div class="container-fluid page__heading-container">
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
  <div class="container">
    <div class="row justify-content-center">
      <div class=" col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">

          <li class="nav-item" role="presentation">
            <button class="nav-link active" data-toggle="tab" data-target="#active"><b>Active</b></button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" data-toggle="tab" data-target="#draft"><b>Draft</b></button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" data-toggle="tab" data-target="#trash"><b>Trash</b></button>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="active">
            <div class="card">
              <div class="card-header">
                <h4 class=" text-center">Active categorys</h4>
              </div>
              <div class="card-body">
                <table class=" table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($activeCategorys as $category)
                      <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>

                          <a href="{{ route('backend.category.edit', $category->id) }}" class=" btn btn-sm btn-info">Edit</a>
                          <a href="{{ route('backend.category.status', $category->id) }}"
                            class=" btn {{ $category->status == 'publish' ? 'btn btn-warning' : 'btn btn-success' }}">{{ $category->status == 'publish' ? 'Draft' : 'Publish' }}</a>
                          <a href="{{ route('backend.category.trash', $category->id) }}"
                            class=" btn btn-sm btn-warning">Trash</a>


                          </form>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="draft">
            <div class="card">
              <div class="card-header">
                <h4 class=" text-center">Draft categorys</h4>
              </div>
              <div class="card-body">
                <table class=" table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($draftCategorys as $category)
                      <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>

                          <a href="{{ route('backend.category.edit', $category->id) }}" class=" btn btn-sm btn-info">Edit</a>
                          <a href="{{ route('backend.category.status', $category->id) }}"
                            class=" btn {{ $category->status == 'publish' ? 'btn btn-warning' : 'btn btn-success' }}">{{ $category->status == 'publish' ? 'Draft' : 'Publish' }}</a>
                          <a href="{{ route('backend.category.trash', $category->id) }}"
                            class=" btn btn-sm btn-warning">Trash</a>


                          </form>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="trash">
            <div class="card">
              <div class="card-header">
                <h4 class=" text-center">Trashed Category</h4>
              </div>
              <div class="card-body">
                <table class=" table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($trashCategorys as $category)
                      <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                          <img src="{{ asset('storage/category/' . $category->photo) }}" width="60" alt="image">
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>

                          <a href="{{ route('backend.category.reStore', $category->id) }}"
                            class=" btn btn-sm btn-success">Restore</a>
                          <a href="{{ route('backend.category.delete', $category->id) }}"
                            class=" btn btn-sm btn-danger" onclick="return confirm('Are you Sure to Delete?')"> Delete </a>


                          </form>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
@extends('Back.layout.template')

@section('title', "lsit category admin")

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
      </div>

      <div class="mt-3">
        <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalCreate">create</button>
       
        @if ($errors->any())
        <div class="mt-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="mt-3">
                <div class="alert alert-success">
                        {{ session('success') }}
                </div>
            </div>
        @endif
       
        <table class="table table-striped table-hover">
            <thead>
                <th>no</th>
                <th>nama</th>
                <th>slug</th>
                <th>created_at</th>
                <th>function</th>
            </thead>
            <tbody>
                @forelse  ($category as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <div class="text-center">
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $item->id }}">edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}">hapus</button>
                            </div>
                        </td>
                    </tr>                    
                @empty
                    <tr><td colspan="5">tidak ada isi</td></tr>
                @endforelse
            </tbody>
        </table>
      </div>

      {{-- modal  start --}}
      
      {{-- modal create start --}}
      @include('Back.category.create-modal')
      {{-- modal create end --}}
      
      
      {{-- modal update start --}}
      @include('Back.category.update-modal')
      {{-- modal update end --}}
      
      
      {{-- modal delete start --}}
      @include('Back.category.delete-modal')
      {{-- modal delete end --}}
      
      
      
      {{-- modal end --}}
      
    </main>
@endsection
@extends('Back.layout.template')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">

@endpush

@section('title', "lsit Artikel admin")
    

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">article</h1>
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
       
        <table class="table table-striped table-hover" id="dataTable">
            <thead>
                <th>no</th>
                <th>Title</th>
                <th>Category</th>
                <th>View</th>
                <th>Status</th>
                <th>publish_date</th>
                <th>created_at</th>
                <th>function</th>
            </thead>
            <tbody>
                @forelse ($articles as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->GetCategory->name }}</td>
                        <td>{{ $item->views }} x</td>
                        @if ($item->status == 0)
                            <td>
                                <span class="badge bg-danger">Private</span>
                            </td>
                            
                        @else
                                <td>
                                    <span class="badge bg-success">Published</span>
                                </td>
                            
                        @endif
                        
                        
                        <td>{{ $item->publish_date  }}</td>
                        <td>{{ $item->created_at  }}</td>
                        <td class="text-center">
                            <a href="" class="btn btn-secondary">detail</a>
                            <a href="" class="btn btn-primary">edit</a>
                            <a href="" class="btn btn-danger">delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">kosong</td>
                    </tr>
                @endforelse
              
            </tbody>
        </table>
      </div>

     
      
    </main>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        } );
    </script>

@endpush
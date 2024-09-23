@extends('Back.layout.template')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">

@endpush

@section('title', "Detail Artikel admin")
    

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail article</h1>
      </div>

      <div class="mt-3">
        {{-- <a href="{{ route('article.create') }}" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalCreate">create</a> --}}
        <a href="{{ route('article.create') }}" class="btn btn-success mb-2" >create</a>
       
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
       
        <div class="mt-3">
            <table class="table table-bordered table-striped" id="">
                <thead>
                    <tr>
                        <th>Title</th>
                        <td>{{ $article->title }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $article->GetCategory->name }}</td>
                    </tr>
                    <tr>
                        <th>slug</th>
                        <td>{{ $article->slug }}</td>
                    </tr>
                    <tr>
                        <th>description</th>
                        <td>{{ $article->description }}</td>
                    </tr>
                    <tr>
                        <th>img</th>
                        <td>
                            <a href="{{ asset('storage/back/img/'.$article->img) }}" target="_blank">
                            <img src="{{ asset('storage/back/img/'.$article->img) }}" alt="" width="50%"></a>
                        </td>
                    </tr>
                    <tr>
                        <th>views</th>
                        <td>{{ $article->views }}</td>
                    </tr>
                    <tr>
                        <th>status</th>
                            @if ( $article->status ==0 )
                                <td> <span class="badge bg-danger">draft</span></td>
                            @else
                                <td> <span class="badge bg-success">publish</span></td>
                            @endif
                    </tr>
                </thead>
                <div class="float-end">
                    <a href="{{ route('article.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </table>

        </div>
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
            $('#dataTable').DataTable({
                processing: true,
                serverside: true,
                ajax:'{{ url()->current() }}',
                columns:[
                    {
                        data:'DT_RowIndex',
                        name:'DT_RowIndex',
                    },
                    {
                        data:'title',
                        name:'title',
                    },
                    {
                        data:'category_id',
                        name:'category_id',
                    },
                    {
                        data:'views',
                        name:'views',
                    },
                    {
                        data:'status',
                        name:'status',
                    },
                    {
                        data:'publish_date',
                        name:'publish_date',
                    },
                    {
                        data:'button',
                        name:'button',
                    },
                  

                ],
        });
        } );
    </script>

@endpush
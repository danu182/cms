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

        {{-- @if(session('success'))
            <div class="mt-3">
                <div class="alert alert-success">
                        {{ session('success') }}
                </div>
            </div>
        @endif --}}
       
        {{-- sweet alert satrt --}}
        <div class="swal" data-swal="{{ session('success') }}">
        </div>
        {{-- sweet alert end --}}

        <table class="table table-striped table-hover" id="dataTable">
            <thead>
                <th>no</th>
                <th>Title</th>
                <th>Category</th>
                <th>View</th>
                <th>Status</th>
                <th>publish_date</th>
                {{-- <th>created_at</th> --}}
                <th>function</th>
            </thead>
            <tbody>
                
              
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- sweet alert success start --}}
    <script>
        const swall= $('.swal').data('swal');
        if(swall){
            Swal.fire({
                title: "Good job!",
                text: swall,
                icon: "success",
                showConfirmButton: false,
                timer:2500,
                });
        }
    </script>
    {{-- sweet alert success end --}}

    {{-- data table start --}}
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
    {{-- data table end --}}

@endpush
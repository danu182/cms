@extends('Back.layout.template')


@section('title', "Create Artikel Admin")
    

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Article</h1>
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
       
       <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">

                    <div class="mb-3">
                        <label for="title">title</label>
                        <input type="text" name="title" class="form-control" id="" value="{{ old('title') }}">
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="category">category</label>
                            <select name="category_id" id="" class="form-control">
                                        <option value="" hidden >-- pilih salah satu ---</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                
                </div>
            </div>
       </form>



      </div>

     
      
    </main>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
@endpush
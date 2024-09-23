@extends('Back.layout.template')


@section('title', "Create Artikel Admin")
    

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">edit  Article => {{ $article->title }}</h1>
      </div>

      <div class="mt-3">
        {{-- <a href="{{ route('article.create') }}" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalCreate">create</a> --}}
        {{-- <a href="{{ route('article.create') }}" class="btn btn-success mb-2" >create</a> --}}
       
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
       
       <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')    
        @csrf

            <div class="row">
                <div class="col-6">

                    <input type="hidden" value="{{ $article->img }}" name="oldImg">

                    <div class="mb-3">
                        <label for="title">title</label>
                        <input type="text" name="title" class="form-control" id="" value="{{   old('title') ?: $article->title }}">
                    </div>
                
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="category">category</label>
                        <select name="category_id" id="" class="form-control">
                            <option value="{{ $article->category_id }}">{{ $article->GetCategory->name }}</option>
                                    <option value="" hidden >-- pilih salah satu ---</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>


                    <div class="mb-3">
                        <label for="description">description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $article->description  ?: old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image">image</label>
                        <input type="file" name="img" id="image" class="form-control">
                        <div class="mt-1">
                            <small>Gambar lama</small><br>
                            <img src="{{ asset('storage/back/img/'.$article->img) }}" alt="" width="50%">
                        </div>
                    </div>

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="status">status</label>
                            <select name="status" id="status" class="form-control">
                               <option value="0"{{ $article->status== 0 ? 'selected' : null }}>Draft</option>
                               <option value="1" {{ $article->status== 1 ? 'selected' : null }}>Publish</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="publish_date">publish_date</label>
                            <input type="date" name="publish_date" id="publish_date" class="form-control" value="{{ $article->publish_date ?: old('publish_date') }}">
                        </div>
                    </div>
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-success">Updte</button>
                </div>
       </form>



      </div>

     
      
    </main>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
@endpush
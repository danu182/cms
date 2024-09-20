
 @foreach ($category as $item)
     
 
 <!-- Modal -->
<div class="modal fade" id="modalUpdate{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ url('categories/'. $item->id) }}" method="post">
          @method('PUT')  
          @csrf

            <label for="exampleFormControlInput1" class="name">Name</label>
            <input type="text" class="form-control | @error('name') is-invalid @enderror" name="name" id="exampleFormControlInput1" placeholder="input name" value="{{ old('name', $item->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>

        </form>
      </div>
      
      
    </div>
  </div>
</div>


 @endforeach
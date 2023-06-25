@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1> 
</div>
<div class="col-lg-8">
    <form action="/dashboard/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"  name="title" value="{{ old('title') }}">
        @error('title')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Post Image</label>
            <img src="" alt="" class="img-preview img-fluid col-sm-5">
            <input class="form-control  @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            @error('body')        
                <p class=" text-danger">{{ $message }}</p>
            @enderror
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>     
        </div>

        
        <div class="mb-3">
        <label for="question" class="form-label">Question #1</label>
        <button  type="button" id="add">Tambah</button>
        <button type="button" id="remove">Kurang</button>
        <input type="text" class="form-control @error('question.*') is-invalid @enderror" id="question" name="question[]" >
        @error('question.*')
        <div class="invalid-feedback">Tidak boleh ada pertanyaan yang kosong</div>
        @enderror
        </div>

        <div class="mb-3 " id="tambah_inputan"></div>

        

        <button type="submit" class="btn btn-primary">Create Post</button>
      </form>
</div>


<script>
        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");

        title.addEventListener("keyup", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g,"-");
            slug.value = preslug.toLowerCase();
        });

        document.addEventListener('trix-file-accept',function(e){
            e.preventDefault();
        })

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
        

        let counter = 1
        $('#add').click(function(){
            counter++
            let newInputan = `<div id="hapus`+counter+`">
            <label for="slug" class="form-label">Question #`+ counter +`</label>
            <input type="text" class="form-control" id="question" name="question[]" >
            </div>`
            $('#tambah_inputan').append(newInputan)

        });
        
        $('#remove').click(function(){
            if(counter == 1)swal.fire("Form Minimal 1 Pertanyaaan")
            $('#hapus'+counter).remove()
            counter--
        });
        


       
</script>
@endsection


<x-layout>
     <div class="container py-md-5 container--narrow">
      <form action="/post/{{$post->id}}/update" method="POST">


        @method('PUT')
         @csrf
        <div class="form-group">
          <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
          <input value="{{ old('title', $post->title)}}" required name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
          @error('title')
            <p class="text-danger small mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
          <textarea required name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{ old('body', $post->body)}}</textarea>
           @error('title')
            <p class="text-danger small mt-1">{{$message}}</p>
          @enderror
        </div>

        <button class="btn btn-primary">Save changes</button>
      </form>
    </div>
</x-layout>

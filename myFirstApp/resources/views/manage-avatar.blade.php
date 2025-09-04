<x-layout>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h2 class="text-center mb-4 text-primary">Manage Your Avatar</h2>

            <form action="/manage-avatar" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label for="avatar" class="form-label text-muted">Upload an Avatar</label>
                <input type="file" name="avatar" id="avatar" class="form-control" />
                @error('avatar')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>


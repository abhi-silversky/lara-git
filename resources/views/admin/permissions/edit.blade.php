<x-admin.admin-master>
    @section('content')
        <h2>Edit Permission</h2>

        <div class="row">
            <div class="col-sm-6">
                <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <label class="form-group" for="name">Name</label>
                    <input class="form-group @error('name') is-invalid  @enderror" type="text" name="name" id="name"
                        value="{{ $permission->name }}">
                    @error('name')
                        <span class="invalid-feedback mb-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror()
                    <button type="submit" class="btn btn-info">Update</button>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @endsection

</x-admin.admin-master>

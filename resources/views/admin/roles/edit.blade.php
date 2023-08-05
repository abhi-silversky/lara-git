<x-admin.admin-master>
    @section('content')
        <h2>Edit Role</h2>

        <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
            @csrf
            @method('PATCH')
            <label class="form-group" for="name">Name</label>
            <input class="form-group @error('name') is-invalid  @enderror" type="text" name="name" id="name"
                value="{{ $role->name }}">
            @error('name')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror()
            <button type="submit" class="btn btn-info">Update</button>
        </form>
    @endsection

</x-admin.admin-master>

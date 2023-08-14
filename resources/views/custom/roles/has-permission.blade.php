{{-- <input type="checkbox" name="checkbox" class="checkbox" @if ($user->roles->contains($role)) checked @endif id=""> --}}

<input type="checkbox" name="checkbox" class="checkbox" @if ($role->permissions->contains($permission)) checked @endif id="">

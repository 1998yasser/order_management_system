<div class="modal fade" id="EditUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editClientModalLabel">Edit User</h5>
        </div>
        <div class="modal-body">
          <form action="{{route("users.update", $user->id)}}" method="post">
            @csrf
            <div class="form-group">
              <label for="phone">Id</label>
              <input type="text" class="form-control" name="id" value="{{$user->id}}">
            </div>
            <div class="form-group">
              <label for="first_name">Name</label>
              <input type="text" class="form-control" name="name" value="{{$user->name}}">
            </div>
            <div class="form-group">
              <label for="last_name">Role</label>
              <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value="{{$user->email}}">

            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" >

            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
</div>



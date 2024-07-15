@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <a href="#AddUser" data-target="#AddUser" data-toggle="modal" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        
                                            <?php if($user->role == "user"){
                                                $color = "danger";
                                            }
                                            else{
                                                $color = "success";
                                            } ?>
                                            
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$user->id}}</p>
                                        </td>
                                        <td>
                                            <div>
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$user->name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-{{$color}}">{{$user->role}}</span>
                                          </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$user->created_at}}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="#EditUser{{$user->id}}" class="mx-3" data-bs-toggle="modal" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            @include('edit.editUser')
                                            <span>
                                                <a href="{{route('users.delete',$user->id)}}" onclick="return(confirm('Do you really want to delete this user ?'))">
                                                    <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--modal-->
 <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addClientModalLabel">Add User</h5>
        <button type="button" class="border-0 bg-transparent " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('users.add')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone">
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
            <small name="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">
          </div>
          <div class="form-group">
            <label for="clientAddress">Role</label>
            <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
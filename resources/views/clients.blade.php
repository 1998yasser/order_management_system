@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">Clients</h5>
                </div>
                <a href="#AddClient" data-target="#AddClient" data-toggle="modal" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Costumer</a>
              </div>
            </div>
            <div class="ms-md-3 pe-md-3 mt-2 d-flex align-items-center">
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">first name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">last name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">adresse</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">remarques</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($clients as $client)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ strlen($client->phone) == 9 ? '0'.$client->phone : $client->phone }}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">{{$client->first_name}}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">{{$client->last_name}}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">{{$client->email}}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">{{$client->address_1}}</span>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$client->remarques}}</p>
                      </td>
                      
                      <td class="align-middle">
                        <a href="#EditClient{{$client->phone}}" class="text-secondary font-weight-bold text-xs"  data-bs-toggle="modal" data-target="">
                          Edit
                        </a>
                        @include('edit.editClient')
                      </td>
                    </tr>
                    @endforeach
                    <div class="d-flex justify-content-center">{{$clients->links()}}</div>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </main>
  <!-- Modal -->
<div class="modal fade" id="AddClient" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addClientModalLabel">Add Client</h5>
        <button type="button" class="border-0 bg-transparent " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('clients.add')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone">
          </div>
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name">
          </div>
          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
            <small name="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="address_1">Address</label>
            <input type="text" class="form-control" name="address_1">
          </div>
          <div class="form-group">
            <label for="remarques">Remarques</label>
            <input type="text" class="form-control" name="remarques">
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

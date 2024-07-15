<div class="modal fade" id="EditClient{{$client->phone}}" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
        </div>
        <div class="modal-body">
          <form action="{{route("clients.update", $client->phone)}}" method="post">
            @csrf
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" name="phone" value="0{{$client->phone}}">
            </div>
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="text" class="form-control" name="first_name" value="{{$client->first_name}}">
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text" class="form-control" name="last_name" value="{{$client->last_name}}">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value="{{$client->email}}">
              <small name="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="adresse">Address</label>
              <input type="text" class="form-control" name="address_1" value="{{$client->address_1}}">
            </div>
            <div class="form-group">
              <label for="remarques">Remarques</label>
              <input type="text" class="form-control" name="remarques" value="{{$client->remarques}}">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
</div>



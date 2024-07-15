<div class="modal fade" id="EditProduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editClientModalLabel">Edit Product</h5>
        </div>
        <div class="modal-body">
          <form action="{{route("products.update", $product->id)}}" method="post">
            @csrf
            <div class="form-group">
              <label for="id">Id</label>
              <p class="text-secondary font-weight-bold">{{$product->id}}</p>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{$product->name}}">
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" name="slug" value="{{$product->slug}}">
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" name="price" value="{{$product->price}}">
            </div>
            <div class="form-group">
              <label for="stock_quantity">Quantity</label>
              <input type="text" class="form-control" name="stock_quantity" value="{{$product->stock_quantity}}">
            </div>
            <div class="form-group">
                <label for="stock_status">Stock Status</label>
                <input type="text" class="form-control" name="stock_status" value="{{$product->stock_status}}">
            </div>
            <div class="form-group">
                <label for="total_sales">Total Sales</label>
                <input type="text" class="form-control" name="total_sales" value="{{$product->total_sales}}">
              </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
</div>
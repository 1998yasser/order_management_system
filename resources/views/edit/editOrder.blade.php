<div class="modal fade text-start" id="ConfirmOrder{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="ConfirmOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ConfirmOrderModalLabel" style="text-align: left;">Confirm Order - {{$order->id}}</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('orders.confirm',$order->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="city">City</label>
                        <select name="city" id="city" class="form-control">
                            @foreach ($cities as $city)
                                <option value="{{$city['ID']}}">{{$city['NAME']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Notes</label>
                        <input type="text" class="form-control" name="notes">
                      </div>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-start" id="CancelOrder{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="CancelOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CancelOrderModalLabel" style="text-align: left;">Cancel Order - {{$order->id}}</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('orders.cancel',$order->id)}}" method="get">
                    @csrf
                    <div class="form-group">
                        <h6>Are you sure you want to cancel this order ?</h6>
                        <input type="submit" value="Yes" class="btn btn-primary">
                        
                    </div>
                    <div class="form-group mb-0">
                        <span class="text-sm text-secondary">If not, simply click outside of this box!</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
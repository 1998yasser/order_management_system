@extends('layouts.user_type.auth')

@section('content')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <div class="col-xl-6">
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                      <i class="fas fa-landmark opacity-10"></i>
                    </div>
                  </div>
                  <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Total ventes</h6>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">+MAD {{$totalOrders}}</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mt-md-0 mt-4">
                <div class="card">
                  <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                      <i class="fab fa-paypal opacity-10"></i>
                    </div>
                  </div>
                  <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Total commandes</h6>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">{{$count}}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 mt-4">
        <div class="card">
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Commandes</h6>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
              @foreach ($orders as $order)
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">Order : {{$order->id}}</h6>
                    <span class="mb-2 text-xs">Date order : <span class="text-dark ms-sm-2 font-weight-bold">{{$order->date_created}}</span></span>
                    <span class="text-xs">Costumer number: <span class="text-dark ms-sm-2 font-weight-bold">{{$order->customer_id}}</span></span>
                    <span class="text-xs">Costumer name: <span class="text-dark ms-sm-2 font-weight-bold">{{$order->customer->first_name}} {{$order->customer->last_name}}</span></span>
                    <h7 class="mb-3 text-primary">{{$order->total}}</h7>
                  </div>
                  <div class="ms-auto text-end">
                    <table class="">
                      <tr>
                        <td class="card mt-1 mb-1 ">
                          <a href="#ConfirmOrder{{$order->id}}" class="btn btn-link text-success text-gradient px-3 mb-0" data-bs-toggle="modal" data-target=""><i class="far fa-check-circle"></i> Confirm</a>@include('edit.editOrder')
                        </td>
                      </tr>
                      <tr>
                        <td class="card mt-1 mb-1 ">
                          <a href="#CancelOrder{{$order->id}}" class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-target=""><i class="far fa-times-circle me-2"></i>Cancel</a>@include('edit.editOrder')
                        </td>
                      </tr>
                    </table>
                  </div>
                </li>
              @endforeach
              <div class="d-flex justify-content-center">{{$orders->links()}}</div>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-5 mt-4">
        <div class="card h-100 mb-4 bg-success ">
          <div class="card-header pb-0 px-3 bg-success">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-0">Confirmed orders</h6>
              </div>
              <div class="col-md-6 d-flex justify-content-end align-items-center">
                <i class="far fa-calendar-alt me-2"></i>
                <small>{{$lastOrderDate}}</small>
              </div>
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
              @foreach($confirmedOrders as $confirmedOrder)
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center ps-3 ">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="far fa-check-circle"></i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">{{$confirmedOrder->tracking}} - {{$confirmedOrder->customer->address_1}}</h6>
                      <span class="text-xs">{{$confirmedOrder->date_created}}, {{$confirmedOrder->customer->first_name}}, {{$confirmedOrder->customer->phone}}</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + {{$confirmedOrder->total}} MAD
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@extends('layouts.admin')
@section('title', 'Orders')
@section('content')
    <h1 class="page-title">Orders</h1>
    <div class="container">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h5>Orders</h5>
                </div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>By</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->items->count()}}</td>
                                <td>{{$order->total / 100}}</td>
                                <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                                
                                <td>
                                    <span class="badge bg-@if($order->status == 'pending')warning
                                        @elseif($order->status == 'processing')info
                                        @elseif($order->status == 'shipped')success
                                        @elseif($order->status == 'cancelled')danger @endif
                                        ">
                                        {{$order->status}}
                                    </span>
                                </td>
                                
                                <td>
                                    <div class="d-flex" style="gap: 5px;">
                                    <a href="{{route('adminpanel.orders.view', $order->id)}}" class="btn btn-primary">View</a>
                                    </div>
                                    
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

@endsection
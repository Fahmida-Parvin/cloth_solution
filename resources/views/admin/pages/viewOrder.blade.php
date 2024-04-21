@extends('layouts.admin')
@section('title', 'Order #' . $pickupRequest->id)
@section('content')
    <div class="page-title">Order #{{ $pickupRequest->id }}</div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Order Details</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <tbody>
                                <tr>
                                    <td>Order Id</td>
                                    <td>{{ $pickupRequest->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $pickupRequest->name }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $pickupRequest->address }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>{{ $pickupRequest->mobile }}</td>
                                </tr>
                                <tr>
                                    <td>Delivery Date</td>
                                    <td>{{ $pickupRequest->delivery_date }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <form action="{{ route('admin.updateOrderStatus', $pickupRequest->id) }}" method="post" style="display: flex; gap: 15px; max-width: 300px">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control">
                                                <option value="pending" {{ $pickupRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="picked up" {{ $pickupRequest->status == 'picked up' ? 'selected' : '' }}>Picked Up</option>
                                                <option value="ready" {{ $pickupRequest->status == 'ready' ? 'selected' : '' }}>Ready</option>
                                                <option value="delivered" {{ $pickupRequest->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
            
                                            </select>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Add other fields as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

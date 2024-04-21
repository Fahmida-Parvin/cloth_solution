@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <h1 class="page-title">Dashboard</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pickup Request</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Delivery Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pickupRequests as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->name }}</td>
                                        <td>{{ $request->address }}</td>
                                        <td>{{ $request->mobile }}</td>
                                        <td>{{ $request->delivery_date }}</td>
                                        <td>
                                            <a href="{{ route('admin.viewOrder', $request->id) }}" class="btn btn-secondary">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No pickup requests yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

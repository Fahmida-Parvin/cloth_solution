

@extends('layouts.master')
@section('name', 'Pick Up')
@section('content')

<main class="schedule">
  <div class="confirm">
    <h1>SCHEDULE A PICKUP</h1>
    <form action="{{ route('pickup.store') }}" method="post">
      @csrf

      <label for="fname">Name</label>
      <input type="text" id="fname" name="name" placeholder="Your Name" required>

      <label for="address">Address</label>
      <input type="text" id="ads" name="address" placeholder="Your Address" required>

      <label for="mobile">Mobile</label>
      <input type="text" id="mob" name="mobile" placeholder="Your Number" required>

      <label for="delivery">Expected delivery within:</label>
      <input type="date" id="mob" name="delivery_date" required>

      <input type="submit" value="Confirm">
    </form>
  </div>
</main>

@endsection

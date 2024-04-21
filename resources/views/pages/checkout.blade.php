@extends('layouts.master')
@section('title', 'Checkout')
@section('head')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            height: 40px;
            padding: 10px 12px;
            width: 100%;
            color: #32325d;
            background-color: white;
            border: 1px solid transparent;
            border-radius: 4px;
            margin-bottom: 20px;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: red;
        }

        .StripeElement--webkit--autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection
@section('content')
    
    <header class="page-header">
        <h1>Checkout</h1>
        <h3 class="cart-amount">${{App\Models\Cart::totalAmount()}}</h3>
    </header>

    <main class="checkout-page">
        <div class="container">
            

            <div class="checkout-form">
                <form action="{{ route('testStripeCheckout')}}" id="payment-form" method="POST">

                    @csrf
                    <div class="field">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="@error('name') has-error @enderror" placeholder="John Doe" value="{{old('name') ? old('name') : auth()->user()->name}}">
                        @error('name')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="@error('email') has-error @enderror" placeholder="example@gmail.com" value="{{old('email') ? old('email') : auth()->user()->email}}">
                        @error('email')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="@error('phone') has-error @enderror" placeholder="Ex-01710777888" value="{{ old('phone') ? old('phone') : auth()->user()->phone }}">
                        @error('phone')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="country">Country</label>
                        <select name="country" id="country">
                            <option value="">-- Select Country --</option>
                            <option value="">Bangladesh</option>
                            <option value="">United States</option>
                        </select>
                        @error('country')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" class="@error('state') has-error @enderror" placeholder="state" value="{{old('state')}}">
                        @error('state')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" class="@error('city') has-error @enderror" placeholder="city" value="{{ old('city') }}">
                        @error('city')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    

                    <div class="field">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" class="@error('address') has-error @enderror" placeholder="address" value="{{old('address')}}">
                        @error('address')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    

                    <input type="hidden" name="payment_method_id" id="payment_method_id" value="">

                    <label>
                        Card Details
                        <div id="card-element"></div>
                    </label>
                    <button class="btn btn-primary btn-block" type="submit" id="submit">Submit Payment</button>
                    <!-- Display error messages -->
                    <div id="error-message"></div>
                </form>
            </div>

        </div>
    </main>

    <script>
        var stripe = Stripe('pk_test_51OTOzrBDd4sK1N1ZZogenQDBjliFoHfKnWNLhgBeWwO0Y07o1Ky8rEns0n9gc9y5L9J0tC07kuQObyBXLdDxamGt00rMd6HV1S');

        var elements = stripe.elements();

        var style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa775a",
                iconColor: "#fa775a"
            },
        };
        var cardElement = elements.create('card', {style: style});
cardElement.mount('#card-element');

var checkoutForm = document.getElementById('payment-form');
checkoutForm.addEventListener('submit', function(event){
    event.preventDefault();
    
var userName = document.getElementById('name').value;

    stripe.createPaymentMethod({
        type: 'card',
        card: cardElement,
        billing_details: {
            name : 'userName',
        },
    }).then(stripePaymentMethodHandler);
});

function stripePaymentMethodHandler(result) {
    if (result.error) {
        // Handle errors here
    } else {
        document.getElementById('payment_method_id').value = result.paymentMethod.id;

        // Trigger form submission
        var submitEvent = new Event('submit');
        checkoutForm.dispatchEvent(submitEvent);
    }
}

    </script>
    

@endsection
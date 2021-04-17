@extends('layouts.app')

@section('content')

<div class="pullUp">

@if (session('resCode'))
        <div class="alert alert-primary" role="alert">
            <strong>{{ session('resCode') }}:</strong> {{ session('resDesc') }}
        </div>
@endif



@if (session('checkoutId'))
<div class="jumbotron">
  <h1 class="display-4">Pay £{{ session('amount') }}</h1>
  <p class="lead"><strong>Referene:</strong> {{ session('merchantTransactionId') }} </p>
  <hr class="my-4">
  <form action="{{ route('pay') }}" class="paymentWidgets" data-brands="VISA MASTER AMEX">
  </form>
  </div>
  <script>
    var wpwlOptions = {
        style: "plain",
        billingAddress: {},
        mandatoryBillingFields:{
            country: true,
            state: true,
            city: true,
            postcode: true,
            street1: true,
            street2: false
        }
    }
</script>
<script async src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ session('checkoutId') }}"></script>

@else 



<div class="jumbotron">
  <h1 class="display-4">Let's Make a Payment!</h1>
  <p class="lead">Please enter the amount and reference number below.</p>
  <hr class="my-4">
  <form action="{{ route('dashboard') }}" method="post">
        @csrf
  <div class="input-group mb-4">
  <div class="input-group-prepend">
    <span class="input-group-text">£</span>
  </div>
  <input type="text" aria-label="Amount" id="amount" name="amount" placeholder="0.00" class="form-control form-control-lg" value="{{ old('amount') }}">
  <input type="text" aria-label="Reference" id="merchantTransactionId" name="merchantTransactionId" placeholder="Payment Reference" value="{{ old('merchantTransactionId') }}"  class="form-control form-control-lg">

</div>
@error('amount')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            @error('merchantTransactionId')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
<button type="submit" class="btn btn-primary btn-lg">Send Payment</button>
</form>

</div>




<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Payment History</h5>
    <div class="table-responsive">
    @if ($payments->count())
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Amount</th>
      <th scope="col" >Reference</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($payments as $payment)
  <tr>
      <th sope="row">£{{ $payment->amount }} <br> 
        <form action="{{ route('refund') }}" method="post">
          @csrf
          <input type="hidden" name="paymentId" id="paymentId" value="{{ $payment->paymentId }}" />
          <button type="submit" class="btn btn-outline-primary btn-sm">Refund</button>
       </form>
      </th>
      <td>{{ $payment->merchantTransactionId }} <br><small>{{ $payment->paymentId }}</small></td>
      <td>{{ $payment->created_at }}</td>
    </tr>
@endforeach
  </tbody>
</table>

@else
    <p>No Payments Made</p>
@endif

</div>
  </div>
</div>





@endif

</div>
@endsection
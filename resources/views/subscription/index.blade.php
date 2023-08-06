<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscription') }}
        </h2>
    </x-slot>

    <x-panel>
        @include('layouts.partials.errorlist')

        <form id="payment-form" action="{{ route('subscription.store') }}"
              method="POST">
            @csrf

            <div class="form-group{{ $errors->has('plan') ? ' has-danger' : '' }}">
                <label for="plan" class="required">
                    {{ __('New subscription plan') }}
                </label>

                <select name="plan" id="plan" class="form-control">
                    @foreach($plans as $plan)
                        <option value="{{ $plan->gateway_id }}"
                                {{ (request('plan') == $plan->slug || old('plan') == $plan->gateway_id) ? ' selected ' : '' }}
                        >
                            {{ $plan->name }}
                            (€ {{ $plan->price / 100 }} )
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('plan'))
                    <span class="form-text">
                                    <strong>{{ $errors->first('plan') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="coupon">{{ __('Coupon') }}</label>
                <input name="coupon" id="coupon" class="form-control"
                       type="text" />
            </div>

            <div class="form-group">
                <label for="card-holder-name">{{ __('Holder name') }}</label>
                <input name="card-holder-name" id="card-holder-name" class="form-control"
                       value="{{ auth()->user()->name }}"
                       type="text" required />
            </div>

            <div class="form-group">
                <label for="card-element">{{ __('Credit card data') }}</label>
                <div id="card-element" class="form-control" style='padding-top: .7em;'></div>
            </div>

            <button type="submit" id="card-button" class="btn btn-primary"
                    data-secret="{{ $intent->client_secret }}">
                {{ __('Subscribe') }}
            </button>
        </form>
    </x-panel>

<x-slot name="jsLinks">
    <script src="https://js.stripe.com/v3/"></script>
</x-slot>

<x-slot name="js">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stripe = Stripe('{{ config('cashier.key') }}');

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardForm = document.getElementById('payment-form');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                cardButton.disabled = true

                const {setupIntent, error} = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {name: cardHolderName.value}
                        }
                    }
                );

                if (error) {
                    // Display "error.message" to the user...
                    cardButton.disabled = false;
                } else {
                    // The card has been verified successfully...
                    const input = document.createElement("input");
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "token");
                    input.setAttribute("value", setupIntent.payment_method);

                    cardForm.appendChild(input)

                    cardForm.submit();
                }
            });
        })
    </script>
</x-slot>
</x-app-layout>

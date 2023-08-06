<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update card') }}
        </h2>
    </x-slot>

    <x-panel>
        @include('layouts.partials.errorlist')

        <form action="{{ route('subscription.card.store') }}" method="post" id="card-form">
            @csrf

            <div class="form-group">
                <label for="card-holder-name">{{ __('Holder name') }}</label>
                <input id="card-holder-name" class="form-control" type="text" value="{{ auth()->user()->name }}">
            </div>

            <div class="form-group">
                <label for="card-element">{{ __('Credit card data') }}</label>
                <div id="card-element" class="form-control" style='padding-top: .7em;'></div>
            </div>

            <button id="card-button" type="submit" class="btn btn-primary"
                    data-secret="{{ $intent->client_secret }}">
                {{ __('Update card') }}
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
                const cardForm = document.getElementById('card-form');
                const cardButton = document.getElementById('card-button');
                const clientSecret = cardButton.dataset.secret;

                cardForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    cardButton.disabled = true;

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
                        cardButton.disabled = false
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

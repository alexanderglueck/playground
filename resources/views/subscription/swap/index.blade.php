<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Swap subscription') }}
        </h2>
    </x-slot>

    <x-panel>
        @include('layouts.partials.errorlist')

        <form action="{{ route('subscription.swap.store') }}" method="post">
            @csrf

            <div class="row form-group{{ $errors->has('plan') ? ' has-danger' : '' }}">
                <label for="plan" class="col-md-4 col-form-label">
                    {{ __('New subscription plan') }}
                </label>

                <div class="col-md-6">
                    <select name="plan" id="plan" class="form-control">
                        @foreach($plans as $plan)
                            <option value="{{ $plan->gateway_id }}" {{ (old('plan') == $plan->gateway_id) ? ' selected ' : '' }} >
                                {{ $plan->name }}
                                (€ {{ $plan->price / 100 }} {{ __('per month') }})
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('plan'))
                        <span class="form-text">
                                <strong>{{ $errors->first('plan') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('Swap subscription') }}
            </button>
        </form>
    </x-panel>
</x-app-layout>

@extends('layouts.public')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Sign up') }}</h5>
                    <form method="post" action="{{ $route }}">
                        @csrf
                        <input type="hidden" class="js-val" name="workspace" value="{{ $workspace }}" />

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Full Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('E-Mail') }}</label>
                            <input disabled type="email" id="name" class="form-control @error('email') is-invalid @enderror" value="{{ $email }}" />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="" required />
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="" required />
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary create-tenant" disabled>{{ __('Sign up') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

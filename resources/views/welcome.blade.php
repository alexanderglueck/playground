@extends('layouts.public')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Sign in</h5>
                <form method="post" action="{{ route('lookup') }}">
                    @csrf
                    @honeypot
                    <div class="mb-3">
                        <label for="login-email" class="form-label">{{ __('E-Mail') }}</label>
                        <input type="email" id="login-email" name="email" class="form-control @error('email', 'login') is-invalid @enderror" required />
                        <div id="emailHelp" class="form-text">{{ __("We'll send you a list of your teams.") }}</div>
                        @error('email', 'login')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-secondary">Sign in</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sign up</h5>
                <form method="post" action="{{ route('tenants.email') }}">
                    @csrf
                    @honeypot
                    <div class="mb-3">
                        <label for="workspace" class="form-label">{{ __('Workspace') }}</label>
                        <input type="text" id="workspace" name="workspace" minlength="4" maxlength="16" class="form-control @error('workspace', 'register') is-invalid @enderror" value="{{ old('workspace') }}" required />
                        <div id="workspaceHelp" class="form-text">{{ __("Your workspace is your subdomain.") }}</div>
                        @error('workspace', 'register')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="register-email" class="form-label">{{ __('E-Mail') }}</label>
                        <input type="email" id="register-email" name="email" class="form-control @error('email', 'register') is-invalid @enderror" value="{{ old('email') }}" required />
                        <div id="emailHelp" class="form-text">{{ __("We'll send you an email to get started.") }}</div>
                        @error('email', 'register')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

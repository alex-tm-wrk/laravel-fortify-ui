@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="row justify-content-center">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">Profile Information</div>
                        <div class="card-body">
                            <p>Update your account's profile information and email address.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ $user->name }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                @if (session('profile_updated'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                                         style="margin-top: 0.5rem; margin-bottom: 0; padding: 0.25rem 1.25rem;">
                                        {{ session('profile_updated') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                                style="padding: 0.25rem 1.25rem;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            Update Password
                        </div>
                        <div class="card-body">
                            <p>Ensure your account is using a long, random password to stay secure.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('user-password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="password">Current Password</label>
                                        <input id="password" class="form-control" name="password" type="password"
                                               required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="new-password">New Password</label>
                                        <input id="new-password" class="form-control" name="newPassword" type="password"
                                               required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" class="form-control"
                                               name="newPassword_confirmation" type="password" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                @if (session('password_changed'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                                         style="margin-top: 0.5rem; margin-bottom: 0; padding: 0.25rem 1.25rem;">
                                        {{ session('password_changed') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                                style="padding: 0.25rem 1.25rem;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @elseif(session('password_dont_changed'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert"
                                         style="margin-top: 0.5rem; margin-bottom: 0; padding: 0.25rem 1.25rem;">
                                        {{ session('password_dont_changed') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                                style="padding: 0.25rem 1.25rem;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="dropdown-divider"></div>
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        Delete Account
                    </div>
                    <div class="card-body">
                        <p>Permanently delete your account.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-description">Once your account is deleted, all of its resources and data will be
                            permanently deleted. Before deleting your account, please download any data or information
                            that you wish to retain.</p>
                        <form class="forms-sample" action="{{ route('profile.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger mr-2 text-uppercase" data-toggle="modal"
                                    data-target="#exampleModal">Delete Account
                            </button>
                            @if (session('wrong_password'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                     style="margin-top: 0.5rem; margin-bottom: 0; padding: 0.25rem 1.25rem;">
                                    {{ session('wrong_password') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                            style="padding: 0.25rem 1.25rem;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        @endif
                        <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-2">Are you sure you want to delete your account? Once your
                                                account is deleted, all of its resources and data will be permanently
                                                deleted. Please enter your password to confirm you would like to
                                                permanently delete your account.</p>
                                            <div class="form-group mb-2">
                                                <input
                                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                                    type="password" id="confirm_password" name="confirm_password"
                                                    required autocomplete="new-password"
                                                    placeholder="{{ __('Password') }}">
                                                @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-danger mr-2 text-uppercase">Delete
                                                Account
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

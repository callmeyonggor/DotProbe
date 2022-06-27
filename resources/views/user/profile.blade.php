@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="/profile/{{ $user->id }}">
        @csrf
        <div class="card-header">Account Details</div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Name" value="{{ $user->email }}" readonly>
                    </div>
                    <label>Is Admin?</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="switch" name="switch" {{ $user->is_admin == 1 ? 'checked' : '' }} disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control" name="old_password" placeholder="Current Password" value="">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="new_password" placeholder="New Password" value="">
                    </div>
                    <div class="form-group">
                        <label>Repeat Password</label>
                        <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" value="">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-end" name="submit" value="save">Save Change</button>
    </form>
</div>
@endsection
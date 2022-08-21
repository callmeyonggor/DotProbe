@extends('layouts.app')
@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <span>{{ $error }}</span>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form method="POST" action="/profile/{{ $user->id }}">
        @csrf
        <div class="card-header">Account Details</div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                </div>
                <div class="form-group">
                    <label>Course of study/Job title</label>
                    <input type="text" class="form-control" placeholder="Course of study/Job title" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" class="form-control" name="age" placeholder="Age" required>
                </div>
                <div class="form-group">
                    <label>Height (in CM)</label>
                    <input type="number" step="any" class="form-control" name="height" placeholder="Height" required>
                </div>
                <div class="form-group">
                    <label>Weight (in KG)</label>
                    <input type="number" step="any" class="form-control" name="weight" placeholder="Weight" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Race</label>
                    {!! Form::select('race', $race_sel, @$search['race'], ['class' => 'form-control select_active']) !!}
                </div>
                <div class="form-group">
                    <label>Education Level</label>
                    {!! Form::select('education', $education_sel, @$search['education'], ['class' => 'form-control select_active']) !!}
                </div>
                <div class="form-group">
                    <label>Handedness</label>
                    {!! Form::select('handedness', $handedness_sel, @$search['handedness'], ['class' => 'form-control select_active']) !!}
                </div>
                <div class="float-end">
                    <div class="form-check form-switch">
                        <label>Is Admin?</label>
                        <input class="form-check-input" type="checkbox" id="switch" name="switch" {{ $user->is_admin == 1 ? 'checked' : '' }} disabled>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-end" name="submit" value="update_profile">Update Profile</button>
        <button type="submit" class="btn btn-light float-end" name="submit" value="cancel">Cancel</button>
    </form>
</div>
</div>

<div class="container">
    <form method="POST" action="/profile/{{ $user->id }}">
        @csrf
        <div class="card-header">Change Password</div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" class="form-control" name="old_password" placeholder="Old Password" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="new_password" placeholder="NewPassword" required>
                    </div>
                    <div class="form-group">
                        <label>Repeat Password</label>
                        <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-end" name="submit" value="change_pass">Update Password</button>
            <button type="submit" class="btn btn-light float-end" name="submit" value="cancel">Cancel</button>
    </form>
</div>
@endsection
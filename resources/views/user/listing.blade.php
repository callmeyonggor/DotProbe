@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ $submit }}">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Freetext</label>
                    <input type="text" class="form-control select_active" name="freetext" placeholder="Search for..." value="{{ @$search['freetext'] }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Role</label>
                    {!! Form::select('role', $role_sel, @$search['role'], ['class' => 'form-control select_active']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sort By (Date)</label>
                    {!! Form::select('sort', $sort_sel, @$search['sort'], ['class' => 'form-control select_active']) !!}
                </div>
            </div>
        </div>
        <div class="row float-end">
            <div class="col">
                <button type="submit" class="btn btn-primary waves-effect waves-light mr-2" name="submit" value="search">
                    Search
                </button>
                <button type="submit" class="btn btn-danger waves-effect waves-light mr-2" name="submit" value="reset">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>
<div class="container">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1
            ?>
            @foreach($user as $users)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td><a href="{{url('/statistic/'.$users['id'] )}}">{{$users['name']}}</a></td>
                <td>{{$users['email']}}</td>
                @if($users['is_admin']==0)
                <td>User</td>
                @else
                <td>Admin</td>
                @endif
                <td><button type="button" class="btn btn-danger"><a href="{{url('/profile/'.$users['id'] )}}">Edit</a></button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="position-absolute bottom-0 end-0">
        {{ $user->links() }}
    </div>
</div>
@endsection
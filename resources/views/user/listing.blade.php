@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
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
                <td><a href="/statistic/{{$users['id']}}">{{$users['name']}}</a></td>
                @if($users['is_admin']==0)
                <td>User</td>
                @else
                <td>Admin</td>
                @endif
                <td>Edit</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="position-absolute bottom-0 end-0">
    {{ $user->links() }}
    </div>
</div>
@endsection
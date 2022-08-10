@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p>Name: {{$user->name}}</p>
            <p>Attempt: {{$attempt}}</p>
        </div>
        <div class="col">
            <button class="btn btn-primary"><a href="/results/export/{{$attempt}}/{{$user->id}}">Export to Excel</a></button>
        </div>
    </div>
    <div class="record_detail_container tableFixHead">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Correctness</th>
                    <th scope="col">Congruency</th>
                    <th scope="col">Response Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1
                ?>
                @foreach($record_detail as $records)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{$records['correctness']}}</td>
                    <td>{{$records['congruency']}}</td>
                    <td>{{$records['response_time']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
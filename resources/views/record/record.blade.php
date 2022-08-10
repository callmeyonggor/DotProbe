@extends('layouts.app')

@section('content')
<div class="container">
    <p>Name: {{$user->name}}</p>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Attempt</th>
                <th scope="col">Total Correct</th>
                <th scope="col">Total Incongruents</th>
                <th scope="col">Total Congruents</th>
                <th scope="col">Average Response</th>
                <th scope="col">Average Incongruent Response</th>
                <th scope="col">Average Congruent Response</th>
            </tr>
        </thead>
        <tbody>
            @foreach($record as $records)
            <tr>
                <td><a href="/record/attempt/{{$records['attempt']}}/{{$user->id}}">{{$records['attempt']}}</a></td>
                <td> {{$records['total_correct']}}</td>
                <td> {{$records['total_incongruents']}}</td>
                <td> {{$records['total_congruents']}}</td>
                <td> {{$records['avg_response']}}</td>
                <td> {{$records['avg_incongruent_response']}}</td>
                <td> {{$records['avg_congruent_response']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="position-absolute bottom-0 end-0">
    {{ $record->links() }}
</div>

<!-- <script>
    $(document).ready(function() {
        $(".test").click(function() {
            var attempt = $(this).data('attempt');
            var userid = $(this).data('userid');
            console.log(attempt, userid);

            $.ajax({
                url: '/record/attempt'+ '/' + attempt + '/' + userid,
                success: function(data) {
                    console.log(data)
                }
            });
        });
    });
</script> -->
@endsection

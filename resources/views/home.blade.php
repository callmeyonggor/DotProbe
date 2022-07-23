@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header"><b class="fs-2">{{ __('Instruction') }}</b></div>
                <div class="overflow vh-100 p-4 bg-dark">
                    <p class="fs-3 text-white">
                        1) Click on the <b>Start</b> button at the right to start the test. <i class="fa-solid fa-angles-right"></i><br>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-2 p-5">
            <a class="animated-btn text-white" href="/test" data-toggle="tooltip" data-placement="bottom" title="Log In to Save the test result"><i class="fa fa-play"></i></a>
        </div>
    </div>
</div>

@endsection
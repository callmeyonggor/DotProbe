@extends('layouts.app')

@section('content')

<head>
    <script src="/js/scene1.js"></script>
    <script src="/js/scene2.js"></script>
    <script src="/js/scene3.js"></script>
    <script src="/js/utilities/align.js"></script>
    <script src="/js/utilities/alignGrid.js"></script>
    <script src="/js/utilities/UIBlock.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <div id="gameContainer"></div>
        <div class="loading"></div>
    </div>
    <script>
        let loop = 0;
        var startTime, endTime;
        var correctness = [];
        var response = [];
        var style = { font: "45px Times New Roman", fill: "black", align: "center" };
        const config = {
            type: Phaser.AUTO,
            scale: {
                parent: 'gameContainer',
                mode: Phaser.Scale.FIT,
                autoCenter: Phaser.Scale.CENTER_BOTH,
                width: 800,
                height: 600
            },
            transparent: true,
            scene: [Scene1, Scene2, Scene3]
        };

        const game = new Phaser.Game(config);
    </script>
</body>
@endsection
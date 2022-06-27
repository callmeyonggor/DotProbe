@extends('layouts.app')

@section('content')

<head>
    <script src="/js/scene1.js"></script>
    <script src="/js/scene2.js"></script>
    <script src="/js/scene3.js"></script>
    <script src="/js/utilities/align.js"></script>
    <script src="/js/utilities/alignGrid.js"></script>
    <script src="/js/utilities/UIBlock.js"></script>
</head>

<body>
    <div class="container">
        <div id="gameContainer"></div>
    </div>
    <script>
        const config = {
            type: Phaser.AUTO,
            autoCenter: Phaser.Scale.CENTER_BOTH,
            width: 800,
            height: 600,
            parent: 'gameContainer',
            transparent: true,
            scene: [Scene1, Scene2, Scene3]
        };

        const game = new Phaser.Game(config);
    </script>
</body>
@endsection
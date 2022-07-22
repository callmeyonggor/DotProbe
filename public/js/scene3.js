class Scene3 extends Phaser.Scene {
    constructor() {
        super('scene3');
    }

    preload() {
        this.load.image('C', '/image/c.jpg');
        this.load.image('O', '/image/o.jpg');
    }

    create(data) {
        startTime = new Date();
        var characters = 'CO';
        var position = [57, 63];
        var randposition = position[Math.floor(Math.random() * position.length)];
        var result = ""
        var chaactersLength = characters.length;

        for (var i = 0; i < 1; i++) {
            result += characters.charAt(Math.floor(Math.random() * chaactersLength));
        };

        const CButton = this.add.image(0, 0, 'C').setInteractive({ cursor: 'url(cursor/hand.cur), pointer' });
        const OButton = this.add.image(0, 0, 'O').setInteractive({ cursor: 'url(cursor/hand.cur), pointer' });

        this.aGrid = new AlignGrid({ scene: this, rows: 11, cols: 11 });
        this.text = this.add.text(0, 0, "Test Count: " + loop, { font: "20px Arial", fill: 'black' });
        this.aGrid.placeAtIndex(0, this.text);
        this.text = this.add.text(0, 0, result, style);
        this.aGrid.placeAtIndex(randposition, this.text);
        this.aGrid.placeAtIndex(102, CButton);
        this.aGrid.placeAtIndex(106, OButton);
        CButton.on('pointerdown', handler, CButton);
        OButton.on('pointerdown', handler, OButton);
        function handler() {
            end();
            if (result == this.texture.key) {
                correctness[loop] = "correct";
            } else {
                correctness[loop] = "wrong";
            }
            if (data.data == 'sad_emoji' && randposition == 63) {
                congruent[loop] = "congruent";
            }else{
                congruent[loop] = "incongruent";
            }
            loops[loop] = loop;

            this.scene.scene.start("scene1"); 
            if (loop == 120) {
                $.ajaxSetup({
                    headers:
                        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                $.ajax({
                    type: "POST",
                    url: "/result",
                    data: {
                        correctness: correctness,
                        congruent: congruent,
                        response: response,
                        loops: loops
                    },
                    success: function (data) {
                        $("#gameContainer").html(data);
                    },
                });
            }
        }

    }

    update() {

    }

}

function end() {
    endTime = new Date();
    var timeDiff = endTime - startTime;

    // get seconds 
    var ms = Math.round(timeDiff);
    response[loop] = ms;
}

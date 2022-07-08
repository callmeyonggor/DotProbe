class Scene3 extends Phaser.Scene {
    constructor() {
        super('scene3');
    }

    preload() {
        this.load.image('C', '/image/c.jpg');
        this.load.image('O', '/image/o.jpg');
    }

    create() {
        startTime = new Date();
        var characters = 'CO';
        var position = [57, 63];

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
        this.aGrid.placeAtIndex(position[Math.floor(Math.random() * position.length)], this.text);
        this.aGrid.placeAtIndex(102, CButton);
        this.aGrid.placeAtIndex(106, OButton);
        CButton.on('pointerdown', function(){
            this.scene.start("scene1");
            var value = "C";
            end(value, result)
        },this)
        OButton.on('pointerdown', function(){
            this.scene.start("scene1");
            var value = "O";
            end(value, result)
        },this)
        this.time.addEvent({
            callback: () => {
                loop++;
            }
        })
    }

    update() {
        
    }

}

function end(value, result) {
    endTime = new Date();
    var timeDiff = endTime - startTime; //in ms
    // strip the ms
    timeDiff /= 1000;

    // get seconds 
    var seconds = Math.round(timeDiff);
    console.log(seconds + " seconds");
    if (result == value) {
        console.log("Correct");
    } else {
        console.log("Wrong");
    }
}

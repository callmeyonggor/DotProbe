class Scene3 extends Phaser.Scene {
    constructor() {
        super('scene3');
    }

    preload() {

    }

    create() {
        startTime = new Date();
        console.log(startTime);
        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        var characters = 'CO';
        var position = [57, 63];

        var result = ""
        var chaactersLength = characters.length;

        for (var i = 0; i < 1; i++) {
            result += characters.charAt(Math.floor(Math.random() * chaactersLength));
        };

        var style = { font: "45px Times New Roman", fill: "black", align: "center" };
        this.aGrid = new AlignGrid({ scene: this, rows: 11, cols: 11 });
        this.text = this.add.text(0, 0, "Test Count: " + loop, { font: "20px Arial", fill: 'black' });
        this.aGrid.placeAtIndex(0, this.text);
        if (loop < 5) {
            this.text = this.add.text(0, 0, result, style);
            this.aGrid.placeAtIndex(position[Math.floor(Math.random() * position.length)], this.text);
            this.time.addEvent({
                callback: () => {
                    loop++;
                    if (isMobile) {
                        console.log("You are using Mobile");
                        this.text.setInteractive();
                        this.text.on('pointerdown', () => this.scene.start("scene1") + end())
                    } else {
                        console.log("You are using Desktop");
                        
                        this.input.keyboard.on('keydown-' + result, () => this.scene.start("scene1") + end())
                    }
                }
            })
        } else {
            this.end = this.add.text(0, 0, "Test Ended", style);
            this.aGrid.placeAtIndex(59, this.end);
        }
    }

    update() {
    }

}

function end() {
    endTime = new Date();
    var timeDiff = endTime - startTime; //in ms
    // strip the ms
    timeDiff /= 1000;
  
    // get seconds 
    var seconds = Math.round(timeDiff);
    console.log(seconds + " seconds");
}
class Scene3 extends Phaser.Scene {
    constructor() {
        super('scene3');
    }

    preload() {

    }

    create() {
        var characters = 'CO';

        var result = ""
        var chaactersLength = characters.length;

        for (var i = 0; i < 1; i++) {
            result += characters.charAt(Math.floor(Math.random() * chaactersLength));
        };
        
        var style = { font: "45px Times New Roman", fill: "black", align: "center" };
        this.aGrid = new AlignGrid({ scene: this, rows: 11, cols: 11 });
        this.text = this.add.text(0, 0, "Loop Count: " + loop, style);
        this.aGrid.placeAtIndex(0, this.text);
        if (loop < 5) {
            this.text = this.add.text(0, 0, result, style);
            this.aGrid.placeAtIndex(63, this.text);
            this.time.addEvent({
                callback: () => {
                    loop++;
                    console.log(loop);
                    this.input.keyboard.on('keydown-' + result, () => this.scene.start("scene1"))
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
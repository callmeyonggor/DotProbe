class Scene1 extends Phaser.Scene {
    constructor() {
        super('scene1');
    }
    preload() {
        this.load.image('plus', '/image/plus.png');
    }

    create() {
        if (loop != 120) {
            this.plus = this.add.image(0, 0, 'plus');
            this.aGrid = new AlignGrid({ scene: this, rows: 11, cols: 11 });
            this.aGrid.placeAtIndex(60, this.plus);
            Align.scaleToGameW(this.plus, .1);
            this.time.addEvent({
                delay: 500,
                loop: false,
                callback: () => {
                    loop++;
                    this.scene.start("scene2");
                }
            })
        } else {
            this.end = this.add.text(0, 0, "Calculating Result", style);
            this.aGrid.placeAtIndex(59, this.end);
        }
    }
}
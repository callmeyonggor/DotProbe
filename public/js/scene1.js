class Scene1 extends Phaser.Scene {
    constructor() {
        super('scene1');
    }

    preload() {
        this.load.image('plus', '/image/plus.png');
    }

    create() {
        this.plus = this.add.image(0, 0, 'plus');
        this.aGrid = new AlignGrid({scene: this,rows: 11,cols: 11});
        this.aGrid.placeAtIndex(60,this.plus);
        Align.scaleToGameW(this.plus,.1);
        this.time.addEvent({
            delay: 1000,
            loop: false,
            callback: () => {
                this.scene.start("scene2");
            }
        })
    }
}
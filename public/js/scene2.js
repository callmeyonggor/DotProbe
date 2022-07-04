class Scene2 extends Phaser.Scene {
    constructor() {
        super('scene2');
    }

    preload() {
        this.load.image('neutral_emoji', '/image/neutral.png');
        this.load.image('sad_emoji', '/image/sad.png');
    }

    create() {
        this.neutral = this.add.image(0, 0, 'neutral_emoji');
        this.sad = this.add.image(0, 0, 'sad_emoji');
        this.aGrid = new AlignGrid({scene: this,rows: 11,cols: 11});
        this.aGrid.placeAtIndex(57,this.neutral);
        this.aGrid.placeAtIndex(63,this.sad);
        Align.scaleToGameW(this.neutral,.1);
        Align.scaleToGameW(this.sad,.1);
        this.time.addEvent({
            delay: 1000,
            loop: false,
            callback: () => {
                this.scene.start("scene3");
            }
        })
    }
}
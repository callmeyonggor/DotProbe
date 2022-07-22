class Scene2 extends Phaser.Scene {
    constructor() {
        super('scene2');
    }

    preload() {
        this.load.image('neutral_emoji', '/image/neutral.png');
        this.load.image('sad_emoji', '/image/sad.png');
        this.load.image('happy_emoji', '/image/smiley.png');
    }

    create() {
        var emoji = ['sad_emoji', 'happy_emoji'];
        var rand = emoji[Math.floor(Math.random() * emoji.length)]
        this.neutral = this.add.image(0, 0, 'neutral_emoji');
        this.emotion = this.add.image(0, 0, rand);
        this.aGrid = new AlignGrid({scene: this,rows: 11,cols: 11});
        this.aGrid.placeAtIndex(57,this.neutral);
        this.aGrid.placeAtIndex(63,this.emotion);
        Align.scaleToGameW(this.neutral,.1);
        Align.scaleToGameW(this.emotion,.1);
        this.time.addEvent({
            delay: 1000,
            loop: false,
            callback: () => {
                this.scene.start("scene3", {data : rand});
            }
        })
    }
}
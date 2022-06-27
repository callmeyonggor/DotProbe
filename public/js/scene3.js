class Scene3 extends Phaser.Scene {
    constructor() {
        super('scene3');
    }

    preload() {

    }

    create() {
        var characters = 'PQ';
        // var position = '63 57';
        
        var result = ""
        var chaactersLength = characters.length;

        for (var i = 0; i < 1; i++) {
            result += characters.charAt(Math.floor(Math.random() * chaactersLength));
        };

        // var randomNumber = Math.floor(Math.random()*position);
        // console.log(randomNumber);
        var style = { font: "45px Times New Roman", fill: "black", align: "center" };
        this.text = this.add.text(0, 0, result, style);
        this.aGrid = new AlignGrid({scene: this,rows: 11,cols: 11});
        this.aGrid.placeAtIndex(63,this.text);
    }

    update() {
        // this.time.addEvent({
        //     delay: 3000,
        //     loop: false,
        //     callback: () => {
        //         this.scene.start("scene1");
        //     }
        // })
    }
}
function Game($canvas, mapSize, centerMapX, centerMapY) {
    var self = this;
    this.mapType = new MapType();
    this.spriteArea = new SpriteArea($canvas, this.mapType, mapSize, centerMapX, centerMapY);
    this.panel = [];
    this.init = function() {
        $( window ).resize(self.spriteArea.initSize);
        this.mapType.onLoad(self.initTimer);
    };
    this.initTimer = function() {
        self.spriteArea.initSize();
        createjs.Ticker.timingMode = createjs.Ticker.RAF;
        createjs.Ticker.addEventListener("tick", self.spriteArea.tick);
    };
    this.init();
}

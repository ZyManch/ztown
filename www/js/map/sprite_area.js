function SpriteArea($canvas, mapType, mapSize, centerMapX, centerMapY) {
    var self = this;
    this.stage = null;
    this.mapType = mapType;
    this.mapSize = mapSize;
    this.width = 0;
    this.height = 0;
    this.spriteWidth = 92;
    this.spriteHeight = 48;
    this.centerMapX = centerMapX;
    this.centerMapY = centerMapY;
    this.halfMapWidth = 0;
    this.halfMapHeight = 0;
    this.sprites = {};
    this.map = new Map(mapSize);
    this.previousMouseX = 0;
    this.previousMouseY = 0;
    this.refreshZIndex = false;
    this.refreshPositions = false;
    this.refreshCanvas = false;
    this.preloadWidth = 0;
    this.preloadHeight = 5;
    this.init = function() {
        this.stage = new createjs.Stage($canvas.attr('id'));
        this.stage.enableMouseOver();
        this.stage.mouseMoveOutside = true;
        this.stage.addEventListener("stagemousedown", this.startMoveMap);
    };
    this.startMoveMap = function() {
        self.previousMouseX = self.stage.mouseX;
        self.previousMouseY = self.stage.mouseY;
        self.stage.addEventListener("stagemouseup", self.stopMoveMap);
        self.stage.addEventListener("stagemousemove", self.moveMap);
    };
    this.stopMoveMap = function() {
        self.stage.removeEventListener("stagemouseup", self.stopMoveMap);
        self.stage.removeEventListener("stagemousemove", self.moveMap);
        self.refreshZIndex = true;
        self.refreshPositions = true;
        self.refreshCanvas = true;
    };
    this.moveMap = function() {
        var dx = self.stage.mouseX-self.previousMouseX,
            dy = self.stage.mouseY-self.previousMouseY;
        self.centerMapX-=dx/self.spriteWidth-dy/self.spriteHeight;
        self.centerMapY-=2*dy/self.spriteHeight;
        self.previousMouseX = self.stage.mouseX;
        self.previousMouseY = self.stage.mouseY;
        self.refreshZIndex = true;
        self.refreshPositions = true;
        self.refreshCanvas = true;
    };
    this.initSize = function() {
        self.stage.regX  = -Math.round($canvas.width()/2);
        self.stage.regY  = -Math.round($canvas.height()/2);
        self.width = $canvas.width();
        self.height = $canvas.height();
        self.halfMapWidth = Math.ceil(self.width/2/(self.spriteWidth/2))+self.preloadWidth;
        self.halfMapHeight = Math.ceil(self.height)/2/(self.spriteHeight/2)+self.preloadHeight;
        self.refreshZIndex = true;
        self.refreshPositions = true;
        self.refreshCanvas = true;
    };
    this.getPositionForXY = function(mapX, mapY) {
        return {
            x:  (mapX - self.centerMapX) * self.spriteWidth + (mapY - self.centerMapY)* self.spriteWidth/2,
            y:   (mapY - self.centerMapY) * self.spriteHeight/2
        };
    };
    self.getSprite = function(mapX, mapY) {
        if (typeof self.sprites[mapX] === 'undefined') {
            return null;
        }
        if (typeof self.sprites[mapX][mapY] === 'undefined') {
            return null;
        }
        return self.sprites[mapX][mapY];
    };
    self.addSprite = function(mapX, mapY, x, y, map) {
        var sprite = new Sprite(self, map, x,y ,mapX, mapY);
        if (typeof self.sprites[mapX] === 'undefined') {
            self.sprites[mapX] = {};
        }
        self.sprites[mapX][mapY] = sprite;
    };
    this.removeSprite = function (mapX, mapY) {
        self.sprites[mapX][mapY].remove();
        delete self.sprites[mapX][mapY];
    };
    this.processAllSprites = function(callback) {
        $.each(self.sprites,function(mapX, ySprites) {
            $.each(ySprites,function(mapY, sprite) {
                callback(mapX, mapY, sprite);
            });
        });
    };
    this.processCurrentSprites = function(callback) {
        var i,j;
        for (i=-self.halfMapWidth;i<=self.halfMapWidth;i++) {
            for (j=-self.halfMapHeight;j<=self.halfMapHeight;j++) {
                callback(Math.floor(self.centerMapX+i),Math.floor(self.centerMapY+j))
            }
        }
    };
    this.isVisible = function(mapX, mapY) {
        return mapX >= self.centerMapX - self.halfMapWidth &&
            mapX <= self.centerMapX + self.halfMapWidth &&
            mapY >= self.centerMapY - self.halfMapHeight &&
            mapY <= self.centerMapY + self.halfMapHeight
    };
    this.refreshSprites = function() {
        self.processAllSprites(function(mapX, mapY) {
            if (!self.isVisible(mapX, mapY)) {
                self.removeSprite(mapX, mapY)
            }
        });
        self.processCurrentSprites(function(mapX, mapY) {
            self.map.processMap(
                mapX,
                mapY,
                function(mapX,mapY, map) {
                    if (!map) {
                        return;
                    }
                    var position = self.getPositionForXY(mapX, mapY);
                    var sprite = self.getSprite(mapX, mapY);
                    if (sprite) {
                        sprite.updatePosition(position.x, position.y);
                    } else {
                        self.addSprite(mapX, mapY, position.x, position.y, map);
                    }
                    self.refreshZIndex = true;
                    self.refreshCanvas = true;
                }
            )
        });
        self.refreshCanvas = true;
    };
    this.tick = function() {
        if (self.refreshPositions) {
            self.refreshPositions = false;
            self.refreshSprites();
            console.log('refresh sprites');
        }
        if (self.refreshZIndex) {
            self.refreshZIndex = false;
            self.stage.sortChildren(function(a,b) {
                if (a.zIndex < b.zIndex) return -1;
                if (a.zIndex > b.zIndex) return 1;
                return 0;
            });
            console.log('refresh zIndex');
        }
        if (self.refreshCanvas) {
            self.refreshCanvas = false;
            self.stage.update();
            console.log('refresh canvas');
        }
    };
    this.init();
}

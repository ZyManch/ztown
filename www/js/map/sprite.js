function Sprite(spriteArea, map, left, top, mapX, mapY) {
    var self = this;
    this.left = left;
    this.top = top;
    this.spriteWidth = 92;
    this.spriteHeight = 48;
    this.land = null;
    this.house = null;
    this.text = null;
    this.hints = [];
    this.init = function() {
        self.createLand();
        // self.createXY();
        self.createHouse();
        self.updatePosition(left, top);
    };
    this.createLand = function() {
        self.land = new createjs.Sprite(
            spriteArea.mapType.getTile(map['land_type_id'])
        );
        self.land.gotoAndStop("normal");
        self.land.zIndex  = mapY-5;
        if (!map['enabled']) {
            self.land.alpha = 0.5;
        }
        spriteArea.stage.addChild(self.land);
    };
    this.createXY = function() {
        self.text = new createjs.Text(mapX+'-'+ mapY, "14px Arial", "#000000");
        self.text.regX = 10;
        self.text.regY = 10;
        self.text.zIndex  = mapY+1;
        spriteArea.stage.addChild(self.text);
    };
    this.createHouse = function() {
        if (!map['map_type_id']) {
            return;
        }
        self.house = new createjs.Sprite(
            spriteArea.mapType.getTile(map['map_type_id'])
        );
        self.statusDefault();
        self.house.zIndex  = mapY;
        self.house.cursor  = 'pointer';
        self.house.gotoAndStop("normal");
        self.house.on('mouseover',function() {
            self.statusHover();
            self.showHint();
        });
        self.house.on('mouseout',function() {
            self.statusDefault();
            self.hideHint();
        });
        self.house.on('click',function() {
            if (map['controller']!=='') {
                location.href = '/'+map['controller']+'/view?x='+mapX+'&y='+mapY;
            }
        });
        self.statusDefault();
        spriteArea.stage.addChild(self.house);
    };
    this.statusDefault = function() {
        if (!map['enabled']) {
            self.house.alpha = 0.5;
        }
        spriteArea.refreshCanvas = true;
    };
    this.statusHover = function() {
        self.house.gotoAndStop("normal");
        spriteArea.refreshCanvas = true;
    };
    this.updatePosition = function(left,top) {
        self.left = left;
        self.top = top;
        self.move(0, 0);
    };
    this.showHint = function() {
        if (!map['controller']) {
            return;
        }
        var width = 200,
            height = 100,
            x = self.left > 0 ? self.left - width - self.spriteWidth/2 : self.left + self.spriteWidth/2,
            y = self.top > 0 ? self.top - height- self.spriteHeight/2 : self.top + self.spriteHeight/2;


        var box = new createjs.Shape(
            new createjs.Graphics().beginFill("#ffffff").drawRoundRect(0, 0, width, height, 5)
        );
        box.shadow = new createjs.Shadow("#000000", 2, 2, 5);
        box.x = x;
        box.y = y;
        box.zIndex = mapY + 99;
        self.hints.push(box);
        spriteArea.stage.addChild(box);

        var title = new createjs.Text(spriteArea.mapType.getTitle(map['map_type_id']), "20px Arial", "#000000");
        title.maxWidth = width-10;
        title.x = x+5;
        title.y = y+5;
        title.zIndex = mapY + 100;
        self.hints.push(title);
        spriteArea.stage.addChild(title);

        var description = new createjs.Text(spriteArea.mapType.getDescription(map['map_type_id']), "14px Arial", "#000000");
        description.maxWidth = width-10;
        description.x = x+5-30;
        description.y = y+25;
        title.zIndex = mapY + 101;
        self.hints.push(description);
        spriteArea.stage.addChild(description);

        spriteArea.refreshZIndex = true;
        spriteArea.refreshCanvas = true;
    };
    this.hideHint = function() {
        $.each(self.hints, function() {
            spriteArea.stage.removeChild(this);
        });
        self.hints = [];
        spriteArea.refreshZIndex = true;
        spriteArea.refreshCanvas = true;
    };
    this.move = function(dx,dy) {
        self.left+=dx;
        self.top+=dy;
        self.land.x = self.left;
        self.land.y = self.top;
        if (self.text) {
            self.text.x = self.left;
            self.text.y = self.top;
        }
        if (self.house) {
            self.house.x = self.left;
            self.house.y = self.top;
        }
        return true;
    };
    this.remove = function() {
        spriteArea.stage.removeChild(self.land);
        if (self.text) {
            spriteArea.stage.removeChild(self.text);
        }
        if (self.house) {
            spriteArea.stage.removeChild(self.house);
        }
    };
    this.init();
}

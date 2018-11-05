
function MapType() {
    var self = this;
    this.spriteWidth = 92;
    this.spriteHeight = 48;
    this._loadComplete = false;
    this._onLoadCallback = null;
    this._cache = {};
    this.loader = null;
    this.manifest = [];
    this._getManifest = function() {
        var manifest = [];
        $.each(self.manifest,function(mapTypeId, info) {
            manifest.push({src: info['image'],id: 'tile'+info['map_type_id']});
        });
        return manifest;
    };
    this.init = function() {
        self._loadManifest(
            self._loadImages
        );
    };
    this._loadManifest = function(callback) {
        $.get('/map-type/tiles',function(result) {
            self.manifest = result['tiles'];
            callback();
        })
    };
    this._loadImages = function() {
        self.loader = new createjs.LoadQueue(false);
        self.loader.addEventListener("complete", self._handleComplete);
        self.loader.loadManifest(self._getManifest(), true, "/images/");
    };
    this._handleComplete = function() {
        self._loadComplete = true;
        if (self._onLoadCallback) {
            self._onLoadCallback();
        }
    };
    this.onLoad = function(callback) {
        if (self._loadComplete) {
            callback();
        } else {
            self._onLoadCallback = callback;
        }
    };
    this.getTile = function(mapTypeId) {
        if (typeof self._cache['tile'+mapTypeId] === 'undefined') {
            var info = self.manifest[mapTypeId];
            self._cache['tile'+mapTypeId] = new createjs.SpriteSheet({
                "framerate": 30,
                "images": [
                    self.loader.getResult('tile'+mapTypeId)
                ],
                "frames": [
                    // x, y, width, height, imageIndex*, regX*, regY*
                    [0,0,info['width'],info['height'],0,info['width']/2,info['height']-self.spriteHeight/2],
                ],
                "animations": {
                    "normal": 0
                }
            });
        }
        return self._cache['tile'+mapTypeId];

    };
    this.getTitle = function(mapTypeId) {
        return self.manifest[mapTypeId]['title']
    };
    this.getDescription = function(mapTypeId) {
        return self.manifest[mapTypeId]['description']
    };
    this.init();
}


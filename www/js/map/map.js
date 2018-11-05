function Map(mapSize) {
    var self = this;
    this.mapSize = mapSize;
    this.map = {};
    this.processMap = function(x,y, callback) {
        if (self._isNeedLoadMap(x, y)) {
            self._loadMap(x, y, callback);
            callback(x, y, null);
        } else if (this.map[x][y] === null) {
            callback(x, y, null);
        } else {
            callback(x, y, this.map[x][y]);
        }
    };
    this._isNeedLoadMap = function(x, y) {
        if (typeof this.map[x] === 'undefined') {
            return true;
        }
        if (typeof this.map[x][y] === 'undefined') {
            return true;
        }
        return false;
    };
    this._markMapAsLoading = function(x,y) {
        for (var i = x; i < x + self.mapSize; i++) {
            if (typeof self.map[i] === 'undefined') {
                self.map[i] = {};
            }
            for (var j = y; j < y + self.mapSize; j++) {
                if (typeof self.map[i][j] === 'undefined') {
                    self.map[i][j] = null;
                }
            }
        }
    };
    this._loadMap = function(x,y, callback) {
        var newX = Math.floor(x/self.mapSize) * self.mapSize;
        var newY = Math.floor(y/self.mapSize) * self.mapSize;
        self._markMapAsLoading(newX, newY);
        $.get('/maps/load',{x:newX, y:newY},function(result) {
            if (typeof result['maps'] === 'undefined') {
                return;
            }
            self._fillMaps(result['maps'], callback);
        });
    };
    this._fillMaps = function(maps, callback) {
        $.each(maps, function(x, value) {
            $.each(value, function(y, map) {
                self.map[x][y] = map;
                callback(x,y,map);
            });
        });
    }
}

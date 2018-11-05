(function($, window) {

    var users = {};
    var timer = null;
    var pos = 0;
    var blocks = [];
    var attacks = [];

    var tick = function() {
        if(pos==-1){
            clearInterval(timer);
        }else{
            blocks.filter('.td'+pos).slideDown('fast');
            for(var i in attacks[pos]) {
                users[i].changeHp(attacks[pos][i]);
            }
            pos--;
        }
    }

    $.fn.initUser = function(userId, maxHp) {
        var $this = $(this);
        users[userId] = $this;
        $.data($this, 'maxHp', maxHp);
        $.data($this, 'curHp', maxHp);
        $.data($this, 'text', $this.children('.text'));
        $.data($this, 'bar', $this.children('.hp'));
        return $this;
    }
    $.fn.changeHp = function(damage) {
        var $this = this;
        var curHp = $.data($this, 'curHp');
        var maxHp = $.data($this, 'maxHp');
        curHp = Math.max(curHp-damage, 0);
        $.data($this, 'curHp', curHp);
        $.data($this, 'text').html(curHp+'/'+maxHp);
        $.data($this, 'bar').css('width',Math.round(100*curHp/maxHp)+'%');
        return $this;
    }

    $.fn.battle = function(list) {
        blocks = this;
        attacks = list;
        pos = list.length - 1;
        timer = setInterval(tick, 1000);
    }
})(jQuery, window);
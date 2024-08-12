function clock() {
    var dateTime = new Date();
    var jm = dateTime.getHours();
    var mnt = dateTime.getMinutes();
    var dtk = dateTime.getSeconds();

    Number.prototype.pad = function (digits) {
        for (var n = this.toString(); n.length < digits; n = 0 + n);
        return n;
    }

    document.getElementById('jam').innerHTML = jm.pad(2);
    document.getElementById('menit').innerHTML = mnt.pad(2);
    document.getElementById('detik').innerHTML = dtk.pad(2);

}
setInterval(clock, 10);


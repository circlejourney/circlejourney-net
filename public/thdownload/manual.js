cjdl = { lbl: $('.character-name-badge'), rqs: [], cjsetInt: null, full: false };
var cjfn = function () {
    if (cjdl.rqs.length >= cjdl.lbl.length) {
        $('#cjstop').text('Stop and close');
        cjtoggleint();
        return false;
    }
    
    let lnk = cjdl.lbl[cjdl.rqs.length];
    cjdl.rqs.push($.get(lnk.href, function (data) {
        if(!cjdl.full) data = $(data).find('.profile-content-content')[0].innerHTML;
        let htmlfile = new Blob([data], { type: 'text/plain;charset=utf-8' });
        const id = lnk.href.match(/([0-9]+)\./)[1];
        let ttl = lnk.innerText + " - " + id + '.html';
        if (window.navigator.msSaveOrOpenBlob) window.navigator.msSaveOrOpenBlob(htmlfile, ttl);
        else {
            let url = URL.createObjectURL(htmlfile);
            lnk.href = url;
            lnk.download = ttl;
            lnk.click();
            URL.revokeObjectURL(url);
        }
    }))
};
function cjtoggleint() {
    cjdl.full = false;
    $("#cjstopfull").remove();
    if ($('#cjstop').text() == 'Stop and close') {
        cjdl.lbl = null;
        clearInterval(cjdl.cjsetInt);
        $.each(cjdl.rqs, function (i, val) { val.abort() });
        $('#cjstop').remove();
    } else {
        cjdl.cjsetInt = setInterval(cjfn, 2000);
        $('#cjstop').text('Stop and close');
    }
};

function cjtoggleintfull() {
    cjdl.full = true;
    $("#cjstop").remove();
    if ($('#cjstopfull').text() == 'Stop and close') {
        cjdl.lbl = null;
        clearInterval(cjdl.cjsetInt);
        $.each(cjdl.rqs, function (i, val) { val.abort() });
        $('#cjstopfull').remove();
    } else {
        cjdl.cjsetInt = setInterval(cjfn, 2000);
        $('#cjstopfull').text('Stop and close');
    }
};

dldiv = $("<div style=\'position:fixed;top:10px;left:10px;z-index:100;\'></div>")
    .append($('<a class=\'btn-lg btn-warning d-block\' id=\'cjstop\' href=\'#\' style=\'box-shadow:0 0 5px black;border:5px solid white\'>Start download (raw HTML)</a>').click(cjtoggleint))
    .append($('<a class=\'btn-lg btn-warning d-block mt-1\' id=\'cjstopfull\' href=\'#\' style=\'box-shadow:0 0 5px black;border:5px solid white\'>Start download (full webpages)</a>').click(cjtoggleintfull));
$(document.body).append(dldiv);
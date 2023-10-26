let rqs = [];
let cjsetInt;
const parser = new DOMParser();

function toggleQueue() {
    if ($('#cjstop').text() == 'Stop queue') {
        $.each(rqs, function (i, val) { val.abort() });
        rqs = [];
        clearInterval(cjsetInt);
        $('#cjstop').text('Queue all for download');
    } else {
        cjsetInt = setInterval(step, 2000);
        $('#cjstop').text('Stop queue');
    }
};

function step() {
    if (rqs.length >= data.length) {
        $('#cjstop').text('Stop queue');
        toggleQueue();
        return false;
    }
    let profile = data[rqs.length];
    rqs.push(startDownload(profile.url, profile.name, $("#only-custom").prop("checked")));
}

function startDownload(url, name, onlyCustom=false) {
    return $.get("/thdownload/fetchprofile.php", {"url": url}, function(response) {
        if(onlyCustom) {
            const custom = parser.parseFromString(response, "text/html").body.getElementsByClassName("profile-content-content");
            response = custom[0].innerHTML;

        }
        let filename;
        if(id = url.match(/([0-9]+)\./)) filename = name + " - " + id[1] + ".html";
        else filename = name + ".html";
        downloadAsFile(response, filename);
    })
}

function downloadAsFile(payload, title="text.txt") {
    let htmlfile = new Blob([payload], { type: 'text/plain;charset=utf-8' });
    let filename = title;
    if (window.navigator.msSaveOrOpenBlob) {
        window.navigator.msSaveOrOpenBlob(htmlfile, ttl);
        return true;
    }
    let url = URL.createObjectURL(htmlfile);
    lnk = document.createElement("a");
    lnk.href = url;
    lnk.download = filename;
    lnk.click();
    URL.revokeObjectURL(url);
}
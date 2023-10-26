@extends("layouts.app")

@section("html_title"){{ "Toyhouse HTML Mass-Downloader" }}@endsection

@push("head")
<meta name="description" content="Circlejourney's Toyhouse profile HTML mass downloader. Download all your profiles in a few clicks.">
<meta name="og:description" content="Circlejourney's Toyhouse profile HTML mass downloader. Download all your profiles in a few clicks.">

        <link id="theme-css" href="https://th.circlejourney.net/src/site_black-forest.css?2" rel="stylesheet">
        <style>
            iframe {
                width: 100vw; height: 100vh;
            }

            .hidden {
                display: none;
            }

            .profile-row {
                margin-bottom: 0.5em;
            }

            .profile-button, .profile-label {
                margin-right: 0.6em;
            }

        </style>
        <script src="/thdownload_src/thdownload.js?v={{ filemtime("thdownload_src/thdownload.js") }}"></script>
        <script>
            let data;

            function get(user) {
                $(".list-container").html("Profile list is being fetched (it can take a while if you have a lot of characters)... <i class='fa fa-hourglass fa-spin'><i>");
                $(".queue-interface").addClass("hidden");

                $.get("/thdownload/get.php", { "user": user }, function(d){
                    data = d;
                    if(data.error) {
                        $(".list-container").html(data.error);
                        return false;
                    }
                    $(".list-container").empty();
                    $(".queue-interface").removeClass("hidden");
                    data.forEach(function(item){
                        const link = $("<a></a>")
                            .attr("href", "https://toyhou.se/"+item.url)
                            .attr("target", "_blank")
                            .text("/"+item.url)
                            .addClass("profile-link");
                        const label = $("<span></span>").html(item.name).addClass("profile-label");
                        const button = $("<button>Download</button>")
                            .addClass("profile-button btn btn-secondary")
                            .click(function(e){
                                e.preventDefault();
                                startDownload(item.url, item.name, $("#only-custom").prop("checked"));
                            });
                        $(".list-container").append($("<div class='profile-row'></div>").append(button, label, link));
                    });
                });
            }

        </script>
@endpush

@section("body")
        <div class="container p-4">
            <h2>Toyhouse profile HTML mass-downloader (beta!!)</h2>
            <p style="font-size: 10pt"><b>Download all your OC profile HTML with just a few clicks!</b> To enable download for your characters, add <code>&lt;u id="allow-thcj-import">&lt;/u></code> to your user profile (you can remove it after). By default, this app can only fetch public character profiles, but you can let it "see" your private characters by authorising my bot account, <a href="https://toyhou.se/fuchsiamoonrise">fuchsiamoonrise</a> (100% optional). Inspired by <a href="https://erayalkis.github.io/toyhouse_downloader/">Erayalkis' TH gallery downloader</a>.</p>
            
            <p style="font-size: 10pt">Feel free to <a href="https://toyhou.se/~messages/create/circlejourney">send me a DM on Toyhouse</a> with feedback or bug reports! I'm planning on adding CSS download eventually, if there's enough interest.</p>
            <p class="form-inline">
                <input class="form-control" id="username" type="text" placeholder="Username">
                <button class="btn btn-primary" onclick="get($('#username').val())">Fetch character profiles</button>
            </p>
            
            <p class="queue-interface hidden">
                <input type="radio" id="only-custom" value="0" name="onlyCustom"> <label for="only-custom">Download raw custom HTML</label>
                <input type="radio" id="download-all" value="1" name="onlyCustom" checked="checked"> <label for="download-all">Download whole webpage</label>
                <br>
                <button class="btn btn-primary" id='cjstop' href='#' onclick="toggleQueue()">
                    Queue all for download
                </button>
            </p>

            <div class="list-container">
            </div>
        </div>
@endsection
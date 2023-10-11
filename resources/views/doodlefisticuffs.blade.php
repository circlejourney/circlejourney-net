@extends('layouts.app')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arvo;
        }

        #blood {
            --accent: #D0456C;
        }

        .team-border {
            border-top: 4px solid black;
            border-bottom: 4px solid black;
            height: 12px;
        }
        
        .team-title {
        }

        .char-image {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            text-align: center;
            width: 100%;
            height: 100%;
            min-height: 250px;
            background-size: cover;
            background-position: center;
            text-decoration: none;
        }

        .char-label {
            padding-top: 1em;
            background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,0.8));
            color: white;
        }

        .char-image.ace {
            border: 4px solid var(--accent);
        }

        .char-image.ace-pair {
            border: 4px dashed var(--accent);
        }

        .team-subheading {
            font-family: Arvo, sans-serif;
            display: inline-block;
            background-color: #0F0F12;
            color: white;
        }

        .pagedoll {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 10vw;
        }

        .pagedoll:hover {
            transform: scale(105%) rotate(2deg);
        }

    </style>
@endpush

@section("body")
    <div class="main container px-5">
        <h2 class="text-center">Doodle Fisticuffs time</h2>

        <div class="card" id="blood" style="background-image: url(https://i.postimg.cc/Qdhr1CYV/spiralstransparent.png), linear-gradient(to bottom, #C8ADAF, #E1D7D7); background-size: 20%, cover;">
            <div class="d-flex align-items-center py-2">
                <div class="team-border flex-grow-1"></div>

                <img class="team-title w-25 m-2" src="/images/df/teambloodlogolong.png">
                
                <div class="team-border flex-grow-1"></div>
            </div>

            <div class="row p-4 g-2">

                <div class="col-12 col-lg-7">
                    <div class="row g-0">
                        
                        <div class="col-4">
                            <a class="char-image ace" href="https://toyhou.se/1779921.vesper" style="background-image: url(https://file.toyhou.se/images/10926513_rhxnMTFJ22lXRvZ.png);">
                                <span class="char-label">
                                    Vesper (ace who is literally ace)
                                </span>
                            </a>
                        </div>
                        <div class="col-4">
                            <a
                                href="https://toyhou.se/1820973.marcia"
                                class="char-image ace-pair"
                                style="background-image: url(https://file.toyhou.se/images/7241402_tHRF30oaigp0JNZ.png); background-size: auto 120%;">
                                <span class="char-label">Marcia (ace pair with Vesper)</span>
                            </a>
                        </div>
                        <div class="col-4">
                            <a
                                href="https://toyhou.se/19563604.xye"
                                class="char-image"
                                style="background-image:url(https://f2.toyhou.se/file/f2-toyhou-se/images/63065715_gRrIEfFnTqdcjzL.jpg?1683271940)">
                                <span class="char-label">Xye</span>
                            </a>
                        </div>
                        <div class="col-4">
                            <a
                                href="https://toyhou.se/19650517.zera"
                                class="char-image w-100" style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/64163410_dMXHD4CD7PMOUp1.jpg?1683270879)">
                                <span class="char-label">Zera</span>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="char-image w-100" href="https://toyhou.se/1872046.pala" style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/58104908_sRdXq9H41Ng5WHt.jpg?1683274981)">
                                <span class="char-label">Pala</span>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="char-image w-100" href="https://toyhou.se/1941234.fen" style="background-image: url(https://file.toyhou.se/images/8275935_Mwrez6VLiCebr8g.png?1530587673)">
                                <span class="char-label">Fen</span>
                            </a>
                        </div>

                    </div>

                    <a href="https://toyhou.se/TenTen" data-toggle="tooltip" title="Mascot art by TenTen">
                        <img class="pagedoll" src="/images/df/teambloodmascot.png">
                    </a>

                </div>

                <div class="col-12 col-lg-5">
                    <h3 class="team-subheading">Username</h3>
                    <p>circlejourney</p>
                    <h3 class="team-subheading">Notes</h3>
                    <p>Elit aliqua nulla minim fugiat adipisicing eu. Elit irure reprehenderit sunt sit aliquip ex nostrud do voluptate proident ex veniam et. Amet mollit eu ipsum veniam. Labore commodo enim excepteur laborum minim enim dolore in pariatur.</p>
                </div>

            </div>

        </div>


    </div>
@endsection
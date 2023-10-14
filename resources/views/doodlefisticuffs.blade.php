<?php $usagenotes = "<p><b>Notes.</b> You can change hairstyles, outfits, and all design details that the character themself can change. Don't change skin tones or body types.</p><p>Click on the relationship labels to view more info about the characters / relationship. Click on the portraits to open their Toyhouse profiles.</p>"; ?>

@extends('layouts.app')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<script>
		$(document).ready(function(){
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl)
			});
		});
	</script>
	<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=PT+Serif&display=swap" rel="stylesheet">
    <style>

		:root {
			--border-radius: 10px;
            --box-shadow: 1px 1px 3px rgba(0,0,0,0.4);
			--black: #0F0F12;
            --transition: 0.1s all linear;
		}

        body {
			background: var(--black);
            font-family: "PT Serif", serif;
			font-size: 13pt;
        }

        .display {
            font-size: 15pt;
        }

        hr {
            border-style: dashed;
        }

		h1, h2, h3, h4, h5 {
			font-family: "DM Serif Display", serif;
		}

		a {
			color: var(--accent);
		}

        #blood {
            --accent: #A93354;
			--accent-light: #FF6E97;
        }

        #tears {
            --accent: #1E897F;
			--accent-light: #B4E5E0;
        }

        .card {
            position: relative;
            overflow: hidden;
            border: 8px solid var(--accent);
            padding: 2rem;
            background-image: repeating-linear-gradient(45deg, rgba(0,0,0,0.3), rgba(0,0,0,0.3) 10px, transparent 10px, transparent 20px);
        }

        .accent-icon {
            position: absolute;
            font-size: 300pt;
            -webkit-text-stroke: 4px var(--accent);
            color: transparent; opacity: 0.2;
            line-height: 1em;
            top: -10%;
            left: -10%;
        }

        .stripes {
            border-top: 8px dotted var(--accent);
        }

        .team-title img {
            max-height: 100px;
            max-width: 100%;
        }

		.nametag {
			font-family: "DM Serif Display", serif;
            letter-spacing: 1px;
			border-radius: var(--border-radius);
			display: inline-block;
			background-color: var(--black);
			color: white;
		}

        .header, .content {
            z-index: 2;
        }

        .char-area {
            border-radius: var(--border-radius);
            overflow: hidden;
            background-image: url(https://i.postimg.cc/R0LfhNpf/triangles.png);
            box-shadow: var(--box-shadow);
        }

        .char-column {
            height: 600px;
            display: flex;
        }

        .char-image {
            flex-grow: 1;
            flex-basis: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            text-align: center;
            width: 100%;
            background-size: cover;
            background-position: top;
			background-repeat: no-repeat;
            text-decoration: none;
            overflow: hidden;
        }

        .char-label {
			font-size: 14pt;
            padding: 1.8em 0 1em;
            background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1));
            color: white;
            transition: var(--transition);
        }
        
        .char-image:hover .char-label {
            color: var(--accent-light);
            padding-bottom: 1.8em;
            padding-top: 2.4em;
        }

		.ace-text {
			color: var(--accent-light);
		}

		.ace-text::before {
			content: "⭑";
		}

        .char-image.ace {
            border: 4px solid var(--accent);
        }

        .char-image.ace:nth-of-type(1) {
            border-top-left-radius: var(--border-radius);
            border-bottom: none;
        }

        .char-image.ace:nth-of-type(2) {
            border-bottom-left-radius: 10px;
            border-top: none;
        }

		.relationship-cell {
			height: 0;
			z-index: 2;
			text-align: center;
			display: flex;
			align-items: center;
			justify-content: center;
            background-color: var(--accent);
		}

		.relationship-label {
			padding: 0.1rem;
			border-radius: var(--border-radius);
			background-color: var(--accent);
			color: white;
			text-decoration: none;
            border: 0px solid transparent;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
		}

		.relationship-label:hover, .relationship-label.active {
			border: 3px solid white;
		}

        .pagedoll {
            position: absolute;
            bottom: 5px;
            right: 5px;
            height: 120px;
            filter: drop-shadow(var(--box-shadow));
        }

        .info {
            padding-bottom: 4rem;
        }

		.info-heading {
			font-family: "DM Serif Display", serif;
			padding: 0.1rem;
			display: inline-block;
			background-color: var(--accent);
			color: white;
		}

        .info-links::before {
            content: "▸";
        }

        .info-links {
            display: inline-block;
            font-size: 11pt;
        }

        .pagedoll:hover {
            transform: scale(105%) rotate(2deg);
        }

        .roster {
            display: flex;
            flex-wrap: wrap;
            background: white;
        }

        .roster-slot {
            width: 25%;
            padding: 0.2rem;
        }

        .portrait {
            width: 100%;
            border-radius: 50%;
            box-shadow: var(--box-shadow);
        }

        .blood-portrait {
            border: 4px solid #A93354;
        }

        .tears-portrait {
            border: 4px solid #1E897F;
        }

    </style>
@endpush

@section("body")
    <div class="main container p-lg-5">

        <div class="roster w-50 m-auto d-none">
            <div class="roster-slot">
                <img class="portrait blood-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/1872046?1589171661">
            </div>
            <div class="roster-slot">
                <img class="portrait blood-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/1941234?1589039025">
            </div>
            <div class="roster-slot">
                <img class="portrait blood-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/19563604?1682417737">
            </div>
            <div class="roster-slot">
                <img class="portrait blood-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/19650517?1682418105">
            </div>
            <div class="roster-slot">
                <img class="portrait blood-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/2037696?1683810738">
            </div>
            <div class="roster-slot">
                <img class="portrait blood-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/2628384?1603632476">
            </div>
            <div class="roster-slot">
                <img class="portrait tears-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/17040769?1693553088">
            </div>
            <div class="roster-slot">
                <img class="portrait tears-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/17040760?1678451834">
            </div>
            <div class="roster-slot">
                <img class="portrait tears-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/20918922?1680523577">
            </div>
            <div class="roster-slot">
                <img class="portrait tears-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/5864645?1579713234">
            </div>
            <div class="roster-slot">
                <img class="portrait tears-portrait" src="https://f2.toyhou.se/file/f2-toyhou-se/characters/1779921?1573488244">
            </div>
            <div class="roster-slot">
                <img class="portrait tears-portrait" src="https://file.toyhou.se/characters/1820973?1530080699">
            </div>
        </div>

        <br>
		
		<!-- BEGIN TEARS CARD -->
        <div class="card" id="tears" style="background-image: repeating-linear-gradient(45deg, #d2ecea, #d2ecea 25px, transparent 25px, transparent 50px), linear-gradient(to bottom, #C5E9E6, #CEEDEA);">
            
            <div class="accent-icon">
                <i class="far fa-fw fa-face-sad-tear"></i>
            </div>

			<a href="https://toyhou.se/TenTen">
				<img class="pagedoll" src="/images/df/teamtearsmascot.png" data-bs-toggle="tooltip" data-bs-placement="top" title="Mascot art by TenTen">
			</a>

            <div class="header d-flex align-items-center py-2">
                <div class="stripes flex-grow-1"></div>

                <div class="team-title m-2 d-flex flex-column">
					<img class="d-block mb-2" src="https://rebuild.circlejourney.net/images/df/teamtearslogolong.png">
					<p class="nametag text-center">User &bull; Circlejourney</p>
				</div>
                
                <div class="stripes flex-grow-1"></div>
            </div>

            <div class="content row p-4 g-3">

                <div class="col-12 col-md-7">
                    <div class="char-area row g-0 nav">
                    
                        <div class="char-column col-12 col-lg-4 flex-column">
                            <a class="char-image ace"
								href="https://toyhou.se/17040769.anqien"
								target="_blank"
								style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/70094062_AAHIYVwzJC1QnV9.jpg);">
                                <div class="char-label">
                                    Anqien <span class="ace-text">ace</span> <span class="ace-text">ace pair<span>
								</div>
                            </a>
							
							<div class="relationship-cell">							
								<a class="relationship-label nav-item" data-bs-toggle="tab" href="#tab-4">
									<i class="relationship-arrows fa fa-arrows-up-down"></i>
									Teammates...in love
								</a>
							</div>
							
                            <a
                                href="https://toyhou.se/17040760.jinai"
								target="_blank"
                                class="char-image ace"
                                style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/64022461_lHvIO8aaKoRUTXM.jpg?1683270831);">
                                <div class="char-label">
									Jinai <span class="ace-text">ace pair</span>
								</div>
                            </a>
                        </div>


						<div class="char-column col-12 col-lg-4 flex-column">
							<a class="char-image"
								target="_blank"
								href="https://toyhou.se/20918922.vanth" style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/63236565_Fq3IolWy7qixI1l.jpg?1683272024)">
								<div class="char-label">Vanth</div>
							</a>

							<div class="relationship-cell">
								<a class="relationship-label nav-item" data-bs-toggle="tab" href="#tab-5">
									<i class="relationship-arrows fa fa-arrows-up-down"></i>
									Acquaintances
								</a>
							</div>

							<a class="char-image"
								href="https://toyhou.se/5864645.maatkheru"
								target="_blank"
								style="background-image: url(https://i.postimg.cc/dtyhqDbx/image.png)">
								<div class="char-label">Maatkheru</div>
							</a>
						</div>
                    
                        <div class="char-column col-12 col-lg-4 flex-column">
                            <a class="char-image"
								href="https://toyhou.se/1779921.vesper"
								target="_blank"
								style="background-image: url(https://file.toyhou.se/images/10926513_rhxnMTFJ22lXRvZ.png);">
                                <div class="char-label">
                                    Vesper
								</div>
                            </a>
							
							<div class="relationship-cell">							
								<a class="relationship-label nav-item" data-bs-toggle="tab" href="#tab-1">
									<i class="relationship-arrows fa fa-arrows-up-down"></i>
									WLW battle couple
	                            </a>
							</div>
							
                            <a
                                href="https://toyhou.se/1820973.marcia"
								target="_blank"
                                class="char-image"
                                data-bs-toggle="tooltip"
                                data-bs-placement="right"
                                title="Art by problematic @ Toyhouse"
                                style="background-image: url(https://i.postimg.cc/hvBPMv7h/image.png)">
                                <div class="char-label">
									Marcia
								</div>
                            </a>
                        </div>

					</div>

                </div>

                <div class="info col-12 col-md-5">
					{!! $usagenotes !!}

					<div class="tab-content">
						<div class="tab-pane" id="tab-4">
					        <hr>
							<h4 class="info-heading">
								Anqien + Jinai
							</h4>
                            <div class="info-links">
                                
                                <a href="https://toyhou.se/17040769.anqien">Anqien profile</a> &bull; <a href="https://toyhou.se/17040760.jinai">Jinai profile</a> &bull;
                                <a href="https://toyhou.se/20496317.offshore-masterpost/20496327.cloudlanders-ship">Relationship</a>
                            </div>
							<p>
								From my novel <a href="https://circlejourney.net/offshore">Offshore</a>. They're a long-distance sailing team nearing the end of their professional partnership&mdash;Jinai is retiring after the next race. They are trying so hard not to fall in love and get distracted. It's not working.
							</p>
						</div>

						<div class="tab-pane" id="tab-5">
					        <hr>
							<h4 class="info-heading">
								Vanth + Maatkheru
							</h4>
                            <div class="info-links">
                                
                                <a href="https://toyhou.se/20918922.vanth">Vanth profile</a> &bull; <a href="https://toyhou.se/5864645.maatkheru">Maatkheru profile</a>
                            </div>
							<p>
								Most who pass through earth and the realms of the dead&mdash;especially death messengers like Vanth&mdash;will transit through In Between, the realm where Maatkheru lives. Vanth has occasionally stopped by the dutiful sphinx's desert tomb to talk and while the hours away. (They're not as close as the other pairs here so I'm happy for solo art.)
							</p>
						</div>

						<div class="tab-pane" id="tab-1">
					        <hr>
							<h4 class="info-heading">Vesper + Marcia</h4>
                            <div class="info-links">
                                <a href="https://toyhou.se/1779921.vesper">Vesper profile</a> &bull; <a href="https://toyhou.se/1820973.marcia">Marcia profile</a>
                            </div>
							<p>From <a href="https://rd.circlejourney.net">Revolving Door</a>. Vesper (a World War 2 soldier/weapon) and Marcia (a gladiator from the Modern Roman Empire) meet when <a href="https://toyhou.se/1776660.orobelle">the most important spoilt brat in the multiverse</a> hires them to protect her. After several combat missions together, they go from respecting each other to head over heels.</p>
						</div>
					</div>
                </div>

            </div>
		</div>

		<br>

		<!-- BEGIN BLOOD CARD -->
        <div class="card" id="blood" style="background-image:  repeating-linear-gradient(45deg, #d9bdbf, #d9bdbf 25px, transparent 25px, transparent 50px), linear-gradient(to bottom, #C8ADAF, #E1D7D7);">
            
            <div class="accent-icon">
                <i class="fa fa-fw fa-droplet"></i>
            </div>

			<a href="https://toyhou.se/TenTen">
				<img class="pagedoll" src="https://rebuild.circlejourney.net/images/df/teambloodmascot.png" data-bs-toggle="tooltip" data-bs-placement="top" title="Mascot art by TenTen">
			</a>

            <div class="header d-flex align-items-center py-2">
                <div class="stripes flex-grow-1"></div>

                <div class="team-title m-2 d-flex flex-column">
					<img class="d-block mb-2" src="https://rebuild.circlejourney.net/images/df/teambloodlogolong.png">
					<p class="nametag text-center">User &bull; Circlejourney</p>
				</div>
                
                <div class="stripes flex-grow-1"></div>
            </div>

            <div class="content row p-4 g-3">

                <div class="col-12 col-md-7">
                    <div class="char-area row g-0 nav">


                        <div class="char-column col-12 col-lg-4 flex-column">
                            <a class="char-image ace"
								target="_blank"
								href="https://toyhou.se/1872046.pala" style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/58104908_sRdXq9H41Ng5WHt.jpg?1683274981)">
                                <div class="char-label">Pala <span class="ace-text">ace</span> <span class="ace-text">ace pair<span></div>
                            </a>
	
							<div class="relationship-cell">
								<a class="relationship-label nav-item" data-bs-toggle="tab" href="#tab-6">
									<i class="relationship-arrows fa fa-arrows-up-down"></i>
									QPPs
								</a>
							</div>

                            <a 
								class="char-image ace"
								href="https://toyhou.se/1941234.fen"
								target="_blank"
								style="background-image: url(https://file.toyhou.se/images/8275935_Mwrez6VLiCebr8g.png?1530587673)">
                                <div class="char-label">Fen <span class="ace-text">ace pair<span></div>
                            </a>
                        </div>


                        <div class="char-column col-12 col-lg-4 flex-column">
                            <a
                                href="https://toyhou.se/19563604.xye"
								target="_blank"
                                class="char-image"
                                style="background-image:url(https://f2.toyhou.se/file/f2-toyhou-se/images/63065715_gRrIEfFnTqdcjzL.jpg?1683271940)">
                                <div class="char-label">Xye</div>
                            </a>

							<div class="relationship-cell">
								<a class="relationship-label nav-item" data-bs-toggle="tab" href="#tab-2">
									<i class="relationship-arrows fa fa-arrows-up-down"></i>
									Bickering teammates
								</a>
							</div>

                            <a
                                href="https://toyhou.se/19650517.zera"
								target="_blank"
                                class="char-image"
								style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/64163410_dMXHD4CD7PMOUp1.jpg?1683270879)">
                                <div class="char-label">Zera</div>
                            </a>
                        </div>


                        <div class="char-column col-12 col-lg-4 flex-column">
                            <a class="char-image"
								target="_blank"
								href="https://toyhou.se/2037696.circlejourney" style="background-image: url(https://i.postimg.cc/XYdX58bb/image.png)">
                                <div class="char-label">Circlejourney</div>
                            </a>
	
							<div class="relationship-cell">
								<a class="relationship-label nav-item" data-bs-toggle="tab" href="#tab-3">
									<i class="relationship-arrows fa fa-arrows-up-down"></i>
									Unrelated
								</a>
							</div>

                            <a class="char-image"
								href="https://toyhou.se/2628384.omen"
								target="_blank"
                                data-bs-toggle="tooltip"
                                data-bs-placement="right"
                                title="Art by Heavenly_Graphite @ Toyhouse"
								style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/36834513_txLs3LfmXYWpJZF.png)">
                                <div class="char-label">
									Omen
								</div>
                            </a>
                        </div>
					</div>

                </div>

                <div class="info col-12 col-md-5">
                    {!! $usagenotes !!}

					<div class="tab-content">

						<div class="tab-pane" id="tab-6">
					        <hr>
							<h4 class="info-heading">Pala + Fen</h4>
                            <div class="info-links">
                                
                                <a href="https://toyhou.se/1872046.pala">Pala profile</a> &bull; <a href="https://toyhou.se/1941234.fen">Fen profile</a>
                            </div>
							<p>
								From my (unfinished) comic <a href="https://light.circlejourney.net">The Light Left Under Trees</a>! Two best friends on a quest to discover all the timespace anomalies across their home island of Havaiki&mdash;while they deal with the travails of teenhood and learn to confide in each other. They share a profound bond that eventually becomes a queerplatonic relationship.
							</p>
						</div>

						<div class="tab-pane" id="tab-2">
					        <hr>
							<h4 class="info-heading">Xye + Zera</h4>
                            <div class="info-links">
                                
                                <a href="https://toyhou.se/19563604.xye">Xye profile</a> &bull; <a href="https://toyhou.se/19650517.zera">Zera profile</a>
                            </div>
							<p>
								From my novel <a href="https://circlejourney.net/offshore">Offshore</a>. Xye and Zera are teammates who are somehow always at loggerheads on land, but an unstoppable team at sea. Zera is tired of Xye rankling their rivals and flirting with random people (including their rivals). But she's the only person who can get Xye to behave soberly and somehow, the team just works.
							</p>
						</div>
						<div class="tab-pane" id="tab-3">
					        <hr>
							<h4 class="info-heading">Circlejourney</h4>
                            <div class="info-links">
                                <a href="https://toyhou.se/2037696.circlejourney">Profile</a>
                            </div>
							<p>My sona, an edgy bird-loving necromancer and sus surgeon who specialises in reanimation and communicating with the dead. They live in the "dungeon" aboard a pirate ship with reanimated skeletons.</p>

							<h4 class="info-heading">Omen</h4>
                            <div class="info-links">
                                <a href="https://toyhou.se/2628384.omen">Profile</a>
                            </div>
							<p>They're Bad Luck. As in they literally siphon away everyone else's luck in their vicinity. They made a fortune swindling 50 casinos across the US with their powers.</p>
						</div>
					</div>
                </div>

            </div>
		</div>

    </div>
@endsection
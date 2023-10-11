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
	<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Playfair+Display&display=swap" rel="stylesheet">
    <style>

		:root {
			--border-radius: 10px;
			--black: #0F0F12;
		}

        body {
			background: var(--black);
            font-family: "Playfair Display", serif;
			font-size: 13pt;
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

        .team-border {
            border-top: 4px solid var(--black);
            border-bottom: 4px solid var(--black);
            height: 12px;
        }

		.subheading {
			font-family: "DM Serif Display", serif;
			border-radius: var(--border-radius);
			display: inline-block;
			background-color: var(--black);
			color: white;
		}

        .char-image {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            text-align: center;
            width: 100%;
            height: 300px;
            background-size: cover;
            background-position: top;
			background-repeat: no-repeat;
            text-decoration: none;
        }

        .char-label {
			font-size: 14pt;
            padding: 1.5em 0 1em;
            background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1));
            color: white;
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

		.relationship-cell {
			height: 0;
			z-index: 2;
			text-align: center;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.relationship-label {
			padding: 0.1rem;
			border-radius: var(--border-radius);
			background-color: var(--accent);
			color: white;
			text-decoration: none;
			box-shadow: 1px 1px 2px rgba(0,0,0,0.5);
		}

		.relationship-label.active {
			border: 3px solid white;
		}

        .pagedoll {
            position: absolute;
            bottom: 5px;
            right: 5px;
            height: 120px;
        }

		.info-heading {
			font-family: "DM Serif Display", serif;
			padding: 0.1rem;
			display: inline-block;
			background-color: var(--black);
			color: white;
		}

        .pagedoll:hover {
            transform: scale(105%) rotate(2deg);
        }

    </style>
@endpush

@section("body")
    <div class="main container py-5">
		
		<!-- BEGIN TEARS CARD -->
        <div class="card" id="tears" style="background-image: linear-gradient(to bottom, #C5E9E6, #CEEDEA); background-size: 20%, cover;">
	
			<a href="https://toyhou.se/TenTen">
				<img class="pagedoll" src="/images/df/teamtearsmascot.png" data-bs-toggle="tooltip" data-bs-placement="top" title="Mascot art by TenTen">
			</a>

            <div class="d-flex align-items-center py-2">
                <div class="team-border flex-grow-1"></div>

                <div class="team-title m-2 w-25 d-flex flex-column">
					<img class="d-block mb-2" src="https://rebuild.circlejourney.net/images/df/teamtearslogolong.png">
					<p class="subheading text-center">User &bull; Circlejourney</p>
				</div>
                
                <div class="team-border flex-grow-1"></div>
            </div>

            <div class="row p-4 g-2">

                <div class="col-12 col-lg-8">
                    <div class="row g-0 nav">
                    
                        <div class="col-12 col-lg-4 flex-column">
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


						<div class="col-12 col-lg-4 flex-column">
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


                        <div class="col-12 col-lg-4 flex-column">
                            <a class="char-image"
								target="_blank"
								href="https://toyhou.se/1872046.pala" style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/58104908_sRdXq9H41Ng5WHt.jpg?1683274981)">
                                <div class="char-label">Pala</div>
                            </a>
	
							<div class="relationship-cell">
								<a class="relationship-label nav-item" data-bs-toggle="tab" href="#tab-6">
									<i class="relationship-arrows fa fa-arrows-up-down"></i>
									QPPs
								</a>
							</div>

                            <a 
								class="char-image"
								href="https://toyhou.se/1941234.fen"
								target="_blank"
								style="background-image: url(https://file.toyhou.se/images/8275935_Mwrez6VLiCebr8g.png?1530587673)">
                                <div class="char-label">Fen</div>
                            </a>
                        </div>
					</div>

                </div>

                <div class="info col-12 col-lg-4" style="padding-bottom: 100px;">
					<p>You can change hairstyles, outfits, and all design details that the character themself can change. But don't change their skin tones or body types.</p>
					<p>Click on the relationship labels to view more info about the characters / relationship. Click on the portraits to open their Toyhouse profiles.</p>

					<br>
					<div class="tab-content">
						<div class="tab-pane" id="tab-4">
							<h4 class="info-heading">
								Anqien + Jinai
							</h4>
							<p>
								They're an offshore (long-distance) sailing team nearing the end of their professional partnership&mdash;because Jinai is retiring after the next race. They are trying so hard not to fall in love and get distracted. It's not working. <a href="https://toyhou.se/20496317.offshore-masterpost/20496327.cloudlanders-ship">They have a relationship profile!</a>
							</p>
						</div>

						<div class="tab-pane" id="tab-5">
							<h4 class="info-heading">
								Vanth + Maatkheru
							</h4>
							<p>
								Most beings who pass through earth and the realms of the dead&mdash;especially death messengers like Vanth&mdash;will transit through In relationship, the realm where Maatkheru lives. Vanth has on occasion stopped by the dutiful sphinx's desert tomb to talk and while the hours away. (They're not as close as the other pairs here so I'm happy for solo art.)
							</p>
						</div>

						<div class="tab-pane" id="tab-6">
							<h4 class="info-heading">Pala + Fen</h4>
							<p>
								Two best friends on a quest to discover all the timespace anomalies across their home island of Havaiki. All the while, they deal with the travails of teenhood, and confide in each other. A profoundly deep bond that eventually becomes a queerplatonic relationship.
							</p>
						</div>
					</div>
                </div>

            </div>
		</div>

		<br>

		<!-- BEGIN BLOOD CARD -->
        <div class="card" id="blood" style="background-image: linear-gradient(to bottom, #C8ADAF, #E1D7D7); background-size: 20%, cover;">

			<a href="https://toyhou.se/TenTen">
				<img class="pagedoll" src="https://rebuild.circlejourney.net/images/df/teambloodmascot.png" data-bs-toggle="tooltip" data-bs-placement="top" title="Mascot art by TenTen">
			</a>

            <div class="d-flex align-items-center py-2">
                <div class="team-border flex-grow-1"></div>

                <div class="team-title m-2 w-25 d-flex flex-column">
					<img class="d-block mb-2" src="https://rebuild.circlejourney.net/images/df/teambloodlogolong.png">
					<p class="subheading text-center">User &bull; Circlejourney</p>
				</div>
                
                <div class="team-border flex-grow-1"></div>
            </div>

            <div class="row p-4 g-2">

                <div class="col-12 col-lg-8">
                    <div class="row g-0 nav">
                    
                        <div class="col-12 col-lg-4 flex-column">
                            <a class="char-image ace"
								href="https://toyhou.se/1779921.vesper"
								target="_blank"
								style="background-image: url(https://file.toyhou.se/images/10926513_rhxnMTFJ22lXRvZ.png);">
                                <div class="char-label">
                                    Vesper <span class="ace-text">ace</span> <span class="ace-text">ace pair<span>
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
                                class="char-image ace"
                                style="background-image: url(https://i.postimg.cc/hvBPMv7h/image.png)">
                                <div class="char-label">
									Marcia <span class="ace-text">ace pair</span>
								</div>
                            </a>
                        </div>


                        <div class="col-12 col-lg-4 flex-column">
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


                        <div class="col-12 col-lg-4 flex-column">
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
								href="https://toyhou.se/5864645.maatkheru"
								target="_blank"
								style="background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/36834513_txLs3LfmXYWpJZF.png)">
                                <div class="char-label">
									Omen
									<br>
									<span style="font-size: 10pt;">(Art: Heavenly_Graphite @ Toyhouse)</span>
								</div>
                            </a>
                        </div>
					</div>

                </div>

                <div class="info col-12 col-lg-4" style="padding-bottom: 100px;">
					<p>You can change hairstyles, outfits, and all design details that the character themself can change. But don't change their skin tones or body types.</p>
					<p>Click on the relationship labels to view more info about the characters / relationship. Click on the portraits to open their Toyhouse profiles.</p>

					<div class="tab-content">
						<div class="tab-pane" id="tab-1">
							<h4 class="info-heading">Vesper + Marcia</h4>
							<p>Vesper (a World War 2 soldier) and Marcia (a gladiator from the Modern Roman Empire) meet when Orobelle, the most important spoilt brat in the multiverse, hires them to protect her. After several combat missions together in various universes, they go from respecting each other to head over heels.</p>
							<p>Vesper is my ace ace lol. Her <a href="https://rd.circlejourney.net/read/?c=002">intro chapter</a> in Revolving Door is even called <i>Ace</i>.</p>
						</div>
						<div class="tab-pane" id="tab-2">
							<h4 class="info-heading">Xye + Zera</h4>
							<p>
								Xye and Zera are teammates who are somehow always at loggerheads when on land, but a frighteningly good team at sea. Zera is tired of Xye rankling their rivals and flirting with random people (including their rivals). But she's the only person who can get Xye to behave soberly and somehow, the team just works.
							</p>
						</div>
						<div class="tab-pane" id="tab-3">
							<h4 class="info-heading">Circlejourney</h4>
							<p>My sona, an edgy necromancer and questionable surgeon, who lives in the "dungeon" aboard a pirate ship.</p>
							<h4 class="info-heading">Omen</h4>
							<p>They're Bad Luck. As in they literally siphon away everyone else's luck in their vicinity. They made a fortune swindling 50 casinos across the US.</p>
						</div>
					</div>
                </div>

            </div>
		</div>

    </div>
@endsection
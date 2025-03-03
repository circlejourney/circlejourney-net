@extends("layouts.app")

@section("html_title"){{ "Amari Low - Resume" }}@endsection

@push("head")
    @include("components.lightbox-scripts")
    <style>

        :root {
            --accent: #24506B;
            --muted: #355f79;
            --bg: #eae4df;
            --faded: rgb(231, 205, 185);
            --bg-link: #ffd1ac;
        }

        body {
            font-family: Arvo, sans-serif;
            background-color: var(--bg);
            line-height: 1.4em;
            padding: 2rem;
        }

        h1 {
            font-size: 600%;
            line-height: 1em;
            font-weight: normal;
            font-family: "Bebas Neue", Arvo, sans-serif;
            word-break: break-word;
        }

        h2 {
            font-size: 300%;
            line-height: 1em;
            font-family: "Bebas Neue", Arvo, sans-serif;
        }

        h1, h2, h3 {
            margin: 0;
            font-smooth: always;
        }

        h2, h3 {
            color: var(--accent);
        }

        a, a:visited {
            text-decoration: none;
            background-color: var(--faded);
            color: var(--accent);
        }

        p {
            /* margin: 0; */
            margin-block-start: 0.6em;
            margin-block-end: 0.6em;
        }

        .spacer {
            height: 1.25rem;
        }

        .header {            
            margin-bottom: 2rem;
            background-color: var(--accent);
            color: var(--bg);
            padding: 1rem;
        }

        .header a, .header a:visited {
            background-color: var(--muted);
            color: var(--bg-link);
        }

        .header .subtitle {
            color: var(--bg);
        }

        .subtitle {
            color: var(--muted);
        }

        .row,.col {
            display: flex;
            gap: 2rem;
        }
        
        .col {
            flex-direction: column;
        }

        .gap-p5 {
            gap: 0.5rem;
        }

        .row-block {
            flex-basis: 0;
            flex-grow: 1;
        }

        .jc-center {
            justify-content: center;
        }

        .blurb {
            font-size: 90%;
        }

        .skills {
            font-size: 90%;
            color: var(--muted);
        }

        .section {
            break-inside: avoid;
        }

        .section-header {
            margin-top: 1.25rem;
        }

        .section-title {
            border-bottom: 2px solid;
        }

        .section-icon {
            width: 50px;
            align-self: center;
        }
        
        .gallery {
        position: relative;
        width: 100%;
        text-align: center;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        }

        .gallery-title {
        text-align: center;
        margin-bottom: 1rem;
        }

        .gallery-title h2 {
            display: inline-block;
        }

        .gallery-art {
            margin: 10px;
            box-sizing: border-box;
            position: relative;
            text-align: center;
            overflow-y: hidden;
            line-height: 0;
        }

        .gallery-art:hover .gallery-thumbnail {
            border-color: rgba(255, 255, 255, 0.6);
        }
        
        .gallery-art:hover .caption {
            opacity: 1;
            left: 0;
            bottom: 0;
        }

        .gallery-thumb-link {
            display: block;
            height: 100%;
            width: 100%;
            background: none;
        }

        .gallery-thumbnail {
        height: 100%;
        width: 100%;
        object-fit: cover;
        object-position: top;
        box-sizing: border-box;
        border: 5px solid rgba(255, 255, 255, 0.3);
        max-height: 180px;
        max-width: 200px;
        }

        .caption {
            display: none;
            position: absolute;
            opacity: 0;
            background: rgba(255, 255, 255, 0.7);
            padding: 10px;
            left: 0;
            bottom: -30px;
            line-height: 1.2em;
            width: 100%;
            box-sizing: border-box;
            text-align: left;
            transition: 0.2s all linear;
            font-family: Rubik;
        }

        .caption a, .caption a:visited {
            font-weight: normal;
            text-decoration: none;
            background: none;
        }

        .caption-title {
            margin: 0;
            font-size: 16pt;
        }

        .caption p {
            display: none;
            width: 100%;
            padding: 0;
            font-size: small;
            margin-block-start: 0.3em;
            margin-block-end: 0.3em;
        }

        .lightbox-title {
            font-size: 180%;
        }

        .lightbox-description a {
            background-color: var(--muted);
            color: var(--bg-link);
        }

        @media only screen and (max-width: 768px) {    
            .row,.col {
                display: block;
            }
            h1 {
                font-size: 400%;
                text-align: center;
            }
        }

        @media print {
            body {
                font-size: 9pt;
                line-height: 1.2em;
            }
            .print-d-block {
                display: block;
            }
        }

    </style>
@endpush

@section("body")
    @include("components.lightbox", ["artworks" => $lightboxable])
    <div class="header row">
        <div class="col jc-center">
            <h1>Amari Low aka<br>Circlejourney</h1>
        </div>
        <div class="row-block col jc-center gap-p5">
            <div class="subtitle">
                <b>
                    Digital artist/animator &bull; web developer &bull; interaction design researcher
                </b>
            </div>

            <div class="contact">
                <a target="_blank" href="https://circlejourney.net"><i class="fa fa-globe"></i> circlejourney.net</a>
                •
                <a target="_blank" href="mailto:amari.low@hdr.qut.edu.au">
                    <i class="fa fa-envelope"></i> 
                    amari.low@hdr.qut.edu.au
                </a>
                •
                <a target="_blank" href="linkedin.com/in/amari-low-29494b87"><i class="fab fa-linkedin"></i> linkedin.com/in/amari-low-29494b87</a>
            </div>
            <div class="blurb">
                Also BFA Animation, MFA Interactive Media, and currently a PhD candidate at QUT. My work explores experimental storytelling, cartography, interaction design, and virtual place-making. My interests are expansive and always growing! 
            </div>
        </div>
    </div>

    <div class="row print-d-block">
        <div class="row-block">
                <h2>Work history</h2>
                
                <div class="section">
                    <div class="section-header row gap-p5">
                        <img class="section-icon" src="/images/tinychick.png">
                        <div class="row-block">
                            <h3 class="section-title"><b>ChickenPet:</b> Full Stack Developer &amp; Site Administrator</h3>
                            <div class="subtitle">July 2024 &ndash; Present</div>
                        </div>
                    </div>
                    <p>I created, develop and administrate <a target="_blank" href="https://chicken.pet/intro">ChickenPet</a>, a chicken petsite (in the style of Flight Rising) with breeding and trading mechanics, a user marketplace, forums, and minigames. Responsibilities include UI/UX design, programming game features, graphic design, addressing site suggestions and bug reports, and other general site administration. The game currently has about 500 players.</p>
                    <p class="skills">
                        Skills: Linux, MySQL, PHP (Laravel 11), HTML (Bootsrap), CSS (SASS), JavaScript (jQuery)
                    </p>

                    <x-gallery :artworks="$chickenpet" :lightboxable="$lightboxable->pluck('id')"/>
                </div>

                <div class="section">
                    <div class="section-header row gap-p5">
                        <img class="section-icon" src="images/cjsq.png">
                        <div class="row-block">
                            <h3 class="section-title"><b>Circlejourney:</b> Founder</h3>
                            <div class="subtitle">2018 &ndash; Present</div>
                        </div>
                    </div>
                    <p>I started my art commission business under the pseudonym Circlejourney in 2018, and officially registered it as a sole trader business in 2021. I have fulfilled hundreds of project briefs of all kinds, including illustration, 2D animation, background music, front-end web development, and graphic design&hellip;just to name a few!</p>

                    <div>Here are some selected works for clients:</div>

                    <x-gallery :artworks="$artworks" :lightboxable="$lightboxable->pluck('id')"/>
                </div>

                <div class="section">
                    <div class="section-header row gap-p5">
                        <img class="section-icon" src="images/ozchi2025.svg">
                        <div class="row-block">
                            <h3 class="section-title"><b>OzCHI:</b> Web & Social Media Chair</h3>
                            <div class="subtitle">2024 &ndash; Present</div>
                        </div>
                    </div>
                    <p>OzCHI is the Australian Conference for Human-Computer Interaction. Since 2024, I have designed and maintained the <a target="_blank" href="https://ozchi.org/2024">OzCHI website</a>, which functions as the conference's main hub for information about submission, registration, and attendance. I liaise with other chairs to ensure that all information is accurate and that important changes are communicated in a timely manner.</p>
                    <p class="skills">
                        Skills: HTML (Bootstrap), CSS, JavaScript, and PHP
                    </p>
                </div>

                <div class="section">
                    <div class="section-header row gap-p5">
                        <img class="section-icon" src="/images/qut.jpg">
                        <div class="row-block jc-center">
                            <h3 class="section-title">Queensland University of Technology: Sessional Academic</h3>
                            <div class="subtitle">July 2022 &ndash; November 2024</div>
                        </div>
                    </div>
                    <p>I tutored the Interactive Narrative Design unit for undergraduates, which imparts skills in designing narratives for dynamic and open-ended play in video games and tabletop roleplaying games. My duties included remote teaching and classroom management, producing video learning content, and liaising with other tutors and UC during marking moderation.</p>
                </div>
                
                <div class="section">
                    <div class="section-header row gap-p5">
                        <img class="section-icon" src="/images/je.svg">
                        <div class="row-block jc-center">
                            <h3 class="section-title">Junior Engineers: Coding and Robotics Tutor</h3>
                            <div class="subtitle">February &ndash; December 2022</div>
                        </div>
                    </div>
                    <p>I taught after-school programmes for Scratch and Python, and ran App Prototyping, Film Academy and Lego Mindstorms holiday camps for primary school students (7 to 13 years old). I also delivered professional development sessions for employees. I also assisted in developing JavaScript curriculum to be taught at the primary school level.</p>
                </div>
        </div>

        <div class="row-block">
            <h2>
                Education
            </h2>
            <div class="section">
                <div class="section-header">
                    <h3 class="section-title">Doctor of Philosophy (Ongoing)</h3>
                    <div class="subtitle">Queensland University of Technology &bull; February 2022 &ndash; present</div>
                </div>
                <p>My research project, <em>ReLocative Media,&nbsp;</em>looks at how how to design better technologies for people who sustain close relationships over the internet. It brings together sociological, geographical, and design research methods under a participatory framework, empowering members of these communities to shape design practices moving into the future.</p>
                <p>Related work:</p>
                <ul>
                <li><strong>Sessional tutor:</strong> DXB205 (Interactive Narrative Design)</li>
                <li><strong>Research assistant and web developer:</strong> <em>Kinning with the Unseen</em>, August &ndash; November 2022 (Project Lead: Dr Jane Turner)</li>
                <li><strong>Session chair:</strong> Faculty of Education Research and Publication Week 2022</li>
                </ul>
            </div>

            <div class="section">
                <div class="section-header">
                    <h3 class="section-title">Master of Interactive Media (Research)</h3>
                    <div class="subtitle">Griffith University &bull; July 2018 &ndash; June 2020 &bull; Graduated with Distinction</div>
                </div>
                <p>
                    For my research project, I developed a location-based (GPS-driven) hypertext engine with HTML, jQuery and Leaflet.js, and used it to produce <a target="_blank" href="https://circlejourney.net/spectralcarta?playtest"><i>The Spectral Carta</i></a>, an interwoven collection of locative ghost stories about the forgotten histories of Brisbane.
                </p>

                <p>Related work: </p>
                <ul>
                <li><strong>Assistant programmer:</strong> Flying Fruit, Griffith University exhibit at Beijing Design Week 2018 (Coordinator: Prof. Andrew Brown)</li>
                <li>
                    <b>Awards:</b> Griffith Award for Academic Excellence 2019
                </li>
                </ul>
                <x-gallery :artworks="$mfa" :lightboxable="$lightboxable->pluck('id')"/>
            </div>

            <div class="section">
                <div class="section-header">
                    <h3 class="section-title">Bachelor of Fine Arts, Digital Animation</h3>
                    <div class="subtitle">Nanyang Technological University &bull;&nbsp;July 2013 &ndash; May 2017 &bull; First Class Honours</div>
                </div>
                <p>
                    My thesis project, </strong> <a target="_blank" href="https://compass.circlejourney.net"><em>Compass</em></a> is a ~110-panel interactive graphic novel with two endings. I produced the comic script, artwork, and programming with consultation with Prof. Hans-Martin Rall and Ben Slater.
                </p>

                <ul>
                <li>
                    <b>Awards:</b> Dean's List 2015 (during study abroad at Northeastern University), Dean's List for academic year of 2016
                </li>
                </ul>
            
                <x-gallery :artworks="$bfa" :lightboxable="$lightboxable->pluck('id')"/>
            </div>
        </div>
    </div>
    
    <div class="spacer"></div>

    <div>
        <h2>Other projects</h2>
        
        <div class="section">
            <div class="section-header row gap-p5">
                <img class="section-icon" src="/images/seaunseentitle.png">
                <div class="row-block">
                    <h3 class="section-title"><b>The Sea Unseen:</b> Organiser, layout artist, print distributor</h3>
                    <div class="subtitle">2021 &ndash; Present</div>
                </div>
            </div>
            <p><a target="_blank" href="https://seaunseenzine.carrd.co">The Sea Unseen</a> is a marine-themed charity art zine I initated in 2021. It has since had 3 editions and raised over AUD 1,000 for the Australian Marine Conservation Society. Every edition brings together scores of artists from all over the world, creating marine artwork together for love of our oceans. As the main organiser and graphic designer, I oversee communications, artwork production, zine formatting, release, and distribution of print editions.</p>
        </div>

        <div class="section">
            <div class="section-header row gap-p5">
                <img class="section-icon" src="/images/wtwlogo.png">
                <div class="row-block">
                    <h3 class="section-title"><b>Window to Worlds:</b> Organiser, layout artist, print distributor</h3>
                    <div class="subtitle">2020 &ndash; Present</div>
                </div>
            </div>
            <p>I started the original character art zine <a target="_blank" href="https://windowtoworlds.carrd.co">Window to Worlds</a> in 2020, and since then, we have featured hundreds of artists and creative works in our four editions to date. As a project moderator, I co-manage communications, artist selections, artwork production, zine formatting, release, and distribution of the print edition.</p>
        </div>
        
        
        <div class="section">
            <div class="section-header row gap-p5">
                <img class="section-icon" src="/images/theditor.png">
                <div class="row-block">
                    <h3 class="section-title"><b>Toyhouse live code editor</b></h3>
                    <div class="subtitle">2020 &ndash; Present</div>
                </div>
            </div>
            <p><a target="_blank" href="https://th.circlejourney.net">The Toyhouse live code editor</a> is a utility I created to make Toyhouse profile coding easier for users who are less familiar with HTML, by letting them preview their code as they type. It has since become well loved by the community, and sees an average of 1,400 unique users per day.</p>
        </div>

    </div>
@endsection
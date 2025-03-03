@extends("layouts.app")

@section("html_title"){{ "Amari Low - Resume" }}@endsection

@push("head")
    <style>

        :root {
            --accent: #24506B;
            --muted: #355f79;
            --bg: #f6efe9;
            --bg-link: #ffd1ac;
        }

        body {
            font-family: Arvo, sans-serif;
            background-color: var(--bg);
            line-height: 1.4em;
            padding: 2rem;
        }

        h1 {
            font-size: 800%;
            line-height: 1em;
            font-family: "Bebas Neue", Arvo, sans-serif;
        }

        h2 {
            font-size: 300%;
            line-height: 1em;
            font-family: "Bebas Neue", Arvo, sans-serif;
        }

        h1, h2, h3 {
            margin: 0;
        }

        h2, h3 {
            color: var(--accent);
        }

        a, a:visited {
            color: var(--accent);
        }

        p {
            /* margin: 0; */
            margin-block-start: 0.6em;
            margin-block-end: 0.6em;
        }

        .header {            
            margin-bottom: 2rem;
            background-color: var(--accent);
            color: var(--bg);
            padding: 1rem;
        }

        .header a, .header a:visited {
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

        .section-title {
            border-bottom: 2px solid;
            margin-top: 1rem;
        }

        .section-icon {
            width: 50px;
            align-self: center;
        }

        @media only screen and (max-width: 768px) {    
            .row,.col {
                display: block;
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
    <div class="header row">
        <h1>Amari Low</h1>
        <div class="row-block col jc-center gap-p5">
            <div class="subtitle">
                Digital artist, web developer, musician, researcher
            </div>

            <div class="contact">
                <a href="https://circlejourney.net"><i class="fa fa-globe"></i> circlejourney.net</a>
                •
                <a href="mailto:amari.low@hdr.qut.edu.au">
                    <i class="fa fa-envelope"></i> 
                    amari.low@hdr.qut.edu.au
                </a>
                •
                <a href="linkedin.com/in/amari-low-29494b87"><i class="fab fa-linkedin"></i> linkedin.com/in/amari-low-29494b87</a>
            </div>
            <div class="blurb">
                Also BFA Animation, MFA Interactive Media, and currently a PhD candidate at QUT. My work explores interactive & experimental narratives, web development, and new cartographies. My interests are expansive and always growing! 
            </div>
        </div>
    </div>

    <div class="row print-d-block">
        <div class="row-block">
                <h2>Work history</h2>
                <div class="row gap-p5">
                    <img class="section-icon" src="/images/tinychick.png">
                    <div class="row-block">
                        <h3 class="section-title"><b>ChickenPet:</b> Full Stack Developer &amp; Site Administrator</h3>
                        <div class="subtitle">July 2024 &ndash; Present</div>
                    </div>
                </div>
                <p>I created, develop and administrate <a href="chicken.pet">ChickenPet</a>, a chicken-raising petsite in the style of Flight Rising with breeding and trading mechanics, a user marketplace, a forum, and minigames. Responsibilities include UI/UX design, programming game features, graphic design, addressing site suggestions and bug reports, and other general site administration. The game currently has about 500 players.</p>
                <p class="skills">
                    Skills: Linux, MySQL, PHP (Laravel 11), HTML (Bootsrap), CSS (SASS), JavaScript (jQuery)
                </p>

                <div class="row gap-p5">
                    <img class="section-icon" src="images/ozchi2025.svg">
                    <div class="row-block">
                        <h3 class="section-title"><b>OzCHI:</b> Web & Social Media Chair</h3>
                        <div class="subtitle">2024 &ndash; Present</div>
                    </div>
                </div>
                <p>OzCHI is the Australian Conference for Human-Computer Interaction. Since 2024, I have designed and maintained the OzCHI website, which functions as the conference's main hub for submission, registration, and attendance information. I liaise with other chairs to ensure that all information is accurate and that important changes are communicated in a timely manner.</p>
                <p class="skills">
                    Skills: HTML (Bootstrap), CSS, JavaScript, and PHP
                </p>

                <div class="row gap-p5">
                    <img class="section-icon" src="images/cjsq.png">
                    <div class="row-block">
                        <h3 class="section-title"><b>Circlejourney:</b> Founder</h3>
                        <div class="subtitle">2018 &ndash; Present</div>
                    </div>
                </div>
                <p>I founded the freelance design and web development business Circlejourney (which is also my online handle). I have fulfilled hundreds of project briefs, including illustration, 2D animation, film background painting, front-end web development, and graphic design for web.</p>

                <h3 class="section-title">Queensland University of Technology: Sessional Academic</h3>
                <div class="subtitle">July 2022 &ndash; November 2024</div>
                <p>I tutored the Interactive Narrative Design unit for undergraduates, which imparts skills in designing narratives for dynamic and open-ended play in video games and tabletop roleplaying games. My duties included remote teaching and classroom management, producing video learning content, and liaising with other tutors and UC during marking moderation.</p>

                <h3 class="section-title">Junior Engineers: Coding and Robotics Tutor</h3>
                <div class="subtitle">February &ndash; December 2022</div>
                <p>I taught after-school programmes for Scratch and Python, and ran App Prototyping, Film Academy and Lego Mindstorms holiday camps for primary school students (7 to 13 years old). I also delivered professional development sessions for employees. I also assisted in developing JavaScript curriculum to be taught at the primary school level.</p>
                <p>&nbsp;</p>
        </div>
        <div class="row-block">
            <h2>
                Education
            </h2>
            <h3 class="section-title">Doctor of Philosophy (Ongoing)</h3>
            <div class="subtitle">Queensland University of Technology &bull; February 2022 &ndash; present</div>
            <p>My research project, <em>ReLocative Media,&nbsp;</em>looks at how how to design and develop better internet technologies for people who connect with family and intimate partners over the internet.</p>
            <p>Related work:</p>
            <ul>
            <li><strong>Sessional tutor:</strong> DXB205 (Interactive Narrative Design)</li>
            <li><strong>Research assistant and web developer:</strong> <em>Kinning with the Unseen</em>, August &ndash; November 2022 (Project Lead: Dr Jane Turner)</li>
            <li><strong>Session chair:</strong> Faculty of Education Research and Publication Week 2022</li>
            </ul>
            <h3 class="section-title">Master of Interactive Media (Research)</h3>
            <div class="subtitle">Griffith University &bull; July 2018 &ndash; June 2020 &bull; Graduated with Distinction</div>
            <p>
                For my research project, <a href="https://circlejourney.net/spectralcarta?playtest"><i>The Spectral Carta</i></a>, I developed a location-based hypertext engine in HTML/JavaScript/CSS, and produced a collection of locative ghost stories about the buried histories of Brisbane.
            </p>
            <p>Related work: </p>
            <ul>
            <li><strong>Assistant programmer:</strong> Flying Fruit, Griffith University exhibit at Beijing Design Week 2018 (Coordinator: Prof. Andrew Brown)</li>
            <li>
                <b>Awards:</b> Griffith Award for Academic Excellence 2019
            </li>
            </ul>
            <div>
            <h3 class="section-title">Bachelor of Fine Arts, Digital Animation</h3>
            <div class="subtitle">Nanyang Technological University &bull;&nbsp;July 2013 &ndash; May 2017 &bull; First Class Honours</div>
            <p>
                My thesis project, </strong> <a href="https://compass.circlejourney.net"><em>Compass</em></a> was a 550-page interactive graphic novel with two endings. I produced the comic script, artwork, and programming with consultation with Prof. Hans-Martin Rall and Ben Slater.
            </p>
            <ul>
            <li>
                <b>Awards:</b> Dean's List 2015 (during study abroad at Northeastern University), Dean's List 2016, Dean's List 2017
            </li>
            </ul>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Other projects</h2>
        <div class="row gap-p5">
            <img class="section-icon" src="/images/wtwlogo.png">
            <div class="row-block">
                <h3 class="section-title"><b>Window to Worlds:</b> Organiser, layout artist, print distributor</h3>
                <div class="subtitle">2020 &ndash; Present</div>
            </div>
        </div>
        <p>I started the original character art zine <a href="https://windowtoworlds.carrd.co">Window to Worlds</a> in 2020, and since then we have featured hundreds of artists and art pieces. We recently released our first creative writing volume in 2024. I also coordinate the limited print run for each issue.</p>
        
    </div>
@endsection


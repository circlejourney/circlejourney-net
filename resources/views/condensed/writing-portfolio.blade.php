@extends("layouts.condensed")

@section("title"){{ "Writing portfolio" }}@endsection
@push("head")
    <style>
        body {
            font-family: "Helvetica Neue", "Helvetica", sans-serif;
        }

        .writing-collapse {
            color: #bbb;
        }

        .writing-collapse details hr {
            width: 20%;
        }

        .writing-collapse details .close {
            cursor: pointer;
            color: #d8874a;
        }

        .writing-collapse summary {
            cursor: pointer;
            color: #d8874a;
        }
        
        .writing-collapse > h2 {
            color: #8adaea;
            font-family: Arvo;
            display: inline;
        }

        .meta {
            font-size: 60%;
            color: #bbb;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 0.2rem;
            border-radius: 5px;
            margin-left: 0.5rem;
        }

    </style>
    <script>
        $(document).ready(function(){ 
            const close = $("<a></a>").addClass("close").text("Close");
            $(close).on("click", function(){
                $(this).closest("details").removeAttr("open");
            });
            $(".writing-collapse details").each(function(i, element){
                $(element).append($(close).clone(true));
            })
        })
    </script>
@endpush

@section("content")
<div class="writing-collapse">
    <h2>
        Phantasmagoria
        <span class="meta">
            <em>Revolving Door</em> Chapter 33 (2024)
            &bull;
            <a href="https://rd.circlejourney.net/read/?c=33">
                Full text
            </a>
        </span>
    </h2>
    <p>It was the dawn of discovery, the sunset of silence. It was the gilded decade, the godless decade, the decade when the world began to feel small. It was the Year 1892, and that was the year I fell in love.</p>

    <p>Across the sea, cities were swept by revolution while in London, streets brightened and steam cars plummeted from favour. For a century we had sung the praises of coal and boiler, watching as it eagerly reshaped the world&mdash;but today, something new had risen to overshadow it: the sun.</p>

    <details>
        <summary>...</summary>
        <p>It was upon our soil that we learned to conjure electricity from light, and saw, in a flash of clarity, the endless possibility within it. Once the metropolitan railway inaugurated its first solar train, the rest of the city was quick to follow. Suncatchers sprouted on every eave, till we saw more glass than chimneys, and councillors now blustered about the peril of too many windows, the birds they slew.</p>

        <p>On a placid day in the middle of all this turbulence, I sat at my desk and wrote an essay, gazing out across the manor grounds at the catcher glittering atop our greenhouse. From my study, I had a full view of the green, brushed by summer and bursting into bloom. It was all of a Baroque construction, the yield of wealth older than the house&mdash;older than the road beside it.</p>

        <p>Today, a rare sun lit the land in gold. Light fell through my window, scattered by leaves. As the birds burst into a bright refrain, I thought about Lucille.</p>

        <hr>

        <p>Lucille had been no one to me till two weeks ago. Then at once, she was the young lady on the balcony at the Herberts&rsquo; evening function, waving a violet fan to set her pale curls aflutter. If she came from money, I would have known her by now&mdash;my father made sure to mingle me among families of our ilk.</p>

        <p>So I could not fathom how she had landed in the company of these preening swans. But I met her eye, and she met mine, and we drifted together on the landing, illuminated like a tableau.</p>

        <p>As we danced and talked and laughed, I felt a keen adoration&mdash;perhaps for the way she sang of her dreams, or the dance of chandelier crystals in her eyes&mdash;perhaps the way she had quipped, &ldquo;Lucille Mercer, it has a nice ring, doesn&rsquo;t it?&rdquo;</p>

        <p>In truth, it was none of those things, but the glamour of the change that was sweeping this smoky city, leaving its glitter everywhere. We, the youth of 1892, hung on the cusp of change. Daughters wrote where their mothers never had. Children could point at moths and speak to how their colours had changed, for they had a word for it: Evolution. And families had begun to shed the old manner of love, whittling away the vagaries of courtship till only the beating core was left. Our fathers and mothers had long dreamt of living by the whims of our hearts: we were the children of that dream.</p>

        <p>Adoration was enough, in this world, to pledge our love. So I did, two meetings later.</p>

    </details>
</div>

<hr>

<div class="writing-collapse">
<h2>
    To drown alone
    <span class="meta">
        Offshore side stories (2023)
        &bull;
        <a href="https://circlejourney.net/read/?story=offshore-stories&c=1">
            Full text
        </a>
    </span>
</h2>
<p>She wrenched her head under the seafoam, one kick at a time. The sunlight ribboned over her face as her toes dug into the sand.</p>

<p>She snapped her eyes shut. <em>It&rsquo;ll be easy,</em> she thought gently, as the seaweed curled around her ankle. <em>Tangle my foot, breathe the water in. Breathing in is the important part.</em></p>


<p>Five knots, six, each one a prayer to make this swift. As she worked away at the vestiges of her breath, her shoulders ached. She watched her vision bruise, felt the air go still in her lungs.</p>

<p>Then she breathed.</p>

<details>
    <summary>...</summary>

    <p>At the first skull-aching shock of water up one nostril, her air-hungry body snapped.</p>

    <p><em>Wrong, wrong, wrong,&nbsp;</em>it screamed, thoughts and visions and feelings blurring into one. She was puppeted by her own muscles, legs and lungs spasming, tearing, bucking, wresting her up through the water column, faster than a rising cork.</p>

    <p>She only began to sputter when her face broke the briny bubbling surface. Not one second sooner.</p>

    <p>Every sinew roared with tremors. Saltwater stung her eyes, tasting like a broth on her lips. The dry blue sky spun, not one cloud within her grasp, and she screamed without tears.</p>

    <hr>
    <p>She was sprinting through the night mist, watching the top of the Tienshi Tower dip in and out of the fog above, and for seconds she longed for the warmth of someone else.</p>

    <p>Millions across the world watched the sport, so millions knew her face. A sixth of the Helfi populace supported their team. Hundreds of thousands of fans&mdash;straining at the cables, breathing on the glass. They vivisected every one of her sentences, speculated upon every frown.</p>

    <p>But here, in Wulien City in the dead of night, there was no one. Times like these were the only ones when she could do anything she wanted. And she mostly spent them trying not to fall apart.</p>

    <p>Her bag bumped on her shoulder as she tore through the streets, stumbling and shivering in the wind between the skyscrapers. Through these neon-washed alleys and all their hard edges, silhouettes breathlessly swung in the windows, but here, there was no one.</p>

    <p>She couldn&rsquo;t&mdash;no, she wouldn&rsquo;t&mdash;tell her team anything. What would she say? That she had tried and failed yet again? That even in this, she couldn&rsquo;t succeed?</p>

    <p>Her feet chose this street to stop on; there was no saying why&mdash;under a flickering shop sign that lit her hands blue. She crumpled on the drain cover and howled like a wounded dog, the clarity of every sensation&mdash;the biting air, the edges of clouds, the cigarettes at her feet&mdash;as much accusation as solace. Every sob hurt like drawing water into her lungs.</p>
</details>

<hr>

<div class="writing-collapse">
    <h2>
        Three storms, three promises

        <span class="meta">
            Offshore side stories (2024)
            &bull;
            <a href="https://circlejourney.net/read/?story=offshore-stories&c=4">
                Full text
            </a>
        </span>
    </h2>
    <p>When it rains in Wulien, fountains overflow onto pavements. Every tourist&rsquo;s guide mentions the summer seastorms, but only in the way one glosses over secrets before a stranger. They say nothing of the way the rain beats, turning roads to rivers, or how the squall winds sing on storefront strings, the shutter-snaps of lightning before the thunder drops. When it rains in Wulien, it pours.</p>
    
    <p>From the day they first met on the bay, Jinai and Anqien could never forget that fact.</p>
    <details>
        <summary>...</summary>

        <p>The newborn team had seen each other once before, among Cloud Connectors&rsquo; boardroom windows, separated by so many tables. That had been a different light, thinned and filtered by tinted glass and reflections in mounted filographs. They could not have foreseen the years that would begin in in that room, although both had had a curious inkling, like an ache that portended rain.</p>

        <p>But here, the sun shone through hair, as through photo film, revealing different selves. As they beat clumsily onto the velvet tides of Muli Bay, Anqien began to coalesce a sense of Jinai that was more than a construct of light on a screen. She was real, flesh and blood and freckles on cheeks, and when her searching eyes met the glaring sun, they squinted.</p>

        <p>They weren&#39;t ready for her, they thought, and they never would be. They thought so hard that neither noticed the sun as it was swallowed by stormclouds. The forecast had said the rain would come, but it was one thing to hear its name, and another to drown in it.</p>

        <p>At the first scream of wind on the mast, the fledgling team gybed to starboard, Jinai crying, &ldquo;Let&rsquo;s go!&rdquo; as she waved for Anqien to turn the helm. A breath&rsquo;s hesitation, and then winches clicked, rope skittered, sea foam surged over their shoes. They swung away from the wind, skidding on the deck, while the mainsail swelled overhead in white and maroon.</p>

        <p>As they hurtled back landward, Jinai leaned at the stern and raised her head to the rain with a screaming laugh. &ldquo;Look at us go!&rdquo; she cried. &ldquo;The Cloudlander is back on the bay!&rdquo;</p>

        <p>And gods, if it didn&rsquo;t make Anqien&rsquo;s heart soar to hear that sound. &ldquo;You&rsquo;re gonna fall overboard!&rdquo; they called back.</p>

        <p>&ldquo;And it won&rsquo;t be the last time,&rdquo; Jinai shouted to the sky as it was rent by rain, despite Telaki&rsquo;s protests in their ears.</p>
</details>
</div>

<hr>

<div class="writing-collapse">
    <h2>
        Stars in the Dark
        <span class="meta">
            <em>Revolving Door</em> Chapter 23 (2019)
            &bull;
            <a href="https://rd.circlejourney.net/read/?c=23">
                Full text
            </a>
        </span>
    </h2>

    <p>You quickly get used to these starless San Francisco nights.</p>

    <p>Between the fire of early evening lights and the fog that tries to suffocate them, the stars are lucky if any of their light reaches the roads. You know there&rsquo;s no need to search for anything past the smoldering sodium lights, past the pinnacles of those thousand&nbsp;towers. Only the moon glows through, a fragment of a disk.</p>
    <details>    
        <summary>...</summary>

        <p>If you ride to the outer hills and south to the suburbs, you might see their light trickle through. But that&rsquo;s not how it goes. Most will never leave: queues of tents stand frail under the freeways, and beggars lie in benches by piers of LEDs, waiting for something better than a view of the stars.</p>

        <p>From your fledgling days, you&rsquo;ve learned about the stars from what others say about them. Dozing in a sling on your mother&rsquo;s hip, you listened to her spin yarns about sailors in space while she cooked. She told you how the stars were brighter in her childhood, how they began to disappear as the city grew taller.</p>

        <p>In middle school, you smuggled your tablet into class to watch the launch of the Fortitude 3 under your desk. While Ms. Santos read off her slides about random-access memory, you watched the tiny, historic shuttle draw a path of smoke through the stratosphere.</p>

        <hr>

        <p><span style="line-height:107%">The year you leave home for college, the Fortitude 3&#39;s crew completes its first orbit of Saturn on Titan. In the radio interviews, the astronauts talk more about home than space, static punctuating their tearful grieving for the world they haven&#39;t seen in a decade.</p>

        <p>The year you leave home for college,&nbsp;it begins to dawn on you that it doesn&rsquo;t matter that the constellations wouldn&#39;t exist in another galaxy, in another epoch.</p>

        <p>Nothing in life has meaning, by that token. All things are just arrangements of atoms. They will only mean something briefly. They will only mean something while you have stories to tell about them.</p>

        <p>What difference is there, between drawing shapes in the stars, and molding clay into the figures of gods? Or framing up a photo where you and your best friend are still together?</p>
    </details>
</div>

<hr>

<div class="writing-collapse">
        <h2>
            Icebreaker
            
            <span class="meta">
                <em>Revolving Door</em> Chapter 9 (2016)
                &bull;
                <a href="https://rd.circlejourney.net/read/?c=9">
                    Full text
                </a>
            </span>
        </h2>

        <p>Sabina&rsquo;s face contorts.&nbsp;&ldquo;Why do anything, if we all die?&rdquo;&nbsp;she retorts.&nbsp;&ldquo;Why did every single one of those billions of people who have ever lived&mdash;why did they do anything at all?&rdquo;</p>

        <p>&ldquo;I don&rsquo;t know!&rdquo;</p>
    <details>
        <summary>...</summary>

        <p>&ldquo;Me neither! I would be deluded to believe that my work will change the world&rsquo;s fate! But there is no way the alternative could be better. There is no way&nbsp;not existing&nbsp;could be better than existing, and trying. Because&mdash;I saved a man&rsquo;s life last week. Because I am the meaning to&nbsp;someone else&rsquo;s&nbsp;life, and I have no right to decide for&nbsp;them&nbsp;that life isn&rsquo;t worth the while&mdash;&rdquo;</p>

        <p>She breaks off, and their gazes meet again, both wet. Artur steps forward, and takes her in a gentle embrace.</p>

        <p>&ldquo;I hope&hellip;to see you again,&rdquo;&nbsp;he replies, unable to keep the sharp sting of grief from fragmenting his sentence.&nbsp;&ldquo;I am in Dikson every year in February.&rdquo;</p>

        <p>&ldquo;I shall try to return soon.&rdquo;</p>

        <p>Then Sabina kisses him. And then she descends the creaky wooden staircase, and Artur does not follow.</p>

        <p>And then she is gone.</p>

        <hr>

        <p><strong>2 June, 2214</strong></p>

        <p><em>&ldquo;Seismology readings indicate 82&rsquo; 32&rdquo; N 55&rsquo; 10&rdquo; E crust less than a kilometre thick, 80-90% chance of being an oil trap.&rdquo;</em></p>

        <p>The transmission sends all the cabins into a frenzy. Even Andreyeva joins in the impromptu below-deck festivities that night, and Artur continues to hear about the findings for several days.</p>

        <p>They must have found what they are looking for, then, and he tries to be happy for them. A couple of scientists ask him that evening&mdash;in a friendly tone, of course&mdash;if he is able to steer them faster. He says he will see what he can do.</p>

        <p>That evening, as he stands alone facing the ocean at the helm of the ship, surrounded by the banshee-screams of the wind, he lifts his hands like a conductor before his orchestra.</p>

        <p>No one notices that the waves are parting more easily at the bow, or that the&nbsp;<em>Dmitri Melnikov&nbsp;</em>is moving two knots faster than its top speed.</p>

        <hr>

        <p>Artur closes his eyes against a sudden cascade of memories, like a tower of cards collapsing from a shelf above.</p>

        <p>Vladivostok&hellip;the Zolotoy Rog Bay&hellip;his family&hellip;Sabina&hellip;all that.</p>

        <p>It&rsquo;s all in his memory somewhere. If only he could project it onto reality, the way the scientists in history said the universe is projected from two-dimensional data. If only his remembering were enough to make it exist again.</p>

        <p>&ldquo;Will I see anyone more than twice?&rdquo;&nbsp;he asks the air, the water at the hull full of ice fragments. A stream of aurora has lit up on the horizon.&nbsp;&ldquo;Does it matter if I never do? If I forget her, does she stop existing?&rdquo;</p>

        <p>And the surface of the world continues to cool beneath the nuclear dust, trees giving out to the darkness, and he braces himself as the icebreaker bow cracks the edge of the floe.</p>
</details>
</div>

<hr>
<div class="writing-collapse">
    <h2>Spring
        <span class="meta">
            <em>Deja Vu</em> Chapter 1 (2020)
            &bull;
            <a href="https://archiveofourown.org/works/24154627">
                Full text
            </a>
        </span>
    </h2>

    <p>Years before the twins were the faintest inkling in Hop&#39;s mind, the house up the street stood forlorn and empty on the knoll.</p>

    <p>No one in Postwick seemed to remember a time when it had been inhabited: all it had to show for a garden was a thicket of briars higher than the waist, and parts of the drystack wall were cracked, where the errant yew roots had burrowed under.</p>
    
    <details>
        <summary>...</summary>
        <p>Hop&#39;s last memory of Leon in Postwick centred around that very house. It was early evening&mdash;or perhaps his memory coloured the sky wrong&mdash;when the older boy, taking the house&#39;s unspoken dare, scaled the garden wall with his brother cheering him on. Landing with a thump on the other side, he blundered through the leaves, twigs crackling merrily underfoot.</p>

        <p>&quot;Whoa, Hop, you have to see this! There&#39;s roses here!&quot;</p>

        <p>Five years old and his brother&#39;s shadow, Hop was quicker to follow than to think. One hand over the other, he clambered up the stones till he straddled the drystack, and his vision swayed when he saw that his legs only reached halfway down the wall. There was Lee, waiting in the tangle of briars and roses. &quot;Just one jump!&quot; he shouted, pumping a fist.</p>

        <p>So little Hop yelled, and leapt, and tumbled in, piercing his knee on a thorn.</p>

        <p>The boy&#39;s wailing was what brought their mum and grandpa sprinting up the street, crying out his name in panic. He would never forget how the blood streaked his palms, red as the roses, and how his tears blurred the colours together while Leon shouted curse words he wasn&#39;t allowed to say.</p>

        <p>That was the last trouble the two brothers got into together before Leon, turning ten, left on his gym challenge. He&#39;d seen it coming: they had been counting off the days on a Galar League calendar in the kitchen, and when the big red-circled day came with its blue sky and Wooloo-white clouds, the older boy slung his brand new backpack over his shoulder and hugged each family member in turn, promising that he&#39;d win the cup.</p>

        <p>That was the last they saw of him, and soon Hop had forgotten all about the briar roses, with only a scar on the knee to remember them by.</p>
    </details>
</div>

<hr>
<div class="writing-collapse">
    <h2>Year of the Dragon
        <span class="meta">
            <em>Of the Dragon, of the Stars</em>, Chapter 12 (2013)
        </span>
    </h2>

    <p>&quot;I&#39;m sorry, I&#39;m sorry I never said it.&quot;</p>

    <p><em>We shared a loveless womb. Loveless, that&#39;s what we were made to be.</em></p>

    <p>&quot;Why didn&#39;t you?&quot;</p>

    <p>&quot;Because it hurt.&quot; She shook her head, voice quavering. &quot;Not that it matters&mdash;&quot;</p>

    <p>For once, Turino had nothing to say.</p>

    <p>Here in this endless cave of stars, between the arcing sky above and the branch where they sat, Telida felt smaller than a speck of dust. Dust, all of them dust&mdash;the wind had carried them far apart&mdash;and now, though he sat right beside her, legs dangling into the forest, it felt like there were hundreds of miles between them. She&#39;d never reach him in time.</p>
    
    <details>
        <summary>...</summary>
        <p>She glanced up for stars again, but in a breath the sky had clouded up. She watched Turino&#39;s eyes dampen. Her own tears ached in her throat, and ran down her face.</p>

        <p>&quot;Why?&quot; she asked softly. &quot;Why this hate? Where did it come from?&quot;</p>

        <p>&quot;You...you hated me first,&quot; he answered, but his voice croaked a little.</p>

        <p>&quot;Why don&#39;t I love you anymore? Why did it stop?&quot;</p>

        <p>&quot;Your love is with someone else,&quot; answered the Mage, glancing beneath them, at the sleeping warrior. &quot;There isn&#39;t any left for me. And in me there isn&#39;t any left for you.&quot;</p>

        <p>She sagged backward against the trunk. How wearying, the world, and her brother, and love, and hate. &quot;You&hellip;me&hellip;I don&#39;t know when&hellip;&quot;</p>

        <p>The whirl of the world grew heavy and then she thought she saw glowing white specks descending through the branches. She felt her head sink; she was tired, so tired.</p>
    </details>
</div>
@endsection
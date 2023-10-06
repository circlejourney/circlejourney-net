function preload() {
    rdtext = loadStrings('RDtxt.txt');
    offshoretext = loadStrings('Offshore.txt');
}

function setup() {
    var args = {
        tense: RiTa.PAST_TENSE,
        number: RiTa.SINGULAR,
        person: RiTa.THIRD_PERSON
    };
    
    const content = createDiv("A New Story");
    
    const offshoreRiTa = new RiMarkov(3);
    offshoreRiTa.loadText(offshoretext.join(" ").replace(/[\"“”]/g, ""));
    const offshoreSentences = offshoreRiTa.generateSentences(10);

    offshoreSentences.forEach((i)=>{
        content.elt.appendChild(createP(i).elt);
    });
}
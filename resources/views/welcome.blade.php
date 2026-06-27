@extends("layouts.canonical")

@section("content")
    
    <div id="tagline" style="text-align: center">
        <b>🇸🇬 in 🇦🇺 • they/them • Artist, writer, web developer</b>
        <br>
        BFA (Hons.) Digital Animation • MFA Interactive Media • PhD Interaction Design
    </div>
    <div class="spacer"></div>
    <div id="announcements" style="width: 100%; text-align: center">
            I'm a storyteller and web developer whose heart still lives in the port I grew up beside. I create visual, written and interactive works about urban space, the sea, death and hauntings, mapping, and the many meanings of "home" and "place".
    </div>

    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="center announcements">
        Navigate by category from the menu above, or select a project/work below.
    </div>

    <h2>
        Comics and Interactive Narratives
    </h2>

    @include('components.banner-grid', ['projects' => $interactive_narrative, 'variable_rows' => 1])
    
    <h2>
        Other Interactive Works
    </h2>
    
    @include('components.banner-grid', ['projects' => $interactive])
    
    <h2>
        Literature
    </h2>
    
    @include('components.banner-grid', ['projects' => $writing])

@endsection
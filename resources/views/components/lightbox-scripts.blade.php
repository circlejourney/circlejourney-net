<link rel="stylesheet" href="/css/lightbox.css?{{ filemtime(public_path('css/lightbox.css')) }}">
<script src="/js/lightbox.js" type="text/javascript"></script>
<script>
    let lightbox;
    $(document).ready(() => {
        lightbox = new Lightbox(document.getElementById("lightbox"));
    })
</script>
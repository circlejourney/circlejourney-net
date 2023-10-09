<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GalleryArt extends Component
{
    public $src;
    public $href;

    public function __construct(string $src, string $href, public bool $openlightbox)
    {
        if(!preg_match("/^https?:\/\//", $src) && !preg_match("/^\//", $src)) $src = "/" . $src;
        if(!preg_match("/^https?:\/\//", $href) && !preg_match("/^\//", $href)) $href = "/" . $href;
        $this->src = $src;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gallery-art');
    }
}

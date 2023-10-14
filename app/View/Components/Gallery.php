<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Gallery extends Component
{   /*
        The gallery component should simplify generating simple galleries (e.g. where there is only one on the page). Takes a collection of artworks and renders them into the lightbox and gallery.
    */
    public $sequence = 0;
    public $lightboxable;
    /**
     * Create a new component instance.
     */
    public function __construct(public $artworks)
    {
        $this->lightboxable = $artworks->filter(function($artwork) { return $artwork->openlightbox; });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gallery');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Bannerbutton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($href, $background_image, $background_position, $dark, $label_title, $label_text)
    {
        $this->href = $href;
        $this->background_image = $background_image;
        $this->background_position = $background_position;
        $this->dark = $dark;
        $this->label_title = $label_title;
        $this->$label_text = $label_text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bannerbutton');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Project;

class Bannerbutton extends Component
{
    public $href;
    public $background_image;
    public $background_position;
    public $label_title;
    public $label_text;
    public $dark;

    public function __construct(Project $project)
    {
        $this->href = $project->href;
        $this->background_image = $project->background_image;
        $this->background_position = $project->background_position;
        $this->label_title = $project->label_title;
        $this->label_text = $project->label_text;
        $this->dark = $project->dark;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bannerbutton');
    }
}

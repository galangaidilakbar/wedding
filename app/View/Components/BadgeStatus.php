<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BadgeStatus extends Component
{
    /*
     * The color of the badge.
     *
     * @var string
     */
    public string $color;

    /*
     * The text of the badge.
     *
     * @var string
     */
    public string $text;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $color, string $text)
    {
        $this->color = $color;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.badge-status');
    }
}

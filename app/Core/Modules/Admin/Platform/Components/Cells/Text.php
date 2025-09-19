<?php

namespace Flute\Admin\Platform\Components\Cells;

use Closure;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Text extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected mixed $value,
        protected ?string $title = null,
        protected ?string $text = null,
        protected ?int $words = 30,
        protected ?int $clamp = 5,
    ) {
    }

    /**
     * Get the view/contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render()
    {
        return Blade::render('<div class="text-balance line-clamp {{ $class }}">
                              @empty(!$title)<strong class="d-block">{{ $title }}</strong>@endempty
                              <span class="text-muted">{{ $text }}</span></div>', [
            'class' => $this->clamp ? 'line-clamp-' . $this->clamp : '',
            'title' => $this->title ? Str::of($this->value->getContent($this->title))->words($this->words) : '',
            'text' => Str::of($this->value->getContent($this->text))->words($this->words),
        ]);
    }
}

<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Sinnbeck\Markdom\Facades\Markdom;
use TOC\MarkupFixer;
use TOC\TocGenerator;
use Knp\Menu\Renderer\ListRenderer;
use Knp\Menu\Matcher\Matcher;

class PostDetails extends Component
{
    use AuthorizesRequests;

    public Post $post;

    public string $menu, $content = '';
    public string $theme = 'vs2015';
    public $tags;
    protected $paginationTheme = 'bootstrap';

    public function mount($post)
    {
        abort_if(!$post->active, 404, 'Not Found');

        $this->post = $post;

        $this->tags = explode(',', $this->post->tags);

        $markupFixer = new MarkupFixer();
        $tocGenerator = new TocGenerator();

        $tohtml = Markdom::toHtml($this->post->body);

        // $this->content = "<div class='content'>" . $markupFixer->fix(htmlspecialchars_decode($tohtml)) . "</div>";

        $this->content = "<div class='content'>" . $markupFixer->fix($tohtml) . "</div>";

        $this->menu = "<div class='toc'>" . $tocGenerator->getHtmlMenu($this->content, 1, 3) . "</div>";
    }

    public function render()
    {
        return view('livewire.posts.post-details')->extends('layouts.post')
            ->section('content');
    }
}

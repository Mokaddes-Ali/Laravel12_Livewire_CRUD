<?php
namespace App\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;

class ShowArticles extends Component
{
    use WithPagination;

    public function render()
    {
        $articles = Article::select('id', 'author', 'title','Status','published_at')
        ->orderBy('id', 'desc')
        ->paginate(60);
        return view('livewire.articles.show-articles', compact('articles'));
    }
}

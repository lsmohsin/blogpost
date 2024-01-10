<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Tag;

class TagComposer
{
public function compose(View $view)
{
$tags = Tag::all();
$view->with('tags', $tags);
}
}

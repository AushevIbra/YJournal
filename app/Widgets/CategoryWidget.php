<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Ads\Category;

class CategoryWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $categories = Category::where("parent_id", 0)->with('children')->get();

        return view('widgets.category_widget', [
            'config' => $this->config,
            'categories' => $categories
        ]);
    }
}

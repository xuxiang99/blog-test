<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SidebarComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.sidebar', function($view){
            $tags = \App\Tag::all();
            $date = \App\Article::pluck('created_at');
            $times = array();
            foreach ($date as $value) {
                $value = date('Y/m', strtotime($value));
                if (!in_array($value, $times)) {
                    array_push($times, $value);
                }
            }
            $view->with(['tags' => $tags, 'times' => $times]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

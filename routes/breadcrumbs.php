<?php
\DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::for('home', function ($trail){
    $trail->push('Home',route('home'));
});
// Home > Article
\DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::for('article', function ($trail){
    $trail->parent('home');
    $trail->push('> Article',route('article',request()->route()->parameter('slug')));
});

\DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::for('complaint',function ($trail){
    $trail->parent('article');
    $trail->push('> Complaint', route('complaint',request()->route()->parameter('slug')));
});

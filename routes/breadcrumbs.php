<?php

Breadcrumbs::register('top', function($breadcrumbs) {
    $breadcrumbs->push('Top', route('top'));
});

Breadcrumbs::register('todo', function ($breadcrumbs) {
    $breadcrumbs->parent('top');
    $breadcrumbs->push('Todoリスト', route('todo'));
});
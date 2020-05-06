<?php
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Home', route('admin.dashboard'));
});
Breadcrumbs::for('admin.posts.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Posts', route('admin.posts.index'));
});
Breadcrumbs::for('admin.posts.create', function ($trail) {
    $trail->parent('admin.posts.index');
    $trail->push('Create Posts', route('admin.posts.create'));
});
Breadcrumbs::for('admin.posts.edit', function ($trail, $post) {
    $trail->parent('admin.posts.index');
    $trail->push('Edit Posts', route('admin.posts.edit', $post));
});
Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.users.index'));
});
Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Category', route('admin.category.index'));
});
Breadcrumbs::for('admin.category.create', function ($trail) {
    $trail->parent('admin.category.index');
    $trail->push('Create Category', route('admin.category.create'));
});
Breadcrumbs::for('admin.category.edit', function ($trail, $category) {
    $trail->parent('admin.category.index');
    $trail->push('Edit Category', route('admin.category.edit', $category));
});

<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Profile
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('profile.edit'));
});

// Items
Breadcrumbs::for('items.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Items', route('items.index'));
});

Breadcrumbs::for('items.show', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('items.index');
    $trail->push($item->name, route('items.show', $item));
});

// Trades
Breadcrumbs::for('trades.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Trades', route('trades.index'));
});

Breadcrumbs::for('trades.show', function (BreadcrumbTrail $trail, $trade) {
    $trail->parent('trades.index');
    $trail->push('Trade Details', route('trades.show', $trade));
});

Breadcrumbs::for('trades.create', function (BreadcrumbTrail $trail, $item, $user) {
    $trail->parent('trades.index');
    $trail->push('Create Trade', route('trades.create', ['item' => $item, 'user' => $user]));
});

// User Items
Breadcrumbs::for('user.items.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Items', route('user.items.index'));
});

Breadcrumbs::for('user.items.show', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('user.items.index');
    $trail->push($item->name, route('user.items.show', $item));
});

// Admin Users
Breadcrumbs::for('admins.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Admin Users', route('admins.users.index'));
});

Breadcrumbs::for('admins.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admins.users.index');
    $trail->push('Create User', route('admins.users.create'));
});

Breadcrumbs::for('admins.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admins.users.index');
    $trail->push($user->name, route('admins.users.show', $user));
});

Breadcrumbs::for('admins.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admins.users.index');
    $trail->push('Edit User', route('admins.users.edit', $user));
});

// Admin Items
Breadcrumbs::for('admins.items.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Admin Items', route('admins.items.index'));
});

Breadcrumbs::for('admins.items.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admins.items.index');
    $trail->push('Create Item', route('admins.items.create'));
});

Breadcrumbs::for('admins.items.show', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('admins.items.index');
    $trail->push($item->name, route('admins.items.show', $item));
});

Breadcrumbs::for('admins.items.edit', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('admins.items.index');
    $trail->push('Edit Item', route('admins.items.edit', $item));
});

// Admin Items Giver
Breadcrumbs::for('admins.items-giver.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Items Giver', route('admins.items-giver.index'));
});

Breadcrumbs::for('admins.items-giver.store', function (BreadcrumbTrail $trail) {
    $trail->parent('admins.items-giver.index');
    $trail->push('Store Item', route('admins.items-giver.store'));
});

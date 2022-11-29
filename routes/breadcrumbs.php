<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail, $name, $parentDirectories) {
    $trail->push($name, route('toDirectory', $parentDirectories), ['pieces' => implode('/', $parentDirectories)]);
});

Breadcrumbs::for('toDirectory', function (BreadcrumbTrail $trail, $directories) {
    $piecesParentDirectories = array_diff(explode('/', $directories[0]->pathTo), [$directories[0]->name]);
    $parentDirectories = [];
    foreach ($piecesParentDirectories as $piece) {
        if($piece !== $directories[0]->rootDirectory) {
            $parentDirectories [] = $piece;
        }
        $trail->parent('home', $piece, $parentDirectories);
    }
});

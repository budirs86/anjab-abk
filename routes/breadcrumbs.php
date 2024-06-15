<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// create a breadcrumb for buat ajuan page
Breadcrumbs::for('buat-ajuan', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Buat Ajuan', route('anjab.buat-ajuan'));
});



// Create Breadcumb for Ajuan Analisis Jabatan
Breadcrumbs::for('ajuan-analisis-jabatan', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Daftar Ajuan Analisis Jabatan', route('anjab.ajuans'));
});


// Create a breadcrumb for lihat ajuan analisis jabatan page, parent-ing the ajuan analisis jabatan breadcrumb
Breadcrumbs::for('lihat-ajuan-analisis-jabatan', function (BreadcrumbTrail $trail) {
    $trail->parent('ajuan-analisis-jabatan');
    $trail->push('Lihat Ajuan Analisis Jabatan', "/anjab/lihat-ajuan-analisis-jabatan");
});

// create a breadcrumb for data jabatan page, parent-ing the buat ajuan breadcrumb
Breadcrumbs::for('data-jabatan', function (BreadcrumbTrail $trail) {
    $trail->parent('buat-ajuan');
    $trail->push('Data Jabatan', "/anjab/data-jabatan");
});




// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});
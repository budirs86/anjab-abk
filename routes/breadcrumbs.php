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

// create a breadcrumb for ubah informasi jabatan page, parent-ing the data jabatan breadcrumb
Breadcrumbs::for('ubah-informasi-jabatan', function (BreadcrumbTrail $trail) {
    $trail->parent('data-jabatan');
    $trail->push('Ubah Informasi Jabatan', "/anjab/analisis-jabatan/create");
});

// create a bredcrumb for buat ajuan abk page, parent-ing the home breadcrumb
Breadcrumbs::for('buat-ajuan-abk', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Buat Ajuan ABK', "/abk/ajuan/create");
});

// create a breadcrumb for isi informasi abk page, parent-ing the buat ajuan abk breadcrumb
Breadcrumbs::for('isi-informasi-abk', function (BreadcrumbTrail $trail) {
    $trail->parent('buat-ajuan-abk');
    $trail->push('Isi Informasi ABK', "/abk/ajuan/data-abk");
});

Breadcrumbs::for('informasi-abk-jabatan', function (BreadcrumbTrail $trail, $jabatan) {
    $trail->parent('lihat-ajuan-abk');
    $trail->push('Edit Informasi ABK'. ' ' . $jabatan->nama_jabatan, "/abk/ajuan/data-abk");
});


// create a breadcrumb for daftar ajuan abk page, parent-ing the home breadcrumb
Breadcrumbs::for('daftar-ajuan-abk', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Daftar Ajuan ABK', "/abk/ajuans");
});


// create a breadcrumb for lihat ajuan abk page, parent-ing the buat ajuan abk breadcrumb
Breadcrumbs::for('lihat-ajuan-abk', function (BreadcrumbTrail $trail) {
    $trail->parent('daftar-ajuan-abk');
    $trail->push('Lihat Ajuan ABK', "");
});

Breadcrumbs::for('edit-ajuan-abk', function (BreadcrumbTrail $trail) {
    $trail->parent('daftar-ajuan-abk');
    $trail->push('Edit Ajuan ABK', "");
});

// 


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
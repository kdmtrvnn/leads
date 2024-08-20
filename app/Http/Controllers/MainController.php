<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class MainController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Main', [
            'title' => 'Main page - ' . config('app.name'),
        ]);
    }
}

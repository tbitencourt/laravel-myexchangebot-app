<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function index()
    {
        return redirect('/dashboard');
    }
}

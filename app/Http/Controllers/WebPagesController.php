<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class WebPagesController extends Controller
{
    public function index()
    {
        $todaysActions = Action::getTodaysActions();

        return view('web-pages.index', compact(['todaysActions']));
    }
}

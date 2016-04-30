<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.profile');
    }
}

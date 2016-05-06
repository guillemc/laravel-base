<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->filter($request, 'page_size', [$this, 'sanitizePageSize']);
        $search = $this->querySession($request, 'search', 'administrator.search', []);
        $page = $this->querySession($request, 'page', 'administrator.page', 1);
        $pageSize = $this->querySession($request, 'page_size', 'page_size', 20);

        $users = App\Admin::paginate($pageSize);

        return view('admin.administrator.index', compact('users', 'search', 'page', 'pageSize'));
    }
}

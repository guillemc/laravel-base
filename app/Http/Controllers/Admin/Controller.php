<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Illuminate\Http\Request;

use App\Http\Requests\FiltersInput;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests, FiltersInput;

    protected $name;

    public function __construct()
    {
        $this->middleware('auth:back');

        $a = explode('\\', get_called_class());
        $this->name = array_pop($a);

        view()->share('pageSizes', [20, 40, 80, 120]);
        view()->share('pjax', request()->header('X-PJAX', false));
    }


    public function getSearch($request, $default = [])
    {
        $search = $this->getFromQueryOrSession($request, 'search', "{$this->name}.search", $default);
        return is_array($search) ? $search : [];
    }

    public function getOrder($request, $default = [])
    {
        $order = $this->getFromQueryOrSession($request, 'order', "{$this->name}.order", $default);
        return is_array($order) ? $order : [];
    }

    public function getPage($request, $default = 1)
    {
        return $this->getFromQueryOrSession($request, 'page', "{$this->name}.page", $default);
    }

    public function getPageSize($request, $default = 20)
    {
        $pageSize = $this->getFromQueryOrSession($request, 'page_size', 'page_size', $default);
        return ($pageSize <= 200 && $pageSize >= 1) ? $pageSize : $default;
    }


    protected function getFromQueryOrSession(Request $request, $queryKey, $sessionKey, $default = null)
    {
        $session = $request->session();

        // get value from session, or default
        $value = $session->get($sessionKey, $default);

        // query takes precedence, and writes to session
        $queryValue = $request->query($queryKey, null);
        if (null !== $queryValue) {
            $value = $queryValue;
            $session->set($sessionKey, $value);
        }

        return $value;
    }

}

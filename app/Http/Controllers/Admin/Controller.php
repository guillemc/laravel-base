<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Illuminate\Http\Request;

use App\Http\Requests\FiltersInput;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests, FiltersInput;

    public function __construct()
    {
        $this->middleware('auth:back');
    }

    protected function querySession(Request $request, $queryKey, $sessionKey, $default = null)
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

    protected function sanitizePageSize($pageSize)
    {
        $validSizes = [20, 40, 80, 120];
        if (!in_array($pageSize, $validSizes)) {
            return $validSizes[0];
        }
        return $pageSize;
    }

}

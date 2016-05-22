<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    protected function filterRequest(Request $request)
    {
        $this->filter($request, ['name', 'email', 'password'], 'trim');
    }

    protected function getValidationRules($model = null)
    {
        $rules = [
            'name' => 'required|max:60',
            'email' => 'required|email|max:120',
            'password' => 'min:6|max:120|confirmed',
        ];

        if (!$model) {
            $rules['password'] = 'required|'.$rules['password'];
            $rules['email'] .= '|unique:users';
        } else {
            $rules['email'] .= '|unique:users,email,'.$model->id;
        }

        return $rules;
    }

    public function index(Request $request)
    {
        $search = $this->getSearch($request);
        $order = $this->getOrder($request);
        $pageSize = $this->getPageSize($request);
        $page = $this->getPage($request);

        $pager = $this->repository->paginate($search, $order, $pageSize, $page);

        return view('admin.user.index', compact('pager', 'search', 'order'));
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        if (!$request->ajax()) {
            return redirect()->route('admin.user.index');
        }
    }

    public function edit(Request $request, User $user)
    {
        return view('admin.user.edit')->with('model', $user);
    }

    public function update(Request $request, User $user) {
        $this->filterRequest($request);
        $this->validate($request, $this->getValidationRules($user));
        if ($password = $request->input('password')) {
            $request->merge(['password' => bcrypt($password)]);
            $user->update($request->all());
        } else {
            $user->update($request->except('password'));
        }
        // Session::flash('status', trans('admin.status_successfully_updated'));
        return redirect()->route('admin.user.index');
    }

    public function create(Request $request)
    {
        $user = new User();
        return view('admin.user.edit')->with('model', $user);
    }

    public function store(Request $request) {
        $this->filterRequest($request);
        $this->validate($request, $this->getValidationRules());
        $request->merge(['password' => bcrypt($request->input('password'))]);
        User::create($request->all());
        // Session::flash('status', trans('admin.status_successfully_created'));
        return redirect()->route('admin.user.index');
    }

    public function show(Request $request, User $user)
    {
        return view('admin.user.show')->with('model', $user);
    }
}

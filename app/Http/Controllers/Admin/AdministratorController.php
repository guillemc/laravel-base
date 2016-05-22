<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Gate;


class AdministratorController extends Controller
{
    public function __construct(AdminRepository $repository)
    {
        parent::__construct();
        if (Gate::denies('administrator.manage')) {
            abort(403);
        }
        $this->repository = $repository;
    }

    protected function filterRequest(Request $request)
    {
        $this->filter($request, ['name', 'email', 'password'], 'trim');
    }

    protected function getValidationRules($model = null)
    {
        $uniqueEmail = $model ?
                'unique:admins,email,'.$model->id
                : 'unique:admins';
        $rules = [
            'name' => 'required|max:60',
            'email' => 'required|email|max:120|'.$uniqueEmail,
            'role' => 'required|in:'.implode(',', array_keys(Admin::getOptions('role')))
        ];

        if (!$model) {
            $rules['password'] = 'required|min:6|max:120|confirmed';
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

        return view('admin.administrator.index', compact('pager', 'search', 'order'));
    }

    public function destroy(Request $request, Admin $administrator)
    {
        $administrator->delete();
        if (!$request->ajax()) {
            return redirect()->route('admin.administrator.index');
        }
    }

    public function edit(Request $request, Admin $administrator)
    {
        return view('admin.administrator.edit')->with('model', $administrator);
    }

    public function update(Request $request, Admin $administrator) {
        $this->filterRequest($request);
        $this->validate($request, $this->getValidationRules($administrator));
        $administrator->update($request->all());
        // Session::flash('status', trans('admin.status_successfully_updated'));
        return redirect()->route('admin.administrator.index');
    }

    public function create(Request $request)
    {
        $administrator = new Admin();
        return view('admin.administrator.edit')->with('model', $administrator);
    }

    public function store(Request $request) {
        $this->filterRequest($request);
        $this->validate($request, $this->getValidationRules());
        $request->merge(['password' => bcrypt($request->input('password'))]);
        Admin::create($request->all());
        // Session::flash('status', trans('admin.status_successfully_created'));
        return redirect()->route('admin.administrator.index');
    }

    public function show(Request $request, Admin $administrator)
    {
        return view('admin.administrator.show')->with('model', $administrator);
    }
}

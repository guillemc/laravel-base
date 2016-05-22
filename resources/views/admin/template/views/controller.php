<?php

$model_name = snake_case($modelName);

?>
&lt;?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use <?= $modelFullName ?>;
use App\Repositories\<?= $modelName ?>Repository;


class <?= $modelName ?>Controller extends Controller
{
    public function __construct(<?= $modelName ?>Repository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    protected function filterRequest(Request $request)
    {
        $this->filter($request, ['name', 'email'], 'trim');
    }

    protected function getValidationRules($model = null)
    {
        return [
            // 'name' => 'required|max:60',
            // ...
        ];
    }

    public function index(Request $request)
    {
        $search = $this->getSearch($request);
        $order = $this->getOrder($request);
        $pageSize = $this->getPageSize($request);
        $page = $this->getPage($request);

        $pager = $this->repository->paginate($search, $order, $pageSize, $page);

        return view('admin.<?= $model_name ?>.index', compact('pager', 'search', 'order'));
    }

    public function destroy(Request $request, <?= $modelName ?> $<?= $model_name ?>)
    {
        $<?= $model_name ?>->delete();
        if (!$request->ajax()) {
            return redirect()->route('admin.<?= $model_name ?>.index');
        }
    }

    public function edit(Request $request, <?= $modelName ?> $<?= $model_name ?>)
    {
        return view('admin.<?= $model_name ?>.edit')->with('model', $<?= $model_name ?>);
    }

    public function update(Request $request, <?= $modelName ?> $<?= $model_name ?>) {
        $this->filterRequest($request);
        $this->validate($request, $this->getValidationRules($<?= $model_name ?>));
        $<?= $model_name ?>->update($request->all());
        // Session::flash('status', trans('admin.status_successfully_updated'));
        return redirect()->route('admin.<?= $model_name ?>.index');
    }

    public function create(Request $request)
    {
        $<?= $model_name ?> = new <?= $modelName ?>();
        return view('admin.<?= $model_name ?>.edit')->with('model', $<?= $model_name ?>);
    }

    public function store(Request $request) {
        $this->filterRequest($request);
        $this->validate($request, $this->getValidationRules());
        <?= $modelName ?>::create($request->all());
        // Session::flash('status', trans('admin.status_successfully_created'));
        return redirect()->route('admin.<?= $model_name ?>.index');
    }

    public function show(Request $request, <?= $modelName ?> $<?= $model_name ?>)
    {
        return view('admin.<?= $model_name ?>.show')->with('model', $<?= $model_name ?>);
    }
}

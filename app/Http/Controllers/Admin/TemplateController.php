<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TemplateController extends Controller
{

    protected $labelFields = ['title', 'name', 'email', 'label', 'code', 'id'];
    protected $positionFields = ['position', 'pos'];

    public function index(Request $request)
    {

        $err = new MessageBag();

        $name = $request->query('name');
        $model = null;
        $fields = [];

        if ($name) {
            if (class_exists($name)) {
                $model = new $name();
            } else {
                $err->add('name', 'Invalid model class name: '.$name);
            }
        }

        $templates = [];

        $controls = [];
        $searchFields = [];
        $listFields = [];

        if ($model) {

            $table = $model->getTable();

            $columns = Schema::getColumnListing($table);
            $fields = [];
            foreach ($columns as $k) {
                try {
                    $fields[$k] = Schema::getColumnType($table, $k);
                } catch (\Doctrine\DBAL\DBALException $e) {
                    $fields[$k] = 'string';
                }
            }
            $controls = array_merge($this->getDefaultControls($fields), $request->query('controls', []));
            $searchFields = array_merge($this->getDefaultSearchFields($fields), $request->query('searchFields', []));
            $listFields = array_merge($this->getDefaultListFields($fields), $request->query('listFields', []));
            $templates = $this->getTemplates($model, $fields, $controls, $searchFields, $listFields);
        }

        return view('admin.template.index', compact('err', 'name', 'model', 'fields', 'controls', 'searchFields', 'listFields', 'templates'));
    }

    protected function getTemplates($model, $fields, $controls, $searchFields, $listFields)
    {
        $modelFullName = get_class($model);
        $modelName = $modelFullName;
        if ($pos = strrpos($modelFullName, '\\')) {
            $modelName = substr($modelFullName, $pos + 1);
        }

        $controller = view('admin.template.views.controller', compact('modelName', 'modelFullName'));

        $labelFields = $this->labelFields;
        $titleField = 'id';
        foreach ($labelFields as $t) {
            if (isset($fields[$t])) {
                $titleField = $t;
                break;
            }
        }

        $positionField = null;
        foreach ($this->positionFields as $t) {
            if (isset($fields[$t]) && $fields[$t] == 'integer') {
                $positionField = $t;
                break;
            }
        }

        $repository = view('admin.template.views.repository', compact('modelName', 'modelFullName', 'fields', 'searchFields', 'listFields', 'positionField'));

        $index = view('admin.template.views.index', compact('modelName', 'modelFullName', 'fields', 'listFields', 'labelFields', 'positionField'));

        $edit = view('admin.template.views.edit', compact('modelName', 'modelFullName', 'fields', 'titleField', 'controls'));

        $show = view('admin.template.views.show', compact('modelName', 'modelFullName', 'fields', 'titleField'));

        $templates = compact('controller', 'repository', 'index', 'edit', 'show');

        return $templates;
    }

    protected function getDefaultControls($fields)
    {
        $controls = [];
        foreach ($fields as $name => $type) {
            if ($name == 'id' || $type == 'datetime') {
                $controls[$name] = 'none';
            } else {
                $controls[$name] = 'text';
            }
        }
        return $controls;
    }

    protected function getDefaultSearchFields($fields)
    {
        $searchFields = [];
        foreach ($fields as $name => $type) {
            if ($type == 'datetime') {
                $searchFields[$name] = 'none';
            } elseif ($type == 'integer') {
                $searchFields[$name] = 'exact';
            } else {
                $searchFields[$name] = 'like';
            }
        }
        return $searchFields;
    }

    protected function getDefaultListFields($fields)
    {
        $listFields = [];
        foreach ($fields as $name => $type) {
            if ($type == 'datetime') {
                $listFields[$name] = 'no_filter';
            } elseif ($type == 'integer') {
                $listFields[$name] = 'text_filter';
            } else {
                $listFields[$name] = 'text_filter';
            }
        }
        return $listFields;
    }

}

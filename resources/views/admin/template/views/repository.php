<?php

    $orderFields = [];
    foreach ($listFields as $name => $type) {
        if ($type !== 'none') {
            $orderFields[] = $name;
        }
    }

?>
&lt;?php

namespace App\Repositories;

use <?= $modelFullName ?>;

class <?= $modelName ?>Repository
{
    public function paginate($search, $order, $pageSize, $page)
    {
        $query = <?= $modelName ?>::query();

<?php foreach ($fields as $name => $type): ?>
<?php if ($searchFields[$name] == 'exact'): ?>
        if (!empty($search['<?= $name ?>'])) {
            $query->where('<?= $name ?>', '=', $search['<?= $name ?>']);
        }
<?php elseif ($searchFields[$name] == 'like'): ?>
        if (!empty($search['<?= $name ?>'])) {
            $query->where('<?= $name ?>', 'like', prepare_like($search['<?= $name ?>']));
        }
<?php elseif ($searchFields[$name] == 'boolean'): ?>
        if (isset($search['<?= $name ?>'])) {
            $query->where('<?= $name ?>', '=', $search['<?= $name ?>'] ? '1' : '0');
        }
<?php endif ?>
<?php endforeach ?>

        $order = array_only($order, ['<?= implode("', '", $orderFields) ?>']);
        if (!empty($order)) {
            $query->orderBy(key($order), current($order));
        }

        $result = $query->paginate($pageSize, ['*'], 'page', $page);
        if ($page > $result->lastPage()) {
            $result = $query->paginate($pageSize, ['*'], 'page', $result->lastPage());
        }
        return $result;
    }
}
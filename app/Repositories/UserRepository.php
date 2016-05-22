<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function paginate($search, $order, $pageSize, $page)
    {
        $query = User::query();

        if (!empty($search['id'])) {
            $query->where('id', '=', $search['id']);
        }
        if (!empty($search['name'])) {
            $query->where('name', 'like', prepare_like($search['name']));
        }
        if (!empty($search['email'])) {
            $query->where('email', 'like', prepare_like($search['email']));
        }

        $order = array_only($order, ['id', 'name', 'email', 'created_at', 'updated_at']);
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
<?php

namespace App\Repositories;

use App\Admin;

class AdminRepository
{
    public function paginate($search, $order, $pageSize, $page)
    {
        $query = Admin::query();

        if (!empty($search['id'])) {
            $query->where('id', '=', $search['id']);
        }

        if (!empty($search['name'])) {
            $query->where('name', 'like', prepare_like($search['name']));
        }

        if (!empty($search['email'])) {
            $query->where('email', 'like', prepare_like($search['email']));
        }

        if (!empty($search['role'])) {
            $query->where('role', '=', $search['role']);
        }

        $order = array_only($order, ['id', 'name', 'email', 'role', 'created_at', 'updated_at', 'last_login']);
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
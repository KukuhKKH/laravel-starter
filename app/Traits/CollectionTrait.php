<?php
namespace App\Traits;

trait CollectionTrait {
    public function pagination($model, $where, $search, $sort, $sortBy) {
        $model->when($search, function($query) use ($where, $search) {
            $query->where(function($sub) use ($where, $search) {
                foreach ($where as $value) {
                    $sub->orWhere($value, "LIKE", "%" . $search . "%");
                }
            });
        });

        $model->when((($sort != '') && ($sortBy != '')), function($query) use($sort, $sortBy) {
            $query->orderBy($sort, $sortBy);
        });

        return $model;
    }
}

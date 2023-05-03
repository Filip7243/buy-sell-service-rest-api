<?php

namespace App\Services\V1;

use Illuminate\Http\Request;


class CategoryQuery
{

    protected array $params = [
        'name' => ['eq']
    ];

    protected array $columns = [
        'name' => 'name'
    ];

    protected array $operators = [
        'eq' => '='
    ];


    public function transform(Request $request)
    {
        $query = [];

        foreach ($this->params as $param => $ops) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columns[$param] ?? $param;

            foreach ($ops as $op) {
                if (isset($query[$op])) {
                    $query[] = [$column, $this->operators[$op], $query[$op]];
                }
            }
        }

        return $query;
    }
}

<?php

namespace App\Services\V1;

use Illuminate\Http\Request;


class ProductQuery
{
    protected array $safeParms = [
        'name' => ['eq'],
        'description' => ['eq'],
        'price' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'product_condition' => ['eq'],
        'type' => ['eq'],
        'category_id' => ['eq']
    ];

    protected array $columnMap = [
        'name' => 'name',
        'description' => 'description',
        'price' => 'price',
        'product_condition' => 'product_condition',
        'type' => 'type',
        'category_id' => 'category_id',
    ];

    protected array $operatorMap = [
        'eq' => '=',
        'gt' => '=',
        'lt' => '=',
        'gte' => '=',
        'lte' => '=',
    ];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}

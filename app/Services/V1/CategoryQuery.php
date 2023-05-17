<?php

namespace App\Services\V1;

use Illuminate\Http\Request;


class CategoryQuery
{

    protected array $safeParms = [
        'name' => ['eq']
    ];

    protected array $columnMap = [
        'name' => 'name'
    ];

    protected array $operatorMap = [
        'eq' => '='
    ];


//    public function transform(Request $request)
//    {
//        //TODO: handle it ASAP!
//        $query = [];
//
//        foreach ($this->safeParms as $parm => $operators) {
//            $query = $request->query($parm);
//
//            if (!isset($query)) {
//                continue;
//            }
//
//            $column = $this->columnMap[$parm] ?? $parm;
//
//            foreach ($operators as $operator) {
//                if (isset($query[$operator])) {
//                    $query[] = [$column, $this->operatorMap[$operator], $query[$operator]];
//                }
//            }
//        }
//
//        return $query;
//    }

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

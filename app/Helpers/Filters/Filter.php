<?php

namespace App\Http\Helpers\Filters;

use Illuminate\Http\Request;
abstract class Filter
{
    protected $builder;
    protected $request;
    public $per_page = 10;
    public $sort;

    public function __construct(Request $request)
    {
        $this->request = $request->all();
        $this->sort = $request->sort;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->request as $filter => $value) {

            if(method_exists($this, $filter) && $value != null){
                $this->$filter($value);
            }
        }


        return $this->builder;
    }

    public function per_page($value)
    {
        $this->per_page = (int) $value;
    }



}
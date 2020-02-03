<?php

namespace App\Http\Helpers\Filters;

use Carbon\Carbon;

class TransactionFilter extends Filter
{

    public function from_date($query)
    {
        $date = Carbon::now()->subYear($query) ;
        $this->builder->where('updated_at', '<=' , $date);
    }

    public function status($query)
    {
        $this->builder->whereStatus($query);
    }

    public function search($query)
    {
        $this->builder->where('number', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%');
    }



}


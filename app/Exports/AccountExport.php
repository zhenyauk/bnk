<?php

namespace App\Exports;

use App\Account;
use Maatwebsite\Excel\Concerns\FromCollection;

class AccountExport implements FromCollection
{
    protected $user_id;
    protected $type = null;

    public function __construct($user_id, $type = null)
    {
        $this->type = $type;
        $this->user_id = $user_id;
    }

    public function collection()
    {
        if($this->type !== null)
            return Account::whereUserId($this->user_id)->whereType($this->type)->get(['number', 'iban', 'balance_current']);

        return Account::whereUserId($this->user_id)->get(['number', 'iban', 'balance_current']);
    }
}

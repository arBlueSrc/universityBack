<?php

namespace App\MyClass;
use Maatwebsite\Excel\Concerns\FromCollection;


class InvoicesExport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}

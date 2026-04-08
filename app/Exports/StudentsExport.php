<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements WithHeadings, FromQuery
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Age', 'Image', 'Created At', 'Updated At'];
    }

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Student::query()
            ->select('id', 'name', 'email', 'age', 'image', 'created_at', 'updated_at')
            ->where('user_id', Auth::id())
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
                });
            });
    }
}
    
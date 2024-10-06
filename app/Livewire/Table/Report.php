<?php

namespace App\Livewire\Table;

use App\Models\Report as ModelsReport;
use Livewire\Component;

class Report extends Component
{   
    public $search = '';
    protected $queryString = ['search' => ['except' => '']];
    public function render()
    {
        $query = ModelsReport::with('user');

        if (!empty($this->search)) {
            $query->where('category', 'like', '%' . $this->search . '%')
            ->orWhere('message', 'like', '%' . $this->search . '%')
            ->orWhereHas('user', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        }

        $report = $query->latest()->paginate(15);
        return view('livewire.table.report',compact('report'));
    }
}

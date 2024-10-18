<?php

namespace App\Livewire\Table;

use App\Models\Report as ModelsReport;
use Livewire\Component;
use Livewire\WithPagination;

class Report extends Component
{   
    use WithPagination;

    public $search = '';
    public $reply;

    protected $queryString = ['search'=> ['except' => '']];
    
    public function deleteReport($id)
    {
        try {
            $post = ModelsReport::findOrFail($id);
            $post->delete();
    
            notify()->info('message', 'Report deleted successfully!');
        } catch (\Exception $e) {
            notify()->info('error', 'Failed to delete the Report. Please try again.');
        }
        return redirect()->route('admin-report');
    }

    public function makeIsRead($id)
    {
        $report = ModelsReport::find($id);
        $report->is_read = true; // Tandai sebagai dibaca
        $report->save();
        redirect()->route('admin-report');
    }

    public function sendReply($reportId)
    {
        $this->validate([
            'reply' => 'required|string',
        ]);

        $report = ModelsReport::find($reportId);
        $report->admin_response = $this->reply;
        $report->is_read_user = true; // Tandai sebagai dibaca
        $report->save();

        $this->reply = '';
        notify()->info('message', 'Reply sent successfully.');
        redirect()->route('admin-report');
    }


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

<?php

namespace App\Livewire\Pages;

use App\Models\Report;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UserReport extends Component
{   
    use WithPagination;

    public function deleteReport($id)
    {
        try {
            $post = Report::findOrFail($id);
            $post->delete();
    
            notify()->info('message', 'Report deleted successfully!');
        } catch (\Exception $e) {
            notify()->info('error', 'Failed to delete the Report. Please try again.');
        }
        return redirect()->route('report');
    }

    public function makeIsRead($id)
    {
        $report = Report::find($id);
        $report->is_read_user = false; // Tandai sebagai dibaca
        $report->save();
        redirect()->route('report');
    }
    
    public function render()
    {   
        $reports = Report::with('user')->where('user_id', Auth::id())->latest()->paginate(15);
        return view('livewire.pages.user-report',compact('reports'));
    }
}

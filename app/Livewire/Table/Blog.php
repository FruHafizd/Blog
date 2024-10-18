<?php

namespace App\Livewire\Table;

use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;


class Blog extends Component
{   
    use WithPagination;

    public $search = '';
    protected $queryString = ['search'=> ['except' => '']];

    public function destroy(Request $request, $id)
    {   
        try {
            $post = Posts::findOrFail($id);

            $request->validate([
                'blog_slug' => 'required|string|in:' . $post->slug,
            ]);

            $post->delete();
    
            notify()->info('message', 'Blog deleted successfully!');
        } catch (\Exception $e) {
            notify()->info('error', 'Failed to delete the Blog. Please try again.');
        }
        return redirect()->route('your-blog'); 
    }

    public function render()
    {   
        /**
         * Auth::id() akan mendapatkan id dari pengguna yang sedang login.
         * Query where('user_id', Auth::id()) akan mengambil semua post yang user_id-nya sesuai dengan id pengguna tersebut.
         */
        // $query = Posts::with('categories','user')->where('user_id', Auth::id())->paginate(10);
        $query = Posts::with('categories','user')->where('user_id', Auth::id());

         // Jika ada pencarian, filter berdasarkan title, user name, dan content
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('categories', function($query) {
                        $query->where('title', 'like', '%' . $this->search . '%');
                    });
            });
        }
        $posts = $query->latest()->paginate(15);
        return view('livewire.table.blog', compact('posts'));
    }
}

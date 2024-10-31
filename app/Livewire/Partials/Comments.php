<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\Comment;

class Comments extends Component
{   
    public $newComment;
    public $comments;
    public $post;
    public $replyingTo = null;
    public $replyComment = '';
    
    /**
     * $replyingTo: Menyimpan ID komentar yang sedang dibalas (jika ada).
     * $replyComment: Menyimpan teks komentar balasan.
     */

    protected $rules = [
        'newComment' => 'required|min:2'
    ];

    public function mount($post)
    {
        $this->post = $post; // Pastikan post yang dikirim ke komponen
        $this->loadComments();
    }

    public function loadComments()
    {
        // Ambil komentar hanya berdasarkan post_id yang terkait
        $this->comments = Comment::with('user')
            ->where('post_id', $this->post->id)
            ->whereNull('parent_id') //Hanya mengambil komentar utama (parent_id null) beserta balasannya.
            ->with(['user', 'replies.user'])
            ->latest()
            ->get();
    }

    public function addComment()
    {
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect jika user belum login
        }

        $this->validate();

        Comment::create([
            'body' => $this->newComment,
            'user_id' => auth()->id(),
            'post_id' => $this->post->id 
        ]);

        $this->newComment = '';
        $this->loadComments();

        notify()->info('message', 'Comment added successfully!');
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);

        if ($comment && ($comment->user_id === auth()->id() || auth()->user()->hasRole('Admin') )) {
            $comment->delete();
            $this->loadComments();

            // session()->flash('message', 'Comment deleted successfully!');
            notify()->info('Comment Updated Successfully');
        }
    }

    public function addReply($commentId)
    {   
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect jika user belum login
        }
        
        $this->validate(['replyComment' => 'required|min:2']);
        
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
            'parent_id' => $commentId,
            'body' => $this->replyComment,
        ]);
        
        $this->replyComment = '';
        $this->replyingTo = null;
        notify()->info('message', 'Comment added successfully!');
    }

    public function render()
    {
        return view('livewire.partials.comments');
    }
}

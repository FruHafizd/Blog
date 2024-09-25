<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\Comment;

class Comments extends Component
{   
    public $newComment;
    public $comments;
    public $post;

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
            'post_id' => $this->post->id  // Pastikan $post->id dikirim dengan benar
        ]);

        $this->newComment = '';
        $this->loadComments();

        session()->flash('message', 'Comment added successfully!');
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);

        if ($comment && $comment->user_id === auth()->id()) {
            $comment->delete();
            $this->loadComments();

            session()->flash('message', 'Comment deleted successfully!');
        }
    }

    public function render()
    {
        return view('livewire.partials.comments');
    }
}

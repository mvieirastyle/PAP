<?php
use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

new class extends Component
{
    public Post $post;
    public array $comment = [];
    public ?int $replyingTo = null;

    public function mount($post){
        $this->post = $post;
        
    }

    public function sendComment(string $key, int $commentId = 0){

        if (!empty($this->comment[$key])) {
            $data = [
            'user_id' => Auth::id(),
            'post_id' => $this->post->id,
            'reply_id' => $commentId ? $commentId : null,
            'content' => $this->comment[$key],
        ];

            Comment::createComment($data);
            $this->comment[$key] = '';
        }   

    }

    public function toggleReply(int $commentId)
{
    if(!Auth::check()){
        return;
    }

    $this->replyingTo = $this->replyingTo === $commentId ? null : $commentId;
}

public function deleteComment(int $commentId)
{
    $comment = Comment::find($commentId);

    if ($comment && $comment->user_id === auth()->id()) {
        $this->deleteReplies($comment);
    }
}


public function deleteReplies(Comment $comment)
{
    foreach ($comment->replies as $reply) {
        $this->deleteReplies($reply);
    }
    $comment->delete();
}

};
?>

<div class="mt-5">

    <h4 class="mb-4 fw-bold">{{__('blog.post.comments')}}</h4>

    @auth
    <div class="forum-comment-box mb-4 p-3">
        <div class="d-flex align-items-start">
            <img src="{{ auth()->user()->fotos->first()?->path 
                            ? asset('storage/'.auth()->user()->fotos->first()->path) 
                            : asset('/images/profilePicture.png') }}" class="forum-avatar me-3" />
            
            <div class="flex-grow-1">
                <textarea wire:model="comment.post" rows="3" class="form-control forum-textarea mb-2"
                    placeholder="{{__('blog.post.write_comment')}}" required></textarea>
                    
                <div class="text-end">
                    <button wire:click="sendComment('post')" class="btn btn-success btn-sm px-4">{{__('blog.post.comment')}}</button>
                </div>

            </div>

        </div>
    </div>
    @else 
    <div class="alert alert-warning"> {!! __('blog.post.can_comment') !!} 
    </div>
    @endauth

    @forelse($post->comments->whereNull('reply_id') as $comment)

    @include('components.partials.comment', ['comment' => $comment])

    @empty
    <p class="text-muted">{{__('blog.post.no_comments')}}</p>
    @endforelse

</div>
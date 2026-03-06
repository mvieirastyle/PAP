<div class="forum-comment mb-3 p-2" wire:key="comment-{{ $comment->id }}">

    <div class="dropdown text-end">
        <a @if(Auth::id()===$comment->user_id)
            href="#" data-bs-toggle="dropdown"
            @endif
            class="{{ Auth::id() !== $comment->user_id ? 'text-muted' : '' }}"
            style="{{ Auth::id() !== $comment->user_id ? 'pointer-events: none; opacity: 0.5;' : '' }}"
            >
            <i class="fa-solid fa-ellipsis" style="color: green"></i>
        </a>

        @if(Auth::id() === $comment->user_id)
        <ul class="dropdown-menu">
            <li>
                <button wire:click="deleteComment({{ $comment->id }})" wire:confirm="{{ __('blog.post.confirmed_delete') }}" 
                    class="dropdown-item text-danger">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </li>
        </ul>
        @endif
    </div>

    <div class="d-flex align-items-start">

        <img src="{{ $comment->user->fotos->first()?->path 
                    ? asset('storage/'.$comment->user->fotos->first()->path) 
                    : asset('/images/profilePicture.png') }}" class="forum-avatar me-3" />

        <div class="flex-grow-1">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="fw-semibold text-dark">{{ '@'.$comment->user->name }}</span>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
            </div>

            <div class="forum-content mb-2">
                {!! $comment->content !!}
            </div>

            <button wire:click="toggleReply({{ $comment->id }})" type="button"
                class="btn btn-sm btn-outline-secondary mb-2 @guest opacity-50 cursor-not-allowed @endguest" @guest
                disabled title="Você precisa estar logado para responder" @endguest>
                Reply
            </button>

            @if ($replyingTo === $comment->id)
            <div class="mt-2">
                <textarea wire:model="comment.reply{{ $comment->id }}" rows="3" class="form-control forum-textarea mb-2"
                    placeholder="{{__('blog.post.reply_comment')}}"></textarea>
                <div class="text-end">
                    <button wire:click="sendComment('reply{{ $comment->id }}', {{ $comment->id }})"
                        class="btn btn-success btn-sm">{{__('common.send')}}</button>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if($comment->replies->count())
    <div class="comment-children ms-4 mt-2">
        @foreach($comment->replies as $reply)
        @include('components.partials.comment', ['comment' => $reply])
        @endforeach
    </div>
    @endif

</div>
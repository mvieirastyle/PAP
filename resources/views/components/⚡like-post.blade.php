<?php

use App\Models\Post;
use App\Models\Like;
use Livewire\Component;

new class extends Component
{
    public Post $post;

    public function mount($post){
        $this->post = $post;   
    }

    public function addLikes(){
        
        $data = [
            'user_id' => Auth::id(),
            'post_id' => $this->post->id,
        ];
        
        Like::add($data, $this->post);
    }

};
?>

<div>
    <button wire:click="addLikes" type="button"
        class="btn btn-sm {{ $post->isLikedByUser() ? 'btn-success' : '' }}">

        <i class="fas fa-thumbs-up"></i>
        {{ $post->likes->count() }}
    </button>
</div>
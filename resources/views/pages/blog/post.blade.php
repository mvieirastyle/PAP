@extends('layouts.default')

@section('content')

<div class="center-page">
    <div class="row justify-content-center w-100">
        <div class="col-lg-8 py-3">
            <h1 class="container text-center py-5">{{ $post->title }}</h1>

            <div class="me-2" width="50px" height="50px" id="content-quill">
                {!! $post->content !!}
            </div>

            <div class="text-end">
                @if(Auth::check())
                @if(Auth::user()->id === $post->user_id)

                <a href="/blog/edit/{{ $post->id }}" class="btn btn-sm" title="Editar">
                    <i class="fas fa-edit"></i> {{__('blog.post.edit_post')}}
                </a>

                <form action="/delete/{{ $post->id }}" method="POST" class="d-inline"
                    onsubmit="return confirm('{{__('blog.post.confirmed_delete')}}');">
                    @csrf
                    <button type="submit" class="btn btn-sm" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                @endif
            </div>
            @endif

            <div class="d-flex align-items-start">
                <livewire:like-post :post="$post" />
                <li class="btn btn-sm">
                    <a href="#" class="nav-link px-2 dropdown" id="shareDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-share-nodes"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>{!! $shareLinks !!}</li>
                    </ul>
                </li>
            </div>

            <livewire:comment-post :post="$post" />

        </div>
    </div>

    <div class="modal fade" id="modalImgageView" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body text-center position-relative">
                    <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        style="position:absolute; top:5px; right:5px;"></button>

                    <img src="" alt="Imagem" class="img-fluid" id="modalImgageViewIMG">
                </div>
            </div>
        </div>
    </div>

</div>
<script>

    document.getElementById('content-quill').addEventListener('click', function (e) {
    const target = e.target;
    if (target.tagName === 'IMG') {
        const url = target.getAttribute('src');
        document.getElementById('modalImgageViewIMG').setAttribute('src', url);
        const modal = new bootstrap.Modal(document.getElementById('modalImgageView'));
        modal.show();
    }
});

</script>
@endsection
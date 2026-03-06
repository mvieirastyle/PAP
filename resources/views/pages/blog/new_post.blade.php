@extends('layouts.default')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <x-heroicon-o-pencil-square style="width:20px; height:20px;" />
                        {{__('blog.new_post.new_post')}}
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="/blog/new_post/{{ Auth::user()->id }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">{{__('blog.new_post.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="{{__('blog.new_post.your_title')}}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{__('blog.new_post.description')}}</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="{{__('blog.new_post.brief_description')}}"></textarea>
                        </div>

                        <label for="content" class="form-label">{{__('blog.new_post.content')}}</label>
                        <div id="toolbar-container">
                            <span class="ql-formats">
                                <select class="ql-font"></select>
                                <select class="ql-size"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-color"></select>
                                <select class="ql-background"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-direction" value="rtl"></button>
                                <select class="ql-align"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-video"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="editor"></div>
                        <input type="hidden" name="content" id="content">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="/blog/new_post" class="btn btn-secondary me-md-2">{{__('common.cancel')}}</a>
                            <button type="submit" class="btn btn-success">{{__('common.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    // Tornar quill global
    window.quill = new Quill('#editor', {
        modules: {
    toolbar: {
        container: '#toolbar-container',
        handlers: {
            image: function () {
                selectLocalImage();
            }
        }
    }
},
        placeholder: '{{__('blog.new_post.subject')}}',
        theme: 'snow',
    });

    const form = document.querySelector('form');
    const contentInput = document.querySelector('#content');

    form.addEventListener('submit', function () {
        contentInput.value = window.quill.root.innerHTML;
        
    });
});


// pegar imagem
function selectLocalImage() {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();

    input.onchange = () => {
        const file = input.files[0];
        if (file) {
            uploadImage(file);
        }
    };
}


// upload imagem
function uploadImage(file) {
    const formData = new FormData();
    formData.append('image', file);

    fetch("{{ route('livewire.upload-image') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        const range = window.quill.getSelection();
        window.quill.insertEmbed(range.index, 'image', result.url);
        const [leaf] = window.quill.getLeaf(range.index);
        const img = leaf.domNode;

        img.classList.add('blog-image');
    })
    .catch(error => console.error(error));
}
</script>
@endsection
@extends('layouts.master')
@section('menu')
    @extends('sidebar.dashboard')
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <img src="https://placehold.co/400x400" alt=""
                                style="max-width: 50px; border-radius: 50px">
                            <h5 class="p-0 m-0">{{ Auth::user()->nama_user }}</h5>
                        </div>
                        <a href="{{ route('postings.index') }}" class="">Cancel</a>
                    </div>
                </div>
                <div class="content mt-3">
                    <form action="{{ route('postings.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="file mt-5">
                            <p class="mb-3" style="font-weight: bold;">Upload Foto (optional)</p>
                            <input type="file" class="form-control" name="message_gambar">
                        </div>
                        <div class="form-group mt-3">
                            <label for="" class="mb-3">Your Comments</label>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <textarea name="message_text" id="message_text" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary w-100">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .drag-area {
        border: 2px dashed #dbdbdb;
        border-radius: 5px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
    }

    .drag-area.active {
        background-color: #f8f9fa;
    }

    .drag-area img {
        max-width: 100px;
        margin-top: 10px;
    }
</style>

<script>
    const dragArea = document.getElementById('drag-area');
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*';
    let filePreview = document.getElementById('file-preview');

    // Click to upload
    dragArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Drag over effect
    dragArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dragArea.classList.add('active');
    });

    // Drag leave effect
    dragArea.addEventListener('dragleave', () => {
        dragArea.classList.remove('active');
    });

    // Drop the file
    dragArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dragArea.classList.remove('active');
        const file = event.dataTransfer.files[0];
        showFilePreview(file);
    });

    // Handle file input selection
    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        showFilePreview(file);
    });

    function showFilePreview(file) {
        if (file) {
            const fileReader = new FileReader();
            fileReader.onload = function(e) {
                filePreview.src = e.target.result;
                filePreview.style.display = 'block';
            };
            fileReader.readAsDataURL(file);
        }
    }
</script>
@endsection

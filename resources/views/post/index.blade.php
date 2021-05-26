@extends('layouts.backend')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <div class="justify-content-start">
            <span>
                <h1>My Posts</h1>
            </span>
        </div>
        <div class="justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addPostModal">Add new
                Post</button>
        </div>
    </div>

    <div class="row">
        <div class="card-deck">
            @forelse($posts as $post)
                <div class="col-xl-3">
                    <div class="card">
                        <img class="card-img-top" src="https://source.unsplash.com/user/erondu/150x100"
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title ">{{ $post->title }} </h5>
                            <p class="card-text">
                                {{ Str::limit($post->content, 20, '...') }}
                            </p>
                            <p class="card-text">
                            <div class="d-flex justify-content-between">
                                <div class="justify-content-start">
                                    <small lass="text-muted">
                                        Last updated {{ $post->updated_at->ago() }}
                                    </small>
                                </div>
                                <div class="justify-content-end">
                                    <a href="#" onclick="fillData('{{ $post->id }}')" data-toggle="modal"
                                        data-target="#editPostModal"><i class="fas fa-pen"></i></a>
                                    <a href="#" onclick="confirmDelete('{{ $post->id }}')"><i
                                            class="text-danger fas fa-trash ml-1"></i></a>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    <h4>No posts</h4>
                </div>
            @endforelse
        </div>
    </div>
    <form action="{{ route('posts.destroy') }}" method="POST" id="deleteForm">
        @csrf
        <input type="hidden" name="id" id="deletedID">
        @method('delete')
    </form>

    <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('posts.update', 0) }}" method="POST" id="updateForm">
                        @csrf
                        @method('put')
                        <label for="title">Title</label>
                        <input type="text" required class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" name="title" id="title">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <label for="content">Content</label>
                        <textarea name="content" required class="form-control @error('content') is-invalid @enderror"
                            id="content" rows="5">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="updateForm">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('posts.store') }}" method="POST" id="addForm">
                        @csrf
                        <label for="title">Title</label>
                        <input type="text" required class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" name="title" id="title">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <label for="content">Content</label>
                        <textarea name="content" required class="form-control @error('content') is-invalid @enderror"
                            id="content" rows="5">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addPost()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

@section('script')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deletedID').value = id;
                document.getElementById('deleteForm').submit();
            }
        })
    }

    function fillData(id) {
        // get post data by id 
        $.get("{{ url('posts/show') }}/" + id, function(data) {
            document.getElementById('title').value = data.title;
            document.getElementById('content').value = data.content;
            document.getElementById('updateForm').action = '/posts/update/' + data.id;

        });
        // fill modal by input ID from this post
    }

    function addPost() {

        var res = document.getElementById('addForm').submit();
        console.log(res);
    }

</script>
@endsection

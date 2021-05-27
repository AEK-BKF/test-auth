@extends('layouts.backend')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <div class="justify-content-start">
            <span>
                <h1>My Categories</h1>
            </span>
        </div>
        <div class="justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCategModal">Add new
                Category</button>
        </div>
    </div>

    <div class="row">
        @forelse($categories as $categ)
            <div class="col-xl-2">
                <h3 class="card-title ">{{ $categ->name }} </h3>
                <div class="d-flex">
                    <div class="justify-content-end">
                        <a href="#" onclick="fillData('{{ $categ->id }}')" data-toggle="modal"
                            data-target="#editCategModal"><i class="fas fa-pen"></i></a>
                        <a href="#" onclick="confirmDelete('{{ $categ->id }}')"><i
                                class="text-danger fas fa-trash ml-1"></i></a>
                    </div>
                </div>
            </div>
        @empty
            <div>
                <h4>No Categories</h4>
            </div>
        @endforelse
    </div>
    <form action="{{ route('categories.destroy', 0) }}" method="POST" id="deleteForm">
        @csrf
        <input type="hidden" name="id" id="deletedID">
        @method('delete')
    </form>

    <div class="modal fade" id="editCategModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <label for="name">Name</label>
                        <input type="text" required class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" name="name" id="name">
                        @error('name')
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

    <div class="modal fade" id="addCategModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form action="{{ route('categories.store') }}" method="POST" id="addForm">
                        @csrf
                        <label for="name">Name</label>
                        <input type="text" required class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" name="name" id="name">
                        @error('name')
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
        $.get("{{ url('categories/getData') }}/" + id, function(data) {
            document.getElementById('name').value = data.name;
            document.getElementById('updateForm').action = '/categories/' + data.id;

        });
        // fill modal by input ID from this post
    }

    function addPost() {

        var res = document.getElementById('addForm').submit();
        console.log(res);
    }

</script>
@endsection

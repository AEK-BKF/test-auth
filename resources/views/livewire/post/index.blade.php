<div>
    <div class="row">
        <div class="card-deck">
            @forelse($posts as $post)
                <div class="col-xl-3">
                    <div class="card">
                        <div class="text-center">
                            <img class="" width="200" height="200"
                                src="{{ $post->image ? '/storage/images/' . $post->image : asset('images/default.png') }} "
                                alt="post image">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title ">
                                {{ $post->title }}
                                <span
                                    class="badge badge-primary">{{ $post->category ? $post->category->name : 'NA' }}</span>
                            </h5>
                            <p class="card-text">
                                {{ $post->content }}
                            </p>
                            <p class="card-text">
                            <div class="d-flex justify-content-between">
                                <div class="justify-content-start">
                                    <small lass="text-muted">
                                        Joined {{ $post->created_at->ago() }}
                                    </small>
                                </div>
                                <div class="justify-content-end">
                                    <a class="mr-2" href="#" onclick="fillData('{{ $post->id }}')"
                                        data-toggle="modal" data-target="#editPostModal"><i class="fas fa-pen"></i></a>
                                    <a class="mr-2" href="#" onclick="confirmDelete('{{ $post->id }}')"><i
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
</div>

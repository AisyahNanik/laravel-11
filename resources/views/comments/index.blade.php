<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Comments - CommentBerita.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Berikan comment untuk berita ini</h3>
                    <h5 class="text-center"><a href="https://CommentBerita.com">www.CommentBerita.com</a></h5>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('comments.create') }}" class="btn btn-md btn-success mb-3">ADD COMMENT</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Photo</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">PHONE</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $comment)
                                    <tr>
                                        <h1>Comment for Post: {{ $post->title }}</h1>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/comments/'.$comment->photo) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ $comment->name }}</td>
                                        <td>{{ $comment->email }}</td>
                                        <td>{{ $comment->phone }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Are you sure? ?');" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Comment Is Not Found.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "DONE!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "FAIL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

</body>
</html>
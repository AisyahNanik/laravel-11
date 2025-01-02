<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Reporter - ReporterBerita.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Data Reporter</h3>
                    <h5 class="text-center"><a href="https://ReporterBerita.com">www.ReporterBerita.com</a></h5>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('reporters.create') }}" class="btn btn-md btn-success mb-3">ADD REPORTER</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">PHONE</th>
                                    <th scope="col">AGE</th>
                                    <th scope="col">PHOTO</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reporters as $reporter)
                                    <tr>
                                        <td>{{ $reporter->name }}</td>
                                        <td>{{ $reporter->email }}</td>
                                        <td>{{ $reporter->phone }}</td>
                                        <td>{{ $reporter->age }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/reporters/'.$reporter->photo) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('reporters.destroy', $reporter->id) }}" method="POST">
                                                <a href="{{ route('reporters.show', $reporter->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('reporters.edit', $reporter->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Reporter Belum Ada.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $reporters->links() }}
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
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

</body>
</html>
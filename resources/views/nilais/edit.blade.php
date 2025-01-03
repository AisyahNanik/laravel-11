<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Nilai - NilaiSiswa.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('nilais.update', $nilai->id) }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Bahasa Indonesia</label>
                                <input type="number" class="form-control @error('basdon') is-invalid @enderror" name="basdon" value="{{ old('basdon', $nilai->basdon) }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk basdon -->
                                @error('basdon')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Bahasa Inggris</label>
                                <input type="number" class="form-control @error('basing') is-invalid @enderror" name="basing" value="{{ old('basing', $nilai->basing) }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk basing -->
                                @error('basing')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Matematika</label>
                                <input type="number" class="form-control @error('matematika') is-invalid @enderror" name="matematika" value="{{ old('matematika', $nilai->matematika) }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk matematika -->
                                @error('matematika')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">IPA</label>
                                <input type="number" class="form-control @error('ipa') is-invalid @enderror" name="ipa" value="{{ old('ipa', $nilai->ipa) }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk ipa -->
                                @error('ipa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">IPS</label>
                                <input type="number" class="form-control @error('ips') is-invalid @enderror" name="ips" value="{{ old('ips', $nilai->ips) }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk ips -->
                                @error('ips')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Upload Image</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="http://localhost/supportletstalk/public_html/manage/api/listner/29128/update-image" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="registration" class="form-label">Registration Number</label>
                <input type="text" class="form-control" id="registration" name="registration" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Choose Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload with Points</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }
        .point {
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            position: absolute;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Upload Image with Points</div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <form action="" method="POST" enctype="multipart/form-data" id="upload-form">
                @csrf
                <div class="form-group">
                    <input type="file" name="image" class="form-control" required>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" name="points" id="points-input">
                <button type="submit" class="btn btn-success">Upload</button>
            </form>

            <div class="mt-3">
                <img id="uploaded-image" src="#" alt="Uploaded Image" style="max-width: 100%; display: none;">
                <div class="image-container" id="image-container" style="display: none;">
                    <img src="#" alt="Image for Points" id="image-for-points" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    document.querySelector('input[name="image"]').addEventListener('change', function(event) {
        const image = document.getElementById('uploaded-image');
        const imageContainer = document.getElementById('image-container');
        const imageForPoints = document.getElementById('image-for-points');
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
            image.style.display = 'block';
            imageContainer.style.display = 'block';
            imageForPoints.src = e.target.result;
        }
        reader.readAsDataURL(file);
    });

    document.getElementById('image-for-points').addEventListener('click', function(event) {
        const rect = event.target.getBoundingClientRect();
        console.log('hello')
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        const point = document.createElement('div');
        point.classList.add('point');
        point.style.left = `${x}px`;
        point.style.top = `${y}px`;
        event.target.parentElement.appendChild(point);
        const pointsInput = document.getElementById('points-input');
        const points = pointsInput.value ? JSON.parse(pointsInput.value) : [];
        points.push({x, y});
        pointsInput.value = JSON.stringify(points);
    });
</script>
</body>
</html>

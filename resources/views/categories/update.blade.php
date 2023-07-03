<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Category</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Category</h1>
        <form id="ajaxForm">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" id="" name="name" placeholder="Name"
                    value="{{ $edit_cate->name }}">
                    <span id="nameError" class="text-danger" error-messages></span>
            </div>
            <button type="button" class="btn btn-primary" id="saveBtn">Update</button>
            <a href="{{ url('list-category') }}" class="btn btn-success">List Product</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#saveBtn').click(function() {
                var formData = new FormData($('#ajaxForm')[0]);
                $.ajax({
                    url: '/update-category/{{ $edit_cate->id }}',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Successfully',
                                text: response.success,
                                icon: 'success',
                            }).then(() => {
                                // Khi bạn ấn OK, thì mới reload lại trang
                                window.location.reload();
                            });
                        }
                    },
                    error: function(error) {
                        if (error.responseJSON.errors.name) {
                                $('#nameError').html(error.responseJSON.errors.name);
                            } else {
                                $('#nameError').html('');
                            }
                    }
                });
            });
        });
    </script>
</body>

</html>

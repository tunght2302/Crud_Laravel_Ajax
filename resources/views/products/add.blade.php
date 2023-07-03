<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Add Product</h1>
        <form id="ajaxForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                <span id="nameError" class="text-danger" error-messages></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image">
                <span id="imageError" class="text-danger" error-messages></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                <span id="priceError" class="text-danger" error-messages></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-select form-select-sm" name="category" id="category"  aria-label=".form-select-sm example">
                    <option selected disabled>List Category</option>
                    @foreach ($category as $items)
                        <option  value="{{ $items->id }}">{{ $items->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity">
                <span id="quantityError" class="text-danger" error-messages></span>
            </div>

            <button type="button" class="btn btn-primary" id="saveBtn">Submit</button>
            <a href="{{ url('list-product') }}" class="btn btn-success">List Product</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#saveBtn').click(function() {

                $('.error-messages').html('');

                var formData = new FormData($('#ajaxForm')[0]);
                $.ajax({
                    url: '/add-product',
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
                                // Khi bạn ấn OK, thì cho các giá trị vừa nhập thành rỗng
                                $('#name').val('');
                                $('#price').val('');
                                $('#category').val('List Category');
                                $('#image').val('');
                                $('#quantity').val('');
                            });
                        }
                    },
                    error: function(error) {
                        if (error) {
                            console.log(error.responseJSON.errors);

                            if (error.responseJSON.errors.name) {
                                $('#nameError').html(error.responseJSON.errors.name);
                            } else {
                                $('#nameError').html('');
                            }

                            if (error.responseJSON.errors.price) {
                                $('#priceError').html(error.responseJSON.errors.price);
                            } else {
                                $('#priceError').html('');
                            }

                            if (error.responseJSON.errors.image) {
                                $('#imageError').html(error.responseJSON.errors.image);
                            } else {
                                $('#imageError').html('');
                            }

                            if (error.responseJSON.errors.quantity) {
                                $('#quantityError').html(error.responseJSON.errors.quantity);
                            } else {
                                $('#quantityError').html('');
                            }

                        }
                    }
                });
            });
        });
    </script>
</body>

</html>

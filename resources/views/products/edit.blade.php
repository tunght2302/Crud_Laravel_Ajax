<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container mt-5 mb-5">
        <h1>Edit Product</h1>
        <form id="ajaxForm">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" id="" name="name" placeholder="Name"
                    value="{{ $one_product->name }}">
                    <span id="nameError" class="text-danger" error-messages></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" class="form-control" id="" name="price" placeholder="Price"
                    value="{{ $one_product->price }}">
                    <span id="priceError" class="text-danger" error-messages></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Current Image</label>
                <img src="/upload/{{ $one_product->image }}"  style="height:auto;width: 100px;">
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" id="" name="image" placeholder="Price">
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-select form-select-sm" name="category" id="category"  aria-label=".form-select-sm example">

                    <option  value="{{ $category_name->id }}">{{ $category_name->category_name }}</option>

                    @foreach ($all_cate as $items)
                        <option value="{{ $items->id }}">{{ $items->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="text" class="form-control" id="" name="quantity" placeholder="Quantity"
                value="{{ $one_product->quantity }}">
                <span id="quantityError" class="text-danger" error-messages></span>
            </div>
            <button type="button" class="btn btn-primary" id="saveBtn">Update</button>
            <a href="{{ url('list-product') }}" class="btn btn-success ">List Product</a>
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
                    url: '/update/{{ $one_product->id }}',
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
                            })
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

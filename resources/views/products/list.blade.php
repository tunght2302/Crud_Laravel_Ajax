<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Product</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>List Product</h1>
        <table class="table table-striped">
            <a href="{{ url('/add-product') }}" class="btn btn-success">Add Product</a>
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th></th>
            </thead>
            @foreach ($list_products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price) }}VNĐ</td>
                    <td>
                        <img src="/upload/{{ $product->image }}" alt="" style="height:auto;width: 100px;">
                    </td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <a href="{{ url('/edit', $product->id) }}" class="btn btn-warning edit-btn"
                            data-id="{{ $product->id }}">
                            Edit
                        </a>
                        <button class="delete-btn btn btn-danger" data-id="{{ $product->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện click nút xóa
            $('.delete-btn').click(function() {
                var productId = $(this).data('id');

                // Hiển thị hộp thoại xác nhận
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure to delete this product",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Nếu xác nhận xoá, thực hiện Ajax request
                        $.ajax({
                            url: '/delete/' + productId,
                            type: 'DELETE',
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
                                alert('Error deleting item.');
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>

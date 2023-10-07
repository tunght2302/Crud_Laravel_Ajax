@extends('layouts/app')
@section('title')
    <h1>List Product</h1>
@endsection
@section('content')
    <table class="table table-striped">
        <a href="{{ url('/add-product') }}" class="btn btn-success">Add Product</a>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th></th>
        </thead>
        @foreach ($list_products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price) }}VNĐ</td>
                <td>
                    <img src="{{ $product->image }}" alt="" style="height:auto;width: 100px;">
                </td>
                <td>
                    <a href="{{ url('/edit', $product->id) }}" class="btn btn-warning edit-btn" data-id="{{ $product->id }}">
                        Edit
                    </a>
                </td>
                <td>
                    <form class="delete-form" action="{{ url('/delete-product', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                            <button type="submit" class="btn btn-danger" data-id="{{ $product->id }}">
                                DELETE
                            </button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
</div>
@section('ajax')
    <script>
        // Sử dụng hàm sendAjaxRequest để xác nhận và xoá phần tử
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var urlToDelete = form.attr('action');

            // Hiển thị hộp thoại xác nhận
            Swal.fire({
                title: 'Are you sure?',
                text: 'Are you sure to delete this item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu xác nhận xoá, thực hiện Ajax request bằng hàm sendAjaxRequest
                    sendAjaxRequest(urlToDelete, 'POST', {
                        _method: 'DELETE'
                    }, function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Successfully',
                                text: response.success,
                                icon: 'success',
                            }).then(() => {
                                // Xoá phần tử khỏi giao diện sau khi xoá thành công
                                form.closest('tr').remove();
                            });
                        }
                    }, function(error) {
                        alert('Error deleting item.');
                    });
                }
            });
        });
    </script>
@endsection
</body>

</html>

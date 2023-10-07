@extends('layouts/app')
@section('title')
    <h1>Add Product</h1>
@endsection
@section('content')
    <div id="errorDiv" class="alert alert-danger" style="display: none;"></div>
    <form id="ajaxForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class=" clearable form-control" name="name" id="name" placeholder="Name">
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class=" clearable form-control" name="image" id="image">
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class=" clearable form-control" name="price" id="price" placeholder="Price">
        </div>
        <button type="button" class="btn btn-primary" id="saveBtn">Submit</button>
        <a href="{{ url('list-product') }}" class="btn btn-success">List Product</a>
    </form>
    </div>
@endsection
@section('ajax')
    <script>
        $(function() {
            $('#saveBtn').on('click', function() {
                var formData = new FormData($('#ajaxForm')[0]);

                sendAjaxRequest('/add-product','POST', formData,
                    function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Successfully',
                                text: response.success,
                                icon: 'success',
                            }).then(() => {
                                // Xoá thông tin trong form sau khi thêm mới
                                $('.clearable').val('');
                                $('#errorDiv').hide(); // ẩn thông báo lỗi
                            });
                        }
                    },

                    function(error) {
                        if (error.responseJSON && error.responseJSON.errors) {
                            // Xử lý lỗi
                            var errorMessages = [];

                            if (error.responseJSON.errors.name) {
                                errorMessages.push(error.responseJSON.errors.name);
                            }
                            if (error.responseJSON.errors.image) {
                                errorMessages.push(error.responseJSON.errors.image);
                            }
                            if (error.responseJSON.errors.price) {
                                errorMessages.push(error.responseJSON.errors.price);
                            }

                            if (errorMessages.length > 0) {
                                var errorDiv = $('#errorDiv');
                                errorDiv.html("<p>Có lỗi xảy ra:</p><ul>");
                                var errorList = errorDiv.find("ul");
                                for (var i = 0; i < errorMessages.length; i++) {
                                    errorList.append("<li>" + " - " + errorMessages[i] +
                                        "</li>");
                                }
                                errorDiv.show();
                            }
                        }
                    }
                );
            });
        });
    </script>
@endsection
</body>

</html>

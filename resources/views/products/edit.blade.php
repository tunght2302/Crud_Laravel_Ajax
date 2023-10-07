@extends('layouts/app')
@section('title')
    <h1>Edit Product</h1>
@endsection
@section('content')
        <div id="errorDiv" class="alert  alert-danger" style="display: none;"></div>
        <form id="ajaxForm">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class=" clearable form-control" id="" name="name" placeholder="Name"
                    value="{{ $one_product->name }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" class="clearable form-control" id="" name="price" placeholder="Price"
                    value="{{ $one_product->price }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Current Image</label>
                <img src="{{asset($one_product->image)}}"  style="height:auto;width: 100px;">
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="clearable form-control" id="" name="image" placeholder="Price">
            </div>
            <button type="button" class="btn btn-primary" id="saveBtn">Update</button>
            <a href="{{ url('list-product') }}" class="btn btn-success ">List Product</a>
        </form>
    </div>
@endsection
@section('ajax')
    <script>
        $(function() {
            $('#saveBtn').on('click', function() {
                var formData = new FormData($('#ajaxForm')[0]);

                sendAjaxRequest('/update/{{ $one_product->id }}', formData,
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

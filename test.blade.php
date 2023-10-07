    <script>
        $(function () {
            $('#saveBtn').on('click', function () {

                var formData = new FormData($('#ajaxForm')[0]);

                jQuery.ajax({
                    url: '/add-product',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Successfully',
                                text: response.success,
                                icon: 'success',
                            }).then(() => {
                                // Xoá thông tin trong form sau khi thêm mới
                                $('.clearable').val('');
                                $('#errorDiv').hide();
                            });
                        }
                    },
                    error: function (error) {
                        if (error.responseJSON && error.responseJSON.errors) {
                            // Nếu có lỗi từ server trả về
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
                });
            });
        });
    </script>


    <script>
        $(function () {
            $('#saveBtn').on('click', function () {
                // Lấy giá trị token CSRF từ thẻ meta
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Chỗ này là nơi bạn sử dụng mã JavaScript đã gửi
                sendAjaxRequest('/add-product', 'POST', null, function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Successfully',
                            text: response.success,
                            icon: 'success',
                        }).then(() => {
                            // Xoá thông tin trong form sau khi thêm mới
                            $('.clearable').val('');
                            $('#errorDiv').hide();
                        });
                    }
                }, function (xhr, status, error) {
                    // Xử lý lỗi ở đây
                    if (error.responseJSON && error.responseJSON.errors) {
                        // Nếu có lỗi từ server trả về
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
                });
            });
        });
    </script>
<script>
    $(function () {
        $('#saveBtn').on('click', function () {

        });
    });
</script>
<script>
    function sendAjaxRequest(url, method, data, successCallback, errorCallback) {
        $.ajax({
            type: method,
            url: url,
            data: data,
            success: function (response) {
                successCallback(response);
            },
            error: function (xhr, status, error) {
                errorCallback(xhr, status, error);
            }
        });
    }
</script>


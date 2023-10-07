// ajax-helper.js
// Đây là một comment trong JavaScript để giới thiệu mã và cho biết tên của tệp.

function sendAjaxRequest(url, method, data, successCallback, errorCallback) {
    // Đây là định nghĩa của hàm JavaScript với năm tham số:
    // 1. `url`: Địa chỉ URL mà yêu cầu Ajax sẽ được gửi đến.
    // 2. `method`: Phương thức HTTP của yêu cầu Ajax (GET, POST, PUT, DELETE, vv.).
    // 3. `data`: Dữ liệu gửi đi trong yêu cầu Ajax, thường là một đối tượng FormData.
    // 4. `successCallback`: Hàm được gọi khi yêu cầu Ajax thành công.
    // 5. `errorCallback`: Hàm được gọi khi có lỗi xảy ra trong quá trình thực hiện yêu cầu Ajax.

    jQuery.ajax({
        // Bắt đầu một yêu cầu Ajax bằng cách sử dụng jQuery.ajax().

        url: url,
        // Địa chỉ URL mà yêu cầu Ajax sẽ được gửi đến.

        type: method,
        // Phương thức HTTP của yêu cầu Ajax, được truyền từ tham số `method`.

        processData: false,
        // Đặt processData thành false để ngăn jQuery tự động xử lý dữ liệu truyền vào.

        contentType: false,
        // Đặt contentType thành false để ngăn jQuery tự động đặt tiêu đề Content-Type.

        data: data,
        // Dữ liệu gửi đi trong yêu cầu Ajax, được truyền từ tham số `data`.

        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        // Đây là tiêu đề HTTP được thêm vào yêu cầu Ajax để gửi token CSRF từ thẻ meta.

        success: function (response) {
            // Hàm được gọi khi yêu cầu Ajax thành công và nhận được phản hồi từ máy chủ.
            successCallback(response);
        },

        error: function (error) {
            // Hàm được gọi khi yêu cầu Ajax gặp lỗi, và thông tin lỗi được trả về.
            errorCallback(error);
        },
    });
}

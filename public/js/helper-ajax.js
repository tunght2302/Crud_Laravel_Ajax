// ajax-helper.js
function sendAjaxRequest(url,method,data, successCallback, errorCallback) {
    jQuery.ajax({
        url: url,
        type: method,
        processData: false,
        contentType: false,
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            successCallback(response);
        },
        error: function (error) {
            errorCallback(error);
        },
    });
}



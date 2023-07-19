$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(".btn-submit").click(function (e) {
    e.preventDefault();

    var title = $("#titleID").val();
    var body = $("#bodyID").val();

    $.ajax({
        type: "POST",
        url: "{{ route('posts.store') }}",
        data: { title: title, body: body },
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                alert(data.success);
                location.reload();
            } else {
                printErrorMsg(data.error);
            }
        },
    });
});

function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html("");
    $(".print-error-msg").css("display", "block");
    $.each(msg, function (key, value) {
        $(".print-error-msg")
            .find("ul")
            .append("<li>" + value + "</li>");
    });
}

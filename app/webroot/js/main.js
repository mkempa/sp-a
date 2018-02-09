
$(document).ready(function () {

    $("#FilterPreviewForm input[name='filterrecords']").change(function () {
        $("#FilterPreviewForm").submit();
    });

    $(".user-remove-genera-btn").click(function (e) {
        e.preventDefault();
        $("#user-assigned-genera input[type='checkbox']").prop('checked', false);
        var el = $(this).data('idUsersgeneraEl');
        $("#" + el).prop('checked', true);
        $("#user-remove-genera-form").submit();
    });

    $("#user-remove-selected-genera-btn").prop('disabled', true);
    $("#user-remove-genera-form input[type='checkbox']").click(function () {
        console.log("abcd");
        if ($("#user-remove-genera-form input[type='checkbox']:checked").length > 0) {
            $("#user-remove-selected-genera-btn").prop('disabled', false);
        } else {
            $("#user-remove-selected-genera-btn").prop('disabled', true);
        }
    });
});
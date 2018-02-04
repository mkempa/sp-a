
$(document).ready(function() {
   
    $("#FilterPreviewForm input[name='filterrecords']").change(function() {
        $("#FilterPreviewForm").submit();
    });
     
    $(".user-remove-genera-btn").click(function (e) {
        e.preventDefault();
        $("#user-assigned-genera input[type='checkbox']").prop('checked', false);
        var el = $(this).data('idUsersgeneraEl');
        $("#" + el).prop('checked', true);
        $("#user-remove-genera-form").submit();
    });
     
});
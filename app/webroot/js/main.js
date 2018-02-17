
$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    /*
     * Checklist data filter
     */

    //types selection
    $("#checklist-filter-types input").change(function (e) {
        if (e.target.id === 'filter-types-all') { //if clicked all
            $("#checklist-filter-types input:not(#filter-types-all)").prop('checked', false); //unclick all others
        } else {
            $("#checklist-filter-types input#filter-types-all").prop('checked', false); //unclick All
            $("#checklist-filter-types input#filter-types-all").prop('disabled', false); //enable All
        }
        if ($("#checklist-filter-types input:not(#filter-types-all):checked").length === 0) {
            $("#checklist-filter-types input#filter-types-all").prop('checked', true);
        }
    });

     //submit data filter on click
    $("#FilterPreviewForm input.submit-on-click").change(function () {
        $("#FilterPreviewForm").submit();
    });
    $("#FilterPreviewForm-freetext-submit").click(function () {
        $("#FilterPreviewForm").submit();
    });
    $("#FilterPreviewForm-freetext-clear").click(function () {
        $("#FilterFreetext").val('');
        $("#FilterPreviewForm").submit();
    });
    
    /*
     * User management
     */
    
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
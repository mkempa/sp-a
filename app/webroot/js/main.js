
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
    
    /*
     * Synonyms management
     */
    function selectForm(url, options) {
        var $form = $('<form>').attr('id', 'add-synonym-form').addClass('add-synonym-form').attr('action', url).attr('role', 'form').attr('method', 'post').attr('accept-charset', "utf-8");
        var $select = $('<select>').addClass('form-control').attr('name', 'synonym');
        
        $.each(options, function (k, v) {
            $('<option>').val(k).text(v).appendTo($select);
        });
        var $divBtns = $('<div>').addClass('input-group-btn editable-buttons');
        $('<button>').attr('type', 'submit').addClass('btn btn-primary').append('<span class="glyphicon glyphicon-ok"></span>').appendTo($divBtns);
        $('<button>').attr('type', 'button').addClass('btn btn-cancel').append('<span class="glyphicon glyphicon-remove"></span>').appendTo($divBtns);
        $('<div>').addClass('input-group').append($select).append($divBtns).appendTo($form);
        return $form;
    }
    
    $(".addable").on('click', 'form.add-synonym-form button.btn-cancel', function() {
        $(this).closest('ul.list-group').find('li:last-child button').prop('disabled', false);
        $(this).closest('li.list-group-item').remove();
    });
     
    $("#checklist-edit button.add-row-btn").click(function () {
        var $li = $('<li>').addClass('list-group-item');
        var synonymsList = $('#synonyms-list').val();
        var $selectForm = selectForm($(this).data('url'), JSON.parse(synonymsList));
        $li.append($selectForm);
        $(this).parent('li.list-group-item').prev().after($li);
        $(this).prop('disabled', true);
    });
});
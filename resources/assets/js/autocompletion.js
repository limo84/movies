$(function () {
    $(".autocomplete-field").each(function (tmp, elm) {
        $elm = $(elm);
        $elm.autocomplete({
            source: $elm.data('url'),
            minLength: 3,
            select: function (event, ui) {
                let autofillUrl = $(event.target).data('autofill-url');
                if (autofillUrl) {
                    console.log(ui);
                    $.get(autofillUrl + "/" + ui.item.value, function (data) {
                        for (let inputId in data) {
                            if (data.hasOwnProperty(inputId)) {
                                $("#" + inputId).val(data[inputId]);
                            }
                        }
                    });
                }
            }
        });
    })
});
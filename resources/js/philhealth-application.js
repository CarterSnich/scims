$('#same-as-above').on('change', function () {
    if (this.checked) {
        $('#mailing-address > div.row.g-3 :input').attr('disabled', true)
        $('#mailing-address > div.row.g-3 :input').addClass('disabled')
    } else {
        $('#mailing-address > div.row.g-3 :input').attr('disabled', false)
        $('#mailing-address > div.row.g-3 :input').removeClass('disabled')
    }
})


$('input[type=checkbox].is-required').on('change', function () {
    let dependentField = $(`[data-requires-field=${$(this).attr('name')}]`);
    let requiredValue = dependentField.attr('data-required-value');

    if (this.checked) {
        dependentField.removeClass('disabled')
        dependentField.attr('disabled', false)
    } else {
        dependentField.addClass('disabled')
        dependentField.attr('disabled', true)
        if (dependentField.attr('type') == 'checkbox') {
            dependentField.prop("checked", false);
        } else {
            dependentField.val('');
        }
    }

})
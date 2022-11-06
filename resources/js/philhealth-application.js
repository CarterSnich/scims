let initialValues = {};

$('#same-as-above').on('change', function () {
    if (this.checked) {
        $('#permanent-home-address input[data-same-field]').each(function () {
            let field = $(this)
            let fieldName = field.attr('data-same-field');
            let sameField = $(`#mailing-address input[data-same-field=${fieldName}]`);
            initialValues[fieldName] = sameField.val()
            sameField.val(field.val()).attr('disabled', true)
        })
    } else {
        $.each(initialValues, function (fieldName, value) {
            $(`#mailing-address input[data-same-field=${fieldName}]`).val(value).attr('disabled', false)
        })
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
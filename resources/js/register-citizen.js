$('#picture-upload').on('change', function () {
    const [file] = this.files
    if (file) $('#picture-placeholder').attr('src', URL.createObjectURL(file))

})

$('button.insert-family-entry').on('click', function () {
    $('#family-composition-table tbody').append(`       
        <tr>
            <input type="hidden" name="_family_member[]" value="${$('#family-composition-table tbody').children().length}">
            <td>
                <input type="text" class="form-control form-control-sm" name="family_member_name[]" required>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm" name="family_member_relationship[]" required>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm" name="family_member_age[]" required>
            </td>
            <td>
                <select class="form-select form-select-sm" name="family_member_civil_status[]" required>
                    <option value="" selected disabled>Select status</option>
                    <option value="unmarried">Unmarried</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm" name="family_member_occupation[]" required>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm" name="family_member_income[]" pattern="([1-9][0-9]*|0)" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-entry">Remove</button>
            </td>
        </tr>
    `)
})


$('#family-composition-table tbody').on('click', 'tr>td>button.remove-entry', function () {
    $(this).parent().parent().remove()
})
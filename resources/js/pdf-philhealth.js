
let form1 = document.querySelector('meta[name=form1]').getAttribute('content')
let form2 = document.querySelector('meta[name=form2]').getAttribute('content')
let philhealth = JSON.parse(document.querySelector('meta[name=philhealth]').getAttribute('content'))

console.log(JSON.stringify(philhealth, null /*replacer function */, 4 /* space */))

window.jsPDF = window.jspdf.jsPDF;
window.moment = window.moment;

var doc = new jsPDF({
    orientation: "portrait",
    unit: "in",
    format: [11.69, 8.26]
});
doc.setFontSize(10)
doc.addImage(form1, 'PNG', 0, 0, 8.26, 11.69)

// pin
let initial = 5.35;
for (let i = 1; i <= philhealth.pin.length; i++) {
    doc.text(philhealth.pin[i - 1], initial, 1.1)
    initial += i % 4 == 0 ? .27 : .21;
}

// purpose
if (philhealth.purpose == 'registration') {
    doc.text('x', 4.94, 1.72) // registration
} else {
    doc.text('x', 6.18, 1.72) // updating/amendment
}

// preferred konsulta provider
doc.text(philhealth.konsulta_provider, 4.93, 2.13)

// member lastname
doc.text(philhealth.member_lastname, 1.25, 2.95)

// member firstname
doc.text(philhealth.member_firstname, 3.05, 2.95)

// member name extension
doc.text(philhealth.member_name_extension, 4.84, 2.95)

// member middlename
doc.text(philhealth.member_middlename, 5.41, 2.95)

// member no middlename
if (philhealth.member_no_middlename)
    doc.text('x', 7.325, 2.955)

// member no mononym
if (philhealth.member_no_mononym)
    doc.text('x', 7.74, 2.955)


// mother lastname
doc.text(philhealth.mother_lastname || 'sample', 1.25, 3.27)

// mother firstname
doc.text(philhealth.mother_firstname || 'sample', 3.05, 3.27)

// mother name extension
doc.text(philhealth.mother_name_extension || 'sample', 4.84, 3.27)

// mother middlename
doc.text(philhealth.mother_middlename || 'sample', 5.41, 3.27)

// mother no middlename
if (philhealth.mother_no_middlename)
    doc.text('x', 7.325, 3.42)

// mother no mononym
if (philhealth.mother_no_mononym)
    doc.text('x', 7.74, 3.42)


// spouse lastname
doc.text(philhealth.spouse_lastname || 'sample', 1.25, 3.6)

// spouse firstname
doc.text(philhealth.spouse_firstname || 'sample', 3.05, 3.6)

// spouse name extension
doc.text(philhealth.spouse_name_extension || 'sample', 4.84, 3.6)

// spouse middlename
doc.text(philhealth.spouse_middlename || 'sample', 5.41, 3.6)

// spouse no middlename
if (philhealth.spouse_no_middlename)
    doc.text('x', 7.325, 3.65)

// spouse no mononym
if (philhealth.spouse_no_mononym)
    doc.text('x', 7.74, 3.65)


// date of birth
const formattedDate = moment(philhealth.date_of_birth, "YYYYMMDD").format('MMDDYYYY')
initial = 0.375;
for (let i = 1; i <= formattedDate.length; i++) {
    doc.text(formattedDate[i - 1], initial, 4.075)
    initial += (i % 2 == 0) && (i < 5) ? .27 : .21;
}

// place of birth
doc.text(philhealth.place_of_birth, 2.32, 4.1)


// 	philsys_id_number
initial = 5.37;
for (let i = 1; i <= philhealth.philsys_id_number.length; i++) {
    doc.text(philhealth.philsys_id_number[i - 1], initial, 4.18)
    initial += (i % 4 == 0) && (i < 9) ? .27 : .21;
}

// sex
if (philhealth.sex === 'male') {
    doc.text('x', .3, 4.65)
} else {
    doc.text('x', .3, 4.82)
}


// civil status
switch (philhealth.civil_status) {
    case 'single':
        doc.text('x', .94, 4.62)
        break;

    case 'married':
        doc.text('x', .94, 4.78)

        break;

    case 'legally_separated':
        doc.text('x', .94, 4.94)
        break;

    case 'annulled':
        doc.text('x', 1.6, 4.62)

        break;

    case 'widower':
        doc.text('x', 1.6, 4.78)
        break;

}

// citizenship
switch (philhealth.citizenship) {
    case 'filipino':
        doc.text('x', 2.5, 4.65)
        break;

    case 'foreign':
        doc.text('x', 2.5, 4.88)
        break;

    case 'dual':
        doc.text('x', 3.7, 4.65)
        break;
}


// 	tax payers identification number
initial = 5.37;
for (let i = 1; i <= philhealth.tin.length; i++) {
    doc.text(philhealth.tin[i - 1], initial, 4.75)
    initial += (i % 3 == 0) && (i < 7) ? .27 : .21;
}


// permanent_unit_room_no_floor
doc.text(philhealth.permanent_unit_room_no_floor, .29, 5.68)

// permanent_building_name
doc.text(philhealth.permanent_building_name, 1.35, 5.68)

// permanent_lot_block_phase_house_no
doc.text(philhealth.permanent_lot_block_phase_house_no, 2.2, 5.68)

// permanent_street_name
doc.text(philhealth.permanent_street_name, 4.12, 5.68)

// permanent_subdivision
doc.text(philhealth.permanent_subdivision, .29, 6.05)

// permanent_barangay
doc.text(philhealth.permanent_barangay, 1.21, 6.05)

// permanent_municipality_city
doc.text(philhealth.permanent_municipality_city, 2.2, 6.05)

// permanent_province_state_country
doc.text(philhealth.permanent_province_state_country, 3.12, 6.05)

// permanent_zip_code
doc.text(philhealth.permanent_zip_code, 4.95, 6.05)

// same_as_above
if (philhealth.same_as_above)
    doc.text('x', 1.625, 6.22)



// mailing_unit_room_no_floor
doc.text(philhealth.mailing_unit_room_no_floor ?? 'asd', .29, 6.53)

// mailing_building_name
doc.text(philhealth.mailing_building_name ?? 'asd', 1.35, 6.53)

// mailing_lot_block_phase_house_no
doc.text(philhealth.mailing_lot_block_phase_house_no ?? 'asd', 2.2, 6.53)

// mailing_street_name
doc.text(philhealth.mailing_street_name ?? 'asd', 4.12, 6.53)

// mailing_subdivision
doc.text(philhealth.mailing_subdivision ?? 'asd', .29, 6.95)

// mailing_barangay
doc.text(philhealth.mailing_barangay ?? 'asd', 1.21, 6.95)

// mailing_municipality_city
doc.text(philhealth.mailing_municipality_city ?? 'asd', 2.2, 6.95)

// mailing_province_state_country
doc.text(philhealth.mailing_province_state_country ?? 'asd', 3.12, 6.95)

// mailing_zip_code
doc.text(philhealth.mailing_zip_code ?? 'asd', 4.95, 6.95)

// home_phone_no
doc.text(philhealth.home_phone_no, 5.625, 5.6)

// mobile_no
doc.text(philhealth.mobile_no, 5.625, 6.125)

// business_direct_line
doc.text(philhealth.business_direct_line, 5.625, 6.525)

// email
doc.text(philhealth.email, 5.625, 6.875)



doc.addPage()
doc.addImage(form2, 'PNG', 0, 0, 8.26, 11.69)

document.querySelector('#pdf-viewer').setAttribute('src', doc.output('datauristring'))

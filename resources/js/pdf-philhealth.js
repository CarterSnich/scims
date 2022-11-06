
let form1 = document.querySelector('meta[name=form1]').getAttribute('content')
let form2 = document.querySelector('meta[name=form2]').getAttribute('content')
let philhealth = JSON.parse(document.querySelector('meta[name=philhealth]').getAttribute('content'))

console.log(JSON.stringify(philhealth, null /*replacer function */, 4 /* space */))

window.jsPDF = window.jspdf.jsPDF;

var doc = new jsPDF({
    orientation: "portrait",
    unit: "in",
    format: [11.69, 8.26]
});
doc.setFontSize(12)
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


doc.addPage()
doc.addImage(form2, 'PNG', 0, 0, 8.26, 11.69)

document.querySelector('#pdf-viewer').setAttribute('src', doc.output('datauristring'))

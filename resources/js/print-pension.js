const ucfirst = function (string) {
    return string[0].toUpperCase() + string.substring(1);
}


let pension = JSON.parse(document.querySelector('meta[name=pension]').getAttribute('content'))
let fullname = document.querySelector('meta[name=fullname]').getAttribute('content')
let barangay = JSON.parse(document.querySelector('meta[name=barangay]').getAttribute('content'))
let picture = document.querySelector('meta[name=picture]').getAttribute('content')

let form = document.querySelector('meta[name=form]').getAttribute('content')

window.jsPDF = window.jspdf.jsPDF;

const height = 11.00;
const width = 8.50;
var doc = new jsPDF({
    orientation: "portrait",
    unit: "in",
    format: [height, width]
});

const align_center = {
    align: 'center'
}

doc.setFontSize(12);
doc.setLineWidth(.01);

// form
doc.addImage(form, form.split('.').pop().toUpperCase(), 0, 0, width, height);

console.dir(pension)

// picture
let pictureFormat = picture.split('.').pop().toUpperCase();
doc.addImage(picture, pictureFormat, 6.4, .47, 1, 1);

// fullname
doc.text(fullname, 2.25, 2.07)


// citizenship
doc.text(pension.citizenship, 6, 2.07)

// age 
doc.text(pension.age.toString(), 1.3, 2.5)

// birthdate
let [yy, mm, dd] = pension.date_of_birth.split('-')
doc.text(`${mm}/${dd}/${yy}`, 2.8, 2.5)

// place of birth
doc.text(pension.place_of_birth, 5.14, 2.5)

// place of birth
doc.text(ucfirst(pension.sex), 1.25, 2.8)

// civil status
switch (pension.civil_status) {
    case 'unmarried':
        doc.text('x', 3.1, 2.8)
        break;

    case 'married':
        doc.text('x', 4.15, 2.8)
        break;

    case 'divorced':
        doc.text('x', 5.34, 2.8)
        break;

    case 'widowed':
        doc.text('x', 6.68, 2.8)
        break;
}

// addres
doc.text(`${pension.house_no}, ${pension.street}, ${barangay.barangay_name}`, 1.6, 3.08)

// addres
doc.text(pension.no_of_years_stay.toString(), 6.96, 3.08)

// living arrangement
switch (pension.living_arrangement) {
    case "1":
        doc.text('x', 1.7, 3.85)
        break;

    case "2":
        doc.text('x', 4.2, 3.85)
        break;

    case "3":
        doc.text('x', 1.7, 4.1)
        break;

    case "4":
        doc.text('x', 4.2, 4.1)
        break;
}

// pensioner?
if (pension.pensioner) {
    doc.text('x', 2.05, 4.74)
} else {
    doc.text('x', 3.06, 4.74)
}

// pensioner how much
if (pension.pensioner)
    doc.text(pension.pensioner_amount, 5.75, 4.74)


// pensioner?
switch (pension.pensioner_source) {
    case "gsis":
        doc.text('x', 2.05, 5)
        break;

    case "sss":
        doc.text('x', 3.06, 5)
        break;

    case "afpslai":
        doc.text('x', 4.18, 5)
        break;

    case "others":
        doc.text('x', 5.56, 5)
        break;
}

// permanent source of income
if (pension.permanent_source_of_income) {
    doc.text('x', 3.38, 5.27)
} else {
    doc.text('x', 4.43, 5.27)
}

// source of income
doc.text(pension.source_of_income ?? '', 2.7, 5.5)

// set pdf to iframe
document.querySelector('iframe').setAttribute('src', doc.output('datauristring'))
// doc.save(`${document.title}.pdf`)

if (!!window.chrome)
    alert("On Chromium-based browsers, PDF may fail rendering, instead it will be downloaded. If there is no downloaded PDF file, please contact the system administration.")
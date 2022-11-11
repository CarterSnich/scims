const ucfirst = function (string) {
    return string[0].toUpperCase() + string.substring(1);
}

let citizen = JSON.parse(document.querySelector('meta[name=citizen]').getAttribute('content'))
let citizenId = document.querySelector('meta[name=citizen_id]').getAttribute('content')
let fullname = document.querySelector('meta[name=fullname]').getAttribute('content')
let age = document.querySelector('meta[name=age]').getAttribute('content')
let educational_attainment = document.querySelector('meta[name=educational_attainment]').getAttribute('content')
let barangay = JSON.parse(document.querySelector('meta[name=barangay]').getAttribute('content'))
let picture = document.querySelector('meta[name=picture]').getAttribute('content')

let form = document.querySelector('meta[name=form]').getAttribute('content')

window.jsPDF = window.jspdf.jsPDF;

var doc = new jsPDF({
    orientation: "portrait",
    unit: "in",
    format: [11.69, 8.27]
});

const align_center = {
    align: 'center'
}

doc.setFontSize(12);
doc.setLineWidth(.01);

// form
doc.addImage(form, form.split('.').pop().toUpperCase(), 0, 0, 8.27, 11.69);

console.dir(citizen)

// ------------------------------------
//           VALUES
// ------------------------------------

// name
doc.text(fullname, 1.25, 2.1) // fullname

// date of birth
let [yy, mm, dd] = citizen['date_of_birth'].split('-')
doc.text(`${mm}/${dd}/${yy}`, 2.7, 2.32, align_center) // date of birth

// age
doc.text(age + '', 5, 2.32, align_center)

// sex
doc.text(ucfirst(citizen['sex']), 6.5, 2.32, align_center)

// place of birth
doc.text(citizen['place_of_birth'], 2.8, 2.525, align_center)

// civil status
doc.text(ucfirst(citizen['civil_status']), 5.7, 2.525, align_center)

// address
doc.text(`${citizen.house_no}, ${citizen.street}, ${barangay.barangay_name}`, 2.45, 2.75, align_center)

// picture ID
let pictureFormat = picture.split('.').pop().toUpperCase();
doc.addImage(picture, pictureFormat, 6.5, .5, 1, 1);

// educational attainment
doc.text(educational_attainment, 2.3, 2.955)

// occupation
doc.text(citizen['occupation'], 1.6, 3.185)

// other skills
doc.text(citizen['other_skills'] || '', 1.6, 3.38)

// annual income
doc.text(`P ${citizen['annual_income']}`, 5.9, 3.38, align_center)

// family composition
let init_x = 4.7;
citizen['family_composition'].forEach(member => {
    doc.text(member['name'], 1.7, init_x, align_center) // name
    doc.text(member['relationship'], 3.4, init_x, align_center) // relationship
    doc.text(member['age'], 4.35, init_x, align_center) // age
    doc.text(ucfirst(member['civil_status']), 5.05, init_x, align_center) // civil_status
    doc.text(ucfirst(member['occupation']), 6.15, init_x, align_center) // occupation
    doc.text(ucfirst(member['income']), 7.14, init_x, align_center) // income
    init_x += .25;
});

// name of association
doc.text(citizen['name_of_association'] ?? '', 2.1, 6.75)

// address of association
doc.text(citizen['address_of_association'] ?? '', 1.3, 7)

// address of association
doc.text(citizen['date_of_membership'] ?? '', 2.5, 7.25)

// term
doc.text(citizen['term'] ?? '', 3, 7.5)

// set pdf to iframe
document.querySelector('iframe').setAttribute('src', doc.output('datauristring'))
doc.save(`${document.title}.pdf`)

if (!!window.chrome)
    alert("On Chromium-based browsers, PDF may fail rendering, instead it will be downloaded. If there is no downloaded PDF file, please contact the system administration.")
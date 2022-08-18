<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="font" content="{{ asset('fonts/Roboto/Roboto-Regular.ttf') }}">
    <meta name="logo" content="{{ asset('images/logo.png') }}">
    <meta name="form" content="{{ asset('images/scims-application-form.jpg') }}">
    <meta name="citizen" content="{{ json_encode($citizen) }}">
    <meta name="barangay" content="{{ json_encode($barangay) }}">
    <meta name="picture" content="{{ asset("storage/pictures/{$citizen['picture']}") }}">

    <title>Senior Citizen ID #{{ $citizen['citizenId'] }} {{ $citizen['fullname'] }}</title>

    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <style>
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        iframe {
            width: 100%;
            height: 100vh;
            border: none;
            box-sizing: border-box;
            display: block
        }
    </style>
</head>

<body>
    <iframe></iframe>
    <script>
        let citizen = JSON.parse(document.querySelector('meta[name=citizen]').getAttribute('content'))
        let barangay = JSON.parse(document.querySelector('meta[name=barangay]').getAttribute('content'))
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





        // ------------------------------------
        //           VALUES
        // ------------------------------------

        // name
        doc.text(citizen['lastname'], 2.25, 3.95, align_center) // lastname
        doc.text(citizen['firstname'], 3.95, 3.95, align_center) // firstname
        doc.text(citizen['middlename'] || '', 6, 3.95, align_center) // middlename

        // address
        doc.text(barangay['barangay_name'] || '', 2.75, 4.5, align_center) // barangay
        doc.text(citizen['province'], 5.2, 4.5, align_center) // province

        // other stuff
        let [yy, mm, dd] = citizen['birthdate'].split('-')
        doc.text(`${mm}/${dd}/${yy}`, 2.3, 5.1, align_center) // date of birth
        doc.text(citizen['age'] + '', 3.58, 5.1, align_center) // age
        doc.text(citizen['marital_status'][0].toUpperCase() + citizen['marital_status'].substring(1), 6.1, 5.1, align_center) // marital status

        // picture ID
        let pictureId = document.querySelector('meta[name=picture]').getAttribute('content');
        let pictureFormat = pictureId.split('.').pop().toUpperCase();
        doc.addImage(pictureId, pictureFormat, 5.95, .5, 1, 1);

        // set pdf to iframe
        document.querySelector('iframe').setAttribute('src', doc.output('datauristring'))
        doc.save(`${document.title}.pdf`)

        if (!!window.chrome) {
            alert("On Chromium-based browsers, PDF may fail rendering, instead it will be downloaded. If there is no downloaded PDF file, please contact the system administration.")
        }
    </script>
</body>

</html>

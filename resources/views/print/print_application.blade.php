<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="font" value="{{ asset('fonts/Roboto/Roboto-Regular.ttf') }}">
    <meta name="logo" value="{{ asset('images/logo.png') }}">
    <meta name="application" value="{{ json_encode($application) }}">
    <meta name="picture" value="{{ asset("storage/pictures/{$application->picture}") }}">

    <title>Senior Citizen ID #{{ $application->cid }}</title>

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
        let application = JSON.parse(document.querySelector('meta[name=application]').getAttribute('value'))
        console.dir(application)

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

        // ------------------------------------
        //           HEADER
        // ------------------------------------

        // logo
        doc.addImage(document.querySelector('meta[name=logo]').getAttribute('value'), "PNG", 1, .6, 1, 1);

        // Republic of the philippines
        doc.text('Republic of the Philippines', 8.27 / 2, .75, align_center)

        // Province of leyte
        doc.text('Province of Leyte', 8.27 / 2, 1, {
            align: 'center'
        })

        // OFFICE OF THE SENIOR CITIZENS AFFAIR
        doc.text('OFFICE OF THE SENIOR CITIZENS AFFAIR', 8.27 / 2, 1.25, align_center)

        // Municipality of Tanauan
        doc.text('Municipality of Tanauan', 8.27 / 2, 1.5, align_center)

        // Municipality of Tanauan
        doc.text('_________oOo_________', 8.27 / 2, 1.75, align_center)

        // picture ID
        doc.rect(6.27, .6, 1, 1);



        // ------------------------------------
        //           BODY
        // ------------------------------------

        // OSCA ID APPLICATION FORM
        doc.text('OSCA ID APPLICATION FORM', 8.27 / 2, 2.5, align_center)

        // box 1
        doc.rect(.5, 2.6, 8.27 - 1, 1.1 - .35);

        // purpose
        doc.text('PURPOSE:', .75, 2.85)

        // new registration
        doc.rect(.75, 3.25 - .2, 0.2, 0.2);
        doc.text('New Registration', 1.1, 3.4 - .2);

        // lost ID
        doc.rect(2.75, 3.25 - .2, 0.2, 0.2);
        doc.text('Lost ID', 3.1, 3.4 - .2);

        // replacement
        doc.rect(4.40, 3.25 - .2, 0.2, 0.2);
        doc.text('Replacement', 4.75, 3.4 - .2);

        // transferee
        doc.rect(6.25, 3.25 - .2, 0.2, 0.2);
        doc.text('Transferee', 6.6, 3.4 - .2);

        // box 2
        doc.rect(.5, 4 - .45, 8.27 - 1, 3.5);

        // date applied
        doc.text('DATE APPLIED: ___________________', .75, 4.4 - .45)
        // doc.text('January 01, 2020', 2.2, 4.38) // value

        // osca id
        doc.text('OSCA ID #: _______________________', .75, 4.70 - .45)
        // doc.text('20001234567', 2.2, 4.68) // value

        // date issued
        doc.text('DATE ISSUED: ____________________', .75, 5 - .45)
        // doc.text('January 01, 2020', 2.2, 4.98) // value

        // NAME
        doc.text('NAME: _________________________________________________________________', .75, 5.5 - .45)
        doc.text('                          (Last name)                      (First name)                     (Middle name)', .75, 5.71 - .45)


        // Address
        doc.text('ADDRESS: _____________________________________________________________', .75, 6.25 - .45)
        doc.text('                                       (BARANGAY)                                 (PROVINCE)', .75, 6.46 - .45)


        // other stuff
        doc.text('DATE OF BIRTH: _____________ AGE: _____ MARITAL STATUS: ________________', .75, 7 - .45)
        doc.text('                                (MM/DD/YY)', .75, 7.21 - .45)



        // box 3
        doc.rect(.5, 7.7 - .45, 8.27 - 1, 3);

        // FOR REPLACEMENT:
        doc.text('FOR REPLACEMENT:', .75, 7.55)

        // Dilapidated
        doc.rect(.75, 7.775, 0.2, 0.2);
        doc.text('Dilapidated', 1, 7.95);

        // Faded Print
        doc.rect(2, 7.775, 0.2, 0.2);
        doc.text('Faded Print', 2.25, 7.95);

        // Erroneous Entry
        doc.rect(3.25, 7.775, 0.2, 0.2);
        doc.text('Erroneous Entry', 3.5, 7.95);

        // Change Address
        doc.rect(4.75, 7.775, 0.2, 0.2);
        doc.text('Change Address', 5, 7.95);

        // Change Address
        doc.rect(4.75, 7.775, 0.2, 0.2);
        doc.text('Change Address', 5, 7.95);




        // ------------------------------------
        //           VALUES
        // ------------------------------------

        // purpose
        if (application.purpose == 'new_registration') {
            doc.text('X', .8, 3.2) // new registration
        } else if (application.purpose == 'lost_id') {
            doc.text('X', 2.8, 3.2) // lost id
        } else if (application.purpose == 'replacement') {
            doc.text('X', 4.4525, 3.2) // replacement
        } else if (application.purpose == 'transferee') {
            doc.text('X', 6.3, 3.2) // transferee
        }


        // name
        doc.text(application['lastname'], 2.35, 5.48 - .45, align_center) // lastname
        doc.text(application['firstname'], 4.3, 5.48 - .45, align_center) // firstname
        doc.text(application['middlename'] || '', 6.3, 5.48 - .45, align_center) // middlename

        // address
        doc.text(application['barangay_name'] + '', 3.1, 6.23 - .45, align_center) // barangay
        doc.text(application['province'], 5.60, 6.23 - .45, align_center) // province

        // other stuff
        let [yy, mm, dd] = application['birthdate'].split('-')
        doc.text(`${mm}/${dd}/${yy}`, 2.74, 6.98 - .45, align_center) // date of birth
        doc.text(application['age'] + '', 4.05, 6.98 - .45, align_center) // age
        doc.text(application['marital_status'][0].toUpperCase() + application['marital_status'].substring(1), 6.6, 6.98 - .45, align_center) // marital status

        // picture ID
        let pictureId = document.querySelector('meta[name=picture]').getAttribute('value');
        let pictureFormat = pictureId.split('.').pop().toUpperCase();
        doc.addImage(pictureId, pictureFormat, 6.27, .6, 1, 1);

        // set pdf to iframe
        document.querySelector('iframe').setAttribute('src', doc.output('datauristring'))
        // doc.save(`${document.title}.pdf`)

        // if (!!window.chrome) {
        //     alert("On Chromium-based browsers, PDF may fail rendering, instead it will be downloaded. If there is no downloaded PDF file, please contact the system administration.")
        // }
    </script>
</body>

</html>

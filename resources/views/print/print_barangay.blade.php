<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="font" value="{{ asset('fonts/Roboto/Roboto-Regular.ttf') }}">
    <meta name="logo" value="{{ asset('images/logo.png') }}">
    <meta name="barangay" value="{{ json_encode($barangay) }}">
    <meta name="residents" value="{{ json_encode($residents) }}">

    <title>Barangays</title>

    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('js/jspdf.plugin.autotable.js') }}"></script>
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
        let barangay = JSON.parse(document.querySelector('meta[name=barangay]').getAttribute('value'))
        let residents = JSON.parse(document.querySelector('meta[name=residents]').getAttribute('value'))

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

        // Barangays Name
        doc.text('Barangay:', 0.6, 2.3)

        // Contact person:
        doc.text('Contact person:', 0.6, 2.5)

        // Contact no.:
        doc.text('Contact no.:', 0.6, 2.7)

        // Contact email:
        doc.text('Contact email:', 0.6, 2.9)

        // ------------------------------------
        //           VALUES
        // ------------------------------------

        // Barangays Name
        doc.text(barangay.barangay_name, 2, 2.3)

        // Contact person:
        doc.text(barangay.contact_person, 2, 2.5)

        // Contact no.:
        doc.text(barangay.contact_no, 2, 2.7)

        // Contact email:
        doc.text(barangay.email, 2, 2.9)

        let body = [];

        let i = 1;
        residents.forEach(row => {
            body.push([
                `${new Date(row.created_at).getFullYear()}-${("00000"+row.id).substr(-5)}`,
                row.lastname,
                row.firstname,
                row.middlename || '',
                row.age
            ])
        });

        doc.autoTable({
            startY: 3,
            head: [
                ['Senior Citizen ID', 'Last name', 'First name', 'Middle name', 'Age']
            ],
            body: body
        });

        // set pdf to iframe
        document.querySelector('iframe').setAttribute('src', doc.output('datauristring'))
        doc.save(`${document.title}.pdf`)
    </script>
</body>

</html>

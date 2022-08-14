<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="font" value="{{ asset('fonts/Roboto/Roboto-Regular.ttf') }}">
    <meta name="logo" value="{{ asset('images/logo.png') }}">
    <meta name="barangays" value="{{ json_encode($barangays) }}">

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
        let barangays = JSON.parse(document.querySelector('meta[name=barangays]').getAttribute('value'))

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

        // Barangays List
        doc.setFontSize(18);
        doc.text('Barangays list', 8.27 / 2, 2.3, align_center)

        // ------------------------------------
        //           VALUES
        // ------------------------------------

        let body = [];

        let i = 1;
        barangays.forEach(row => {
            body.push([
                (i++).toString(),
                row.barangay_name,
                row.contact_person,
                row.contact_no,
                row.email,
                `${row.no_of_residents || 0}`
            ])
        });

        doc.autoTable({
            startY: 2.5,
            head: [
                ['#', 'Barangay name', 'Contact person', 'Contact no.', 'Email', 'No. of residents']
            ],
            body: body,
        });

        // set pdf to iframe
        document.querySelector('iframe').setAttribute('src', doc.output('datauristring'))
        doc.save(`${document.title}.pdf`)
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="font" value="{{ asset('fonts/Roboto/Roboto-Regular.ttf') }}">
    <meta name="logo" value="{{ asset('images/logo.png') }}">
    <meta name="citizens" value="{{ json_encode($citizens) }}">

    <title>Senior Citizens</title>

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
        let citizens = JSON.parse(document.querySelector('meta[name=citizens]').getAttribute('value'))

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


        // ------------------------------------
        //           VALUES
        // ------------------------------------

        let body = [];

        citizens.forEach(row => {
            body.push([
                (function(row) {
                    let year = new Date(row.created_at).getFullYear();
                    let id = row.id;
                    return `${year}-${("00000" + id).substr(-5)}`;
                })(row),
                row.lastname,
                row.firstname,
                row.middlename || '',
                row.barangay_name
            ])
        });

        doc.autoTable({
            startY: 2,
            head: [
                ['ID', 'Last name', 'First name', 'Age', 'Barangay']
            ],
            body: body,
        });

        // set pdf to iframe
        document.querySelector('iframe').setAttribute('src', doc.output('datauristring'))
        doc.save(`${document.title}.pdf`)
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="form" content="{{ asset('images/scims-application-form.jpg') }}">
    <meta name="application" content="{{ json_encode($application) }}">
    <meta name="picture" content="{{ asset("storage/pictures/{$application->picture}") }}">

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
        let application = JSON.parse(document.querySelector('meta[name=application]').getAttribute('content'))
        let form = document.querySelector('meta[name=form]').getAttribute('content')
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

        // form
        doc.addImage(form, form.split('.').pop().toUpperCase(), 0, 0, 8.27, 11.69);


        // ------------------------------------
        //           VALUES
        // ------------------------------------

        // picture ID
        let pictureId = document.querySelector('meta[name=picture]').getAttribute('content');
        let pictureFormat = pictureId.split('.').pop().toUpperCase();
        doc.addImage(pictureId, pictureFormat, 5.95, .5, 1, 1);

        // purpose
        if (application.purpose == 'new_registration') {
            // new registration
            doc.text('X', .825, 2.45)

        } else if (application.purpose == 'lost_id') {
            // for lost ID
            doc.text('X', 2.525, 2.45)

            // date of loss
            let [dol_yy, dol_mm, dol_dd] = application.date_of_loss.split('-')
            doc.text(`${dol_yy}/${dol_mm}/${dol_dd}`, 2.25, 7.675, align_center)

            // where
            doc.text(application.lost_location || '', 5.5, 7.675, align_center)

        } else if (application.purpose == 'replacement') {
            doc.text('X', 4.13, 2.45) // replacement

            let coordinates = {
                dilapidated: [0.75, 6.55],
                faded_print: [1.95, 6.55],
                erroneous_entry: [3.15, 6.55],
                change_address: [4.6, 6.55],
                change_signature: [6.05, 6.55],

            }

            application.replacement_reasons.forEach(reason => {
                if (reason == 'others') {
                    doc.text(application.replacement_reason_others, 3.5, 6.9) // replacement
                } else {
                    doc.text('X', coordinates[reason][0], coordinates[reason][1]) // replacement
                }
            });



        } else if (application.purpose == 'transferee') {
            // transferee
            doc.text('X', 6.075, 2.45)

            // transfer from
            doc.text(application.transfer_from, 2.85, 8.475, align_center)

            // transfer to
            doc.text(application.transfer_to, 6.1, 8.475, align_center)

            // reason to transfer
            doc.text(application.transfer_reason, 4.5, 9.05, align_center)
        }

        // name
        doc.text(application.lastname, 2.25, 3.95, align_center) // lastname
        doc.text(application.firstname, 3.95, 3.95, align_center) // firstname
        doc.text(application.middlename || '', 6, 3.95, align_center) // middlename

        // address
        doc.text(application.barangay_name || '', 2.75, 4.5, align_center) // barangay
        doc.text(application.province, 5.2, 4.5, align_center) // province

        // other stuff
        let [bday_yy, bday_mm, bday_dd] = application.birthdate.split('-')
        doc.text(`${bday_mm}/${bday_dd}/${bday_yy}`, 2.3, 5.1, align_center) // date of birth
        doc.text(application.age + '', 3.58, 5.1, align_center) // age
        doc.text(application.marital_status[0].toUpperCase() + application.marital_status.substring(1), 6.1, 5.1, align_center) // marital status


        // set pdf to iframe
        document.querySelector('iframe').setAttribute('src', doc.output('datauristring'))
        doc.save(`${document.title}.pdf`)

        if (!!window.chrome) {
            alert("On Chromium-based browsers, PDF may fail rendering, instead it will be downloaded. If there is no downloaded PDF file, please contact the system administration.")
        }
    </script>
</body>

</html>

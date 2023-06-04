<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ສະແດງເອກະສານຂາເຂົ້າ</title>
    <script src="/assets/pspdfkit.js"></script>
</head>

<body>
    <div id="pspdfkit" style="height: 100vh"></div>



    <script>
        var locations = [
            @foreach ($doc_file as $article)
                ["{{ $article->file }}"],
            @endforeach
        ];

        PSPDFKit.load({
                container: "#pspdfkit",
                document: "/storage/doc_inbound/" + locations[0] // Add the path to your document here.
            })
            .then(function(instance) {
                

                console.log("PSPDFKit loaded", instance);
            })
            .catch(function(error) {
                console.error(error.message);
            });
    </script>



</body>

</html>

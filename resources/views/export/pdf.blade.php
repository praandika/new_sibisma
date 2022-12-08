<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDF</title>
</head>
<body>
    <p>A = <span id="a"></span></p>
    <script>
        function readPDF(){
            document.getElementById("a").innerHTML = localStorage.getItem("a");
        }
        window.onload=readPDF();
    </script>
    
</body>
</html>
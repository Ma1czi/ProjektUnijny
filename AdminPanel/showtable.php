<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/style.css">
    <link rel="stylesheet" href="../../Style/preview.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <title>ZSE-FormPage</title>
</head>
<body>
    <header>
        <div class="center">
            <div>
                <b style="font-size: 22px;">Zespół Szkół Elektronicznych</b><br>im.Stanisława Staszica w Zduńskiej Woli
            </div>
        </div>
    </header>
    <main>
    <div class="center">
            <div class="playground" style="margin-top: 30px;"> 
                <button onclick="print()">SDad</button>
            </div>
        </div>
        <div class="center">
            
            <div class="playground" style="margin-top: 30px;" id="tabletoprint"> 
                <?php
                    gettable();
                    ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="center">
            Copyright &copy; - Zespół Szkół Elektronicznych w Zduńskiej Woli <br> 
        </div>
    </footer>
</body>
<script src="../preview/script.js"></script>
</html>
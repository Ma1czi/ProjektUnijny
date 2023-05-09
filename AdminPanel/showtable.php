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
            <div class="playground" style="margin-top: 30px; position: relative; min-height: 32px"> 
                <div id="button">
                <button onclick="print()"><div class="printer"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" id="printer"><path d="M7,9.5c-0.8284302,0-1.5,0.6715698-1.5,1.5s0.6715698,1.5,1.5,1.5c0.828064-0.0009155,1.4990845-0.671936,1.5-1.5C8.5,10.1715698,7.8284302,9.5,7,9.5z M7,11.5c-0.276123,0-0.5-0.223877-0.5-0.5s0.223877-0.5,0.5-0.5c0.2759399,0.0005493,0.4994507,0.2240601,0.5,0.5C7.5,11.276123,7.276123,11.5,7,11.5z M19.5,6H18V2.5c0-0.0001831,0-0.0003662,0-0.0006104C17.9998169,2.2234497,17.776001,1.9998169,17.5,2h-11C6.4998169,2,6.4996338,2,6.4993896,2C6.2234497,2.0001831,5.9998169,2.223999,6,2.5V6H4.5C3.119812,6.0012817,2.0012817,7.119812,2,8.5V15c0.0018311,1.6561279,1.3438721,2.9981689,3,3h1v3.5c0,0.0001831,0,0.0003662,0,0.0005493C6.0001831,21.7765503,6.223999,22.0001831,6.5,22h11c0.0001831,0,0.0003662,0,0.0006104,0C17.7765503,21.9998169,18.0001831,21.776001,18,21.5V18h1c1.6561279-0.0018311,2.9981689-1.3438721,3-3V8.5C21.9987183,7.119812,20.880188,6.0012817,19.5,6z M7,3h10v3H7V3z M17,21H7v-6h10V21z M21,15c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-1v-2.5c0-0.0001831,0-0.0003662,0-0.0006104C17.9998169,14.2234497,17.776001,13.9998169,17.5,14h-11c-0.0001831,0-0.0003662,0-0.0006104,0C6.2234497,14.0001831,5.9998169,14.223999,6,14.5V17H5c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V8.5C3.0009155,7.671936,3.671936,7.0009155,4.5,7h2h11h0.0006104H19.5c0.828064,0.0009155,1.4990845,0.671936,1.5,1.5V15z"></path></svg></div></button>
                    <button onclick="back()"><div class="back"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="back-arrow"><g data-name="Layer 2"><g data-name="arrow-back"><rect width="24" height="24" opacity="0" transform="rotate(90 12 12)"></rect><path d="M19 11H7.14l3.63-4.36a1 1 0 1 0-1.54-1.28l-5 6a1.19 1.19 0 0 0-.09.15c0 .05 0 .08-.07.13A1 1 0 0 0 4 12a1 1 0 0 0 .07.36c0 .05 0 .08.07.13a1.19 1.19 0 0 0 .09.15l5 6A1 1 0 0 0 10 19a1 1 0 0 0 .64-.23 1 1 0 0 0 .13-1.41L7.14 13H19a1 1 0 0 0 0-2z"></path></g></g></svg></div></button>

                    </div>

            </div>
        </div>  
        <div class="playground" style="margin-top: 30px;" id="tabletoprint"> 
            <?php
                gettable();
                ?>
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
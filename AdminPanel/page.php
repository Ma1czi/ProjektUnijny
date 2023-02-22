<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <link rel="stylesheet" href="../Style/form.css">
    <title>ZSE-FormPage</title>
</head>
<body>
    <header>
        <div class="center">
            
                <b style="font-size: 22px;">Zespół Szkół Elektronicznych</b><br>im.Stanisława Staszica w Zduńskiej Woli
            
        </div>
    </header>
    <main>
        <div class="center">
            <div class="playground" style="margin-top: 30px;"> 
                <table>
                    <tr>
                        <th>Aktywne Formularze:</th>
                        <th>Zarządzaj Formularzami:</th>
                    </tr>
                    <?php
                        displayforms();
                    ?>
                </table>
                <br>
                <div id="plus">
                    <details>
                        <form action="modules/addform.php" method="post">
                            <label for="formname">Nazwa formularza: </label><input type="text" name="formname" id="formname">
                        </form>
                        <summary>
                               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11H13V5C13 4.44772 12.5523 4 12 4Z" fill="currentColor"/></svg>
                       </summary> 
                    </details>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="center">
            Copyright &copy; - Zespół Szkół Elektronicznych w Zduńskiej Woli <br> 
            
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
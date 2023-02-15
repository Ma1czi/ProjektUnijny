<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <link href='https://css.gg/trash.css' rel='stylesheet'>
    <link href='https://css.gg/notes.css' rel='stylesheet'>
    <link href='https://css.gg/math-plus.css' rel='stylesheet'>
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
                        displayformslist();
                    ?>
                </table>
                <br>
                <i class="gg-math-plus"></i>
                
                
            </div>
        </div>
    </main>
    <footer>
        <div class="center">
            Copyright &copy; - Zespół Szkół Elektronicznych w Zduńskiej Woli <br> 
            Projekt i wykonanie - <a href="https://ma1czi.github.io/MalcziPage/" target="_blank">Mikołaj Bulzacki</a>
        </div>
    </footer>
</body>
</html>
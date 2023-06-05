# Projekt Szkolny - Formularze Unijne
Praca oparta o interfejs bazodanowy wraz z systemem logowania, weryfikacją dla paneluAdmina.

## Cele:

- Stworzenie interfejsu dla użytkowników na którym będą mogli wypełnić wybrany formularz.
- Stworzenie interfejsu dla admina na którym będzie możliwość dodawania, usuwania, modifikacji i podglądu wybranych formularzy.
- Modyfikacja będzie obejmować opcje zmianny nazwy, dodawanie nowego pola, usunięcie wybranego pola.
- Podgląd będzie wyświetlać dla wybranego formularzu wszystkie wpisy z ich wartościami, oraz będzie zawierać możliwość pobrania tabeli w pliku pdf.

## Uwagi co do korzystania

- Serwer udostępniający aplikacje musi obsługiwać PHP oraz mySQL(Mariadb).
- Aplikacja została zaprojektowana z myśla pracy pod nastepujacym forkiem serwera MySQL: *[MariaDB](https://mariadb.com/)*.

## Konfiguracja
- Do połączenia się z Bazą danych trzeba skonfigurować plik: ../ConnDB/connDB.php 
- W folderze '../' muszą istnieć dwa foldery ("Form", "FormModify"). W przypda ich braku należy je dodać.

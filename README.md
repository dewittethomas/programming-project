# Programming Project
## Inhoudsopgave
- [Beschrijving](#beschrijving)
- [Functionaliteiten](#functionaliteiten)
    - [Voor gebruikers](#voor-gebruikers)
    - [Voor beheerders](#voor-beheerders)
- [Bronnenlijst](#bronnenlijst)
- [Licentie](#licentie)
## Beschrijving
Dit project betreft een uitleendienst voor het MediaLab van onze school Erasmushogeschool Brussel, voor het lenen verschillende soorten materiaal, waaronder hoofdtelefoons, camera's en meer. Het biedt zowel gebruikers als beheerders een scala aan functionaliteiten om het lenen en beheren van materiaal eenvoudig en efficiënt te maken.

## Functionaliteiten
### Voor Gebruikers:
- Productweergave: De gebruiker kan alle beschikbare producten bekijken. → `index.php`
- Zoeken en Filteren: De zoekfunctionaliteit stelt de gebruiker in staat om specifieke producten te vinden en te filteren op verschillende categorieën. → `index.php` + `search.php` + `categories.php`
- Artikel specifieke pagina: Gebruiker kan door op een artikel te klikken naar de pagina van dat specifieke artikel gaan. →`index.php`→ `artikel.php`
- Reserveren: De gebruiker kan vanuit de artikel specifieke pagina een artikel toevoegen aan zijn winkelwagen, hier selecteert hij de datum. → `artikel.php`
- Winkelwagen: De gebruiker kan zijn winkelwagen bekijken en van hieruit de reservatie van de artikelen definitief maken. → `winkelmand.php`
- Profiel : De gebruiker kan ten alle tijden zijn/haar profiel bekijken. Hier kan uitgelogd worden, of naar de reservaties pagina navigeren van de gebruiker.
- Reserveringen: De gebruiker kan zijn reserveringen en inleveringen bekijken, zodat deze ze kan ophalen of binnenbrengen op het afgesproken moment. `reservaties.php`

### Voor Beheerders:
- Reservatiebeheer: Beheerders hebben toegang tot een overzicht van alle reservaties en inleveringen. Deze kunnen ook verwijderd worden. Reservaties en inleveringen worden automatisch getoond en verwijderd. → `admin.php`
- Uitlenen en Terugnemen: Beheerders kunnen gebruikmaken van een scansysteem om materiaal uit te lenen en terug te nemen, waardoor een efficiënt beheer van de uitleendienst mogelijk is. → `scansysteem.php` + `scanning-system.php`
- Producten: Beheerders kunnen op een pagina alle producten zien, naar een bepaald product zoeken en deze hier ook verwijderen uit de catalogus.→ `admin-producten.php`
- Artikel toevoegen: Beheerders kunnen producten toevoegen aan de catalogus met onder meer een naam, categorie, subcategorie, beschrijving, foto, ... .→ `artikel-toevoegen.php`+ `add-article.php` + `subcategory.js`
- Blacklist-beheer: Beheerders kunnen een blacklist zien en hier personen afhalen.→ `blacklist.php`
- Waarschuwen: Beheerders kunnen personen handmatig waarschuwen bij het terugbrengen van beschadigd materiaal enz. Bij 2 waarschuwingen komen deze personen automatisch op de blacklist.→ `waarschuwen.php`
- Waarschuwingssysteem: Een geautomatiseerd waarschuwingssysteem waarschuwt gebruikers automatisch als ze een artikel te laat terugbrengen. Bij 2 waarschuwingen worden gebruikers automatisch op de blacklist geplaatst. →`admin.php`
### Andere functionaliteiten
- Het project geeft ook toegang tot belangrijke informatie via de 'Voorwaarden' en 'Contact' pagina's, waardoor gebruikers en beheerders een duidelijk beeld krijgen van de regels en contactmogelijkheden binnen de uitleendienst. →`voorwaarden.php`+`contact.php`
- Inloggen: Wanneer iemand inlogt, zal deze afhankelijk van zijn/haar rol, doorverwezen worden naar de gebruiker- of beheerder kant van de site. → `login.php` + `login-process.php`
- Session: Er wordt automatisch een sessie aangemaakt bij het inloggen, en beëindigd bij het uitloggen. → `session.php`+ `log-out.php`

Dit project streeft ernaar om een naadloze en gebruiksvriendelijke ervaring te bieden aan zowel gebruikers als beheerders, en is ontworpen om efficiëntie en transparantie te bevorderen bij het lenen en beheren van materiaal.

## Bronnenlijst
- [ChatGPT](https://chatgpt.com/share/d90fdfb8-c2e9-4b41-932e-318bc89263d5)
- [EHB](https://www.erasmushogeschool.be/nl/onderzoek/labs/medialab.brussels/medialab)
- [how to show all the products laravel-stackoverflow](https://stackoverflow.com/questions/75060963/how-to-show-all-the-products-laravel)
- [using css in laravel vieuws-stackoverflow](https://stackoverflow.com/questions/13433683/using-css-in-laravel-views)
- [add to array after button is pressed with session array-stackoverflow](https://stackoverflow.com/questions/48128802/add-to-array-after-button-is-pressed-with-session-array)
- [uploading a calendar record to my sql database-stackoverflow](https://stackoverflow.com/questions/19156833/uploading-a-calendar-record-to-a-mysql-database)
- [how can i install and configure an existing laravel project-stackoverflow](https://stackoverflow.com/questions/29083268/how-i-can-install-and-configure-an-existing-laravel-project-laravel-4)
- [how to assign multiple classes to an html container-stackoverflow](https://stackoverflow.com/questions/8722163/how-to-assign-multiple-classes-to-an-html-container)
- [equal sized table cells to fill the entire widt of the container table-stackoverflow](https://stackoverflow.com/questions/1457563/equal-sized-table-cells-to-fill-the-entire-width-of-the-containing-table)
- [change color of checkbox input in html php-stackoverflow](https://stackoverflow.com/questions/72957693/change-color-of-checkbox-input-in-html-php)
- [css to stop text wrapping under image-stackoverflow](https://stackoverflow.com/questions/11411219/css-to-stop-text-wrapping-under-image)
- [where do i get 3 horizontal lines symbol for my webpage-stackoverflow](https://stackoverflow.com/questions/34693811/where-do-i-get-a-3-horizontal-lines-symbol-for-my-webpage)
- [an error message with uploading image to my sql-stackoverflow](https://stackoverflow.com/questions/12124169/an-error-message-with-uploading-image-to-mysql)
- [ChatGPT](https://chatgpt.com/share/b841c78c-f4aa-441d-bafb-af428696698c)
- [php.net](https://www.php.net/manual/en/)
- [HTML-w3schools](https://www.w3schools.com/html/default.asp)
- [CSS-w3schools](https://www.w3schools.com/css/default.asp)
- [JavaScript-w3schools](https://www.w3schools.com/js/default.asp)
- [PHP-w3schools](https://www.w3schools.com/php/default.asp)
- [MySQL-w3schools](https://www.w3schools.com/mysql/default.asp)
- [HowTo-w3schools](https://www.w3schools.com/howto/default.asp)
- [GitHub CoPilot](https://github.com/features/copilot)

## Licentie
[MIT](https://github.com/dewittethomas/programming-project/blob/main/LICENSE)

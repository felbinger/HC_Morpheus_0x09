# Solution of [HC 0x09](https://hc.the-morpheus.de/0x09.php) from [The Morpheus Tutorials](https://the-morpheus.de)

1. versteckte Funktion zum Registrieren neuer Benutzer finden (Quellcode)
```html
<!-- This feature should be disabled -->
<div style="display:none !important;">
  <h2>User Registration</h2>
  <form method="post">
    Username: <input type="text" name="rusername" required></input></br>
    Password: <input type="text" name="rpassword" required></input></br>
    <input type="submit" name="register" value="Register"></input>
  </form>
</div>
```

2. neuen Benutzer registrieren
   - Methode 1: "display:none" entfernen und damit das Formular wieder sichtbar machen
   - Methode 2: mit curl einen POST request an die Seite senden. (siehe unten)

3. Cookie finden und dekodieren
Nach der Dekodierung der [URL](https://www.urldecoder.org) und [Base64](https://www.base64decode.org) Kodierung erhält man einen JSON String.


4. Parameter (im JSON String) verändern
 - isAdmin: true
 - hash: ?
   - Genutzte Hash-Funktion (md5) erkennen
   - Genutzte Reihenfolge der Parameter erkennen und neuen md5 String erstellen (https://www.md5-generator.de)
     Die richtige Reihenfolge ist: (username,password,isAdmin)

5. Cookie speichern und wieder kodieren
 - JSON String in base64 kodieren (https://www.base64encode.org)
 - URL Kodierung durchführen (https://www.urlencoder.org)
 - Kodierten String als Cookie setzen
   - Browser: document.cookie = "session=Base64String"
   - Terminal:
     - ```curl -X POST -c cookie.txt localhost/challenge.php -d "register&rusername=USER&lpassword=PASSWD"```
     - ```curl -X POST -b cookie.txt localhost/challenge.php -d "login&lusername=USER&lpassword=PASSWD"```

1. Find hidden feature (in the source code) to register a new user
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

2. Registrate a new user
   - Method 1: delete "display:none" to show the formular for registrations
   - Method 2: using curl to send a post request to the php site

3. Find the cookie with the key "session"
 - decode the url encoding (https://www.urldecoder.org)
 - decode the base64 encoding (https://www.base64decode.org)

after decoding you will get a json string

4. Modify parameter in the json string
 - isAdmin: true
 - hash: ?
   - recognize used hash function (md5)
   - recognize parameter sequenz and create an md5 string (https://www.md5-generator.de)
     The right parameter sequenz is: (username,password,isAdmin)

5. Replace the cookie on the site
 - encode the json string back to base64 (https://www.base64encode.org)
 - URL encode the base64 encoded string (https://www.urlencoder.org)
 - set the new string as cookie
   - in the browser: document.cookie = "session=base64String"
   - or in the terminal using curl:
     - ```curl -X POST -c cookie.txt localhost/challenge.php -d "register&rusername=USER&lpassword=PASSWD"```
     - ```curl -X POST -b cookie.txt localhost/challenge.php -d "login&lusername=USER&lpassword=PASSWD"```

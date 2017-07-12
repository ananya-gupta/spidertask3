# spidertask3
online travel diary

used XAMPP.
Can be downloaded from - https://www.apachefriends.org/download.html
language used for backend -PHP.

servername = "localhost";
username = "ananya";
password = "1234";
datasasename = "spider";

how to login for the first time-
email-ag9111998@gmail.com
password-ananya

Build in instructions-
First of all, set your own server by using XAMPP.
Create new database and create new tables in it.
then choose tempales online and use them in ur pages.
details of different pages to be creeated are as follows-

(1)config- this page contains all the backend code for making a connection to our server.

(2)registration- when ever a new user enters, he/she is redirected to this page. Using this page, he/she can create new account and register themself on this website. it cantains a form which contains various input boxes and a submit button.

(3)Login- it matches the entered email and password with all the registrations. if a entry matches, this page will direct you to the new journal page, otherwise you will be directed to registration page. 

(4)loginc- it contains all the backend codes of login page. it uses select query to select users from database. it sets session variables which will be used throught out the session on different pages until user logs out.

(5)newjournal- when a user logs in , it is directed to this page. it contain a bar which have button to go to public journal page and also have a button to log out. it also contains a map and a geocoder for which geo coding API is used. the map shows all the journals of the user. this page also contains a form to submit new journal to database. AJAX is used, so that no refreshing occurs.

(6)setlocation- it contains php code which are run when location is set using goe code API. through AJAX, page is directed to this page and this page contains an INSERT query to insert location into database.

(7)setjournal- it contains php code which are run when a new journal is set using goe code API. through AJAX, page is directed to this page and this page contains an UPDATE query to UPDATE database according to the location set.

(8)journals- it contain a bar which have button to go to public journal page and also have a button to log out.it contains a map for which google road map API is used. it also contains a "show journal" button. when this button is pressed, all the journals having type = public are shown. 

(9)logout- this page contains backend codes to log out by destroying session.

used bootstrap template for styling of the pages.

table used for storing all the registration = "registration"
![registrationtable](/screenshots/registrationtable.jpg?raw=true "registrationtable")

table used for storing all the journals = "journals"
![journaltable](/screenshots/journaltable.jpg?raw=true "journaltable")

![registration](/screenshots/registration.jpg?raw=true "registration")
The above is the screenshot of the "registration" page.
when ever a new user enters, he/she is redirected to this page. Using this page, he/she can create new account and register themself on this website.
link to access this page-http://localhost/spidertask2/registration.php

![login](/screenshots/login.jpg?raw=true "login")
The above is the screenshot of "login" page.
after creating account, user can use this page to log in to the web site.
After logging in, user will be directed to newjournal page.
link to access this page-http://localhost/spidertask2/login.php

![newjournal](/screenshots/newjournal1.jpg?raw=true "newjournal")
![newjournal](/screenshots/newjournal2.jpg?raw=true "newjournal")
The above are the screenshots of new journal page.
using this page, user can add new journals and share his/her experience.
link to access this page-http://localhost/spidertask2/newjournal.php

![publicjournal](/screenshots/publicjournal.jpg?raw=true "publicjournal")
The above is the screenshot of publicjournal page.
on this page, users can see all the journals, whose type is public
link to access this page-http://localhost/spidertask2/journals.php

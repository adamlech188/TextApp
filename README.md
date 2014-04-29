This a TextApp ,a mobile web based application  that allows users to collect information about number of cars whose drivers are manipulating  mobile devices. For more information how to use it please check: 

http://textcar.adamlech.info/Instructions/ 

MODEL VIEW CONTROLLER. 
In this application I was following the Model View Controller pattern, although not entirely consistently. 

Control folder: 
Contains the Javascript files (.js) that manipulate user input and sends requests to server. 
Ajax is use.. 

View folder: 
Contains main website that displays user interface (login_page.php and index.php) view. This is where user inputs data. 
JQuery and JQuery mobile framework were used to create this interface. Also style sheet is included. 
Scripts that process user log out request are  included(logout.php). 

Data folder: 
Contains PHP script (save_data.php) that process data to database located on remote server.Opens connection to database and contains simple MySql statements.

Instruction folder: 
Contains html document to display information about how to use app. 

Records folder: 
Contains administrator's website folders. 

Library folder: 
Contains script that enables user to store data temporarily on browser, in case browser does not support localstorage functionality. 
Also contains following libraries necessary for running app. 
>JQuery (http://jquery.com/download/, CDN repository //code.jquery.com/jquery-1.11.0.min.js, "//code.jquery.com/jquery-migrate-1.2.1.min.js") 
>JQuery Mobile (http://jquerymobile.com/download/, CDN repository http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.2/jquery.mobile.css , http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.2/jquery.mobile.js) 
>JQuery UI (http://jqueryui.com/download/) 



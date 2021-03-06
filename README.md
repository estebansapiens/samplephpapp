# Sample PHP Web App

This project contains a sample Application created as an open source project that can be used to create simple systems that depend on custom login functionality and database logging.


+ Setup instructions:

  1. Pull the files locally to any web-accessible sub-folder such as the Apache htdocs.
  2. Open phpMyAdmin and create a database for the data related to the App along with a User and Password for the database.
  3. Restore the .sql located in the "sql" folder called studio7data.sql to the newly created database.
  4. Open the configuration file (classes/config.php) and define the system configurations for the App (details and database information)
  5. Browse to the directory where the App has been set up and if the aforementioned steps were done correctly the Login should load.


+ Page composition:

When a request is done to this App index (page load or POST/GET requests) the index.php is called which builds up the PHP classes via includes and then processes the Page Code which gets generated in the PageControlHandler class inside Classes folder.

The first thing that gets loaded is the configurations (which initializes the connection to the mysql database) that contain an array of website details and also a public variable containing the connector for executing mysqli queries (secured PDO version of mysql).

After connecting to the database, the SystemMainControl class is initialized which contains a logging functionality for creating records on the database for any kind of action used by other classes.

Then the SystemSessionHandler gets initialized which checks if there is an existing session and also validates session against database users. The Authentication process can be changed from this class (classes/session.php) by overriding the username/password validation with any other system like external authentication or OAUTH protocols.

Once the Session data is generated, the PageControlHandle is initialized which checks what page is being requested and pulls it from the views folder. If the user tries to go to a page which exists but is not authenticated, then the login is loaded instead by this control.

Finally (for the preprocessing) the request is checked to see if it corresponds to an AJAX call, and if it matches an AJAX call then it returns the content section generated instead of the full page body.

Once the preprocessing is done, the HTML structure is generated by using structure elements found in the "sections" folder (header, menu, footer) and the code which was generated by the PageControlHandle.


+ Page creation

In order to create a page we must create the content for it in the views directory with the name of the page we want it to have.

+ Dependencies

  1. Apache
  2. phpMyAdmin (o mySQL Workbench)

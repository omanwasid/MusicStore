# MusicStore
Online Music store where customers can buy the tracks.
user Name: customer
password: customer
The application will implement two different logins: - An administrative login whose hashed password is in the ‘admin’ table (it is ‘admin’). The administrator will be able to do the following: 
o Create, read, update and delete artists, albums, and tracks - A user login based on the customer table. The hashed password of all existing customers is ‘customer’. 
Users will be able to do the following: o Browse tracks, albums and artists o Buy tracks, with the possibility of selecting several tracks into a cart for later purchase.
 ▪ When the user decides to make the purchase effective, an invoice is automatically generated with the non-editable total monetary amount automatically calculated
 ▪ The customer can introduce a billing address that differs from the customer address, but the customer address will be offered as default billing address 
o Sign up, so that they are created as a new customer o Edit their own customer data, including changing their password Please note that, due to referential integrity constraints in the database, it is not possible to delete customers with current purchases, or tracks that have been purchased, or artists with albums.  The application’s architecture will be divided into a backend that will serve database information in a RESTful API and a frontend that will consume it via Ajax.The application will implement security measures against SQL injection, XSS and CSRF. The application and the database will be deployed to AWS Educate account. 
Tools allowed: • HTML5, CSS3, JavaScript, jQuery, Ajax, PHP, MySQL/MariaDB.

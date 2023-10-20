<?php
// Set it to true when you will upload this website on cpanel
config::debug(false);

// Set database 
config::DBHost("localhost");
config::DBUsername("root");
config::DBPassword("");
config::DBName("qb");
config::DBConnect();

// Listing limit
config::DBSetLimit(5);

// Set timezone
config::setTimeZone("Asia/Karachi");

// Set url
config::setUrl("http://localhost/question_bank/");


// School information
config::setSchoolName("Al-Noor Innovator School");
config::setSchoolTagline("A TRADITION OF EXCELLENCE");


// set session
config::session(true);


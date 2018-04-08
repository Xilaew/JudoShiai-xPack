<?php
/* In which year will the competition take place.
This is necessary information to calculate the contestants age and determine 
which category they will compete in.*/
$yearOfTournament=2018;
/* The minimum and maximum yearOfBirth for competitors.
Input will be validated against these boundaries and hopefully nobody will try 
to enter a way to young or old competitor.*/
$minYearOfBirth=1980;
$maxYearOfBirth=2006;
/* Filenames of different config files.
The registration website reads information such as Tournament name and Date as 
well as category definitions from a JudoShiai file. For the clubs options the 
clubs.txt file as utilised by JudoShiais autocomplete feature is used. See 
JudoShiai docu for more information on clubs.txt. dataCsv is the name of the 
file where the registrations shall be stored in csv format. */
$judoShiaiTemplateFile='template.shi';
$clubsTxt='clubs.txt';
$dataCsv='data.csv';
/* For internationalisation you can set the default locale to use when nothing
else is requested by the user.*/
$defaultLocale="de_DE";
$forceRegistration=true
?>
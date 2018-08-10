<?php
/* Date of the Tournament.
This is necessary information to calculate the contestants age and determine
which category they will compete in. Further this information is used to
automatically disable registration after the Tournament began */
$dateOfTournament='25.08.2018';
/* Registration closing date and how to handle late registrations
Typically you close registration a few days before the Turnament, but that does
not keep some people from registering late.
You have the following options to Handle late registrations:
'reject' will not allow any further registrations after closing.
'warn' will prominently show a warning banner and mark late registrations as such in the database.
'allow' will simply accept late registrations. */
$registrationClosingDate='17.08.2018';
$lateRegistrationHandling='warn';
/* The minimum and maximum yearOfBirth for competitors.
Input will be validated against these boundaries and hopefully nobody will try
to enter a way to young or to old competitor. */
$minYearOfBirth=1980;
$maxYearOfBirth=2006;
/* Filenames of different config files.
The registration website reads information such as Tournament name and 
Description as well as category definitions from a JudoShiai file. For the clubs
options the clubs.txt file as utilised by JudoShiais autocomplete feature is
used. See JudoShiai docu for more information on clubs.txt. dataCsv is the name
of the file where the registrations shall be stored in csv format. */
$judoShiaiTemplateFile='template.shi';
$clubsTxt='clubs.txt';
$dataCsv='data.csv';
/* For internationalisation you can set the default locale to use when nothing
else is requested by the user. */
$defaultLocale="de_DE";
/* If you want to communicate with the registering coaches you need their email
address. Set forceRegistration to true if you want to enforce the coaches to 
create a Coach Id with their email address. */
$forceRegistration=false;
/* For official tournaments you only invite clubs within the league. So you can
list all clubs in the ClubsTxt and only those clubs may register Competitors.
For open tournaments you want the invitation to spread wide and do not know
in advance from where Fighters might be registert. In this case you want to
allow people to enter custom club names. */
$allowCustomClub=false;
/* Disable Registration and show permanent error Message.
Sometimes you want to manually disable registration for whatever reason.
e.g the Tournament got canceled, you see to much spam and want contestents to
register by other means. In this case set disabled to true and put whatever you
want potential visitors to know in the disabledErrorMessage. */
$disabled=false;
$disabledErrorMessage='The Turnament got canceled due to way too little'
        . 'prospective competitors';
?>
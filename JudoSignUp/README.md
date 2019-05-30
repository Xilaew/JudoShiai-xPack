# What is JudoSignUp
JudoSignUp is an easy to use, flexible, mobile friendly competitor registration website for Judo tournaments. You can host it on any webhosting platform with php support, even free hosters are available. Competitors can register for your tournament. The entered registration data is stored in coma separated value (CSV) format which can be easily imported by [JudoShiai](http://www.judoshiai.fi/index-en.php). Tournament information as well as the configured weight and age categories for the tournament can be read form the JudoShiai file format.
You can see a live demo of this website on [http://xilaew.bplaced.net/JudoSignUp/](http://xilaew.bplaced.net/JudoSignUp/?lang=en_US).
# How to Install
Download the [JudoSignUp-1.0.0.zip](https://github.com/Xilaew/JudoShiai-xPack/releases/download/v1.0.0/JudoSignUp-1.0.0.zip) file from the [releases](https://github.com/Xilaew/JudoShiai-xPack/releases) page and unpack it on your php enabled webspace. Next you should edit the config.php file in order to tailer the website to your needs. All available options are well documented by the comments. Then you should prepare a JudoShiai Tournament file with JudoShiai, where you configure the Name, Date and Place of the Tournament, as well as the age and weight categories the competitors shall be registered for.
Now your registration website is up and running, you can include the URL into your annoncement. After registration closing you can download all competitor dats in CSV format from `[url of your registration page]/data.csv`
# List of Free Hosters
On the following free webhosting platforms the JudoSignUp webpage is known to work correctly:
* [https://www.bplaced.net/](https://www.bplaced.net/)

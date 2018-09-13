#!/bin/sh

echo 'judoshiai:*:100:100:judoshiai:/var/turnierinfo:/bin/false' >> /etc/passwd
echo 'judoshiai::0:0:99999:7:::' >> /etc/shadow

chmod 755 /etc/init.d/turnierinfo
/etc/init.d/turnierinfo enable
reboot
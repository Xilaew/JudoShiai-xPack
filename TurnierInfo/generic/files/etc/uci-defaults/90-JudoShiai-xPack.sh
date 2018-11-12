#!/bin/sh
# this script is based on few assumptions:
# 1: If a VLAN enabld switch is installed, then the switch_vlan[0] is the switch_vlan for lan
# 3: The script will only be executed once on a newly installed openwrt router

PUBLIC_VLAN_ID=7
HOSTNAME="turnierinfo"
. /lib/judoshiai_functions.sh

# BASIC NETWORK
configure_lan
add_public_network
#uncomment the next two lines to add the public network as vlan onto the lan ports
#TODO find a way to enable this easy on demand by the user afterwards.
#add_vlan ${PUBLIC_VLAN_ID}
#add_switch_vlan ${PUBLIC_VLAN_ID}
configure_wifi

# NETWORK
echo '#set hostname'
uci set system.@system[0].hostname="${HOSTNAME}"

add_public_firewall_zone
add_redirect_public_http_firwall_rule
add_drop_public2lan_firewall_rule

configure_dhcp
configure_dns

# SERVICES
configure_admin_httpd
configure_turnierinfo_httpd
configure_vsftpd
enable_turnierinfo_service

echo '#configure dropbear ssh to only listen on lan'
uci set dropbear.@dropbear[0].Interface='lan'
#TODO set root password to 1234 to enable ssh

# COMMIT
uci commit


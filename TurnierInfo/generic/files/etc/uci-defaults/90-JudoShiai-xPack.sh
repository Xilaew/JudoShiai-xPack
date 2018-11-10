#!/bin/sh
# this script is based on few assumptions:
# 1: If a VLAN enabld switch is installed, then the switch_vlan[0] is the switch_vlan for lan
# 3: The script will only be executed once on a newly installed openwrt router

PUBLIC_VLAN_ID=7
HOSTNAME="turnierinfo"

function configure_lan ()
{
	uci del network.lan.ipaddr
	uci add_list network.lan.ipaddr=192.168.1.1/24
	uci add_list network.lan.ipaddr=192.168.1.2/24
}

function add_public_network ()
{
	local tmp=`uci add network interface`
	uci rename network.$tmp='public'
	uci set network.public.type='bridge'
	uci set network.public.proto='static'
	uci add_list network.public.ipaddr='10.42.0.1/16'
	
	local lan_interface=`uci get network.lan.ifname`
	lan_interface=${lan_interface%%.*}
	echo ${lan_interface}
	uci set network.public.ifname="${lan_interface}.${PUBLIC_VLAN_ID}"
}

function add_switch_vlan ()
{
	local switch_name
	if switch_name=`uci get network.@switch[0].name` && [ `uci get network.@switch[0].enable_vlan` == "1" ]; then
		echo '#add public vlan for distribution of public network between multiple Access Points'
		local tmp=`uci add network switch_vlan`
		uci rename network.$tmp='public_vlan'
		uci set network.public_vlan.device=$switch_name
		uci set network.public_vlan.vlan='7'
		local ports=`uci get network.@switch_vlan[0].ports`
		local ports_new=""
		for p in $ports; do
			ports_new="${ports_new}${p%t}t "
		done
		uci set network.public_vlan.ports="${ports_new}"
	fi
}

function configure_wifi ()
{
	local i=0
	while uci rename wireless.@wifi-device[${i}]="radio${i}"; do
		echo "#configure wireless SSIDs on radio${i}"
		#reconfigure default wifi
		uci rename wireless.@wifi-iface[${i}]="judoshiai${i}"
		uci set wireless.@wifi-iface[${i}].device="radio${i}"
		uci set wireless.@wifi-iface[${i}].ssid='judoshiai'
		uci set wireless.@wifi-iface[${i}].hidden='1'
		uci set wireless.@wifi-iface[${i}].encryption='psk2'
		uci set wireless.@wifi-iface[${i}].key='IchBinKampfrichter'

		#add public wifi
		local tmp=`uci add wireless wifi-iface`
		uci rename wireless.$tmp="public${i}"
		uci set wireless.public${i}.device="radio${i}"
		uci set wireless.public${i}.mode='ap'
		uci set wireless.public${i}.encryption='none'
		uci set wireless.public${i}.ssid='turnierinfo'
		uci set wireless.public${i}.network='public'

		echo "#turn on wifi-iface[0] aka \"radio0\""
		uci del wireless.@wifi-device[${i}].disabled

		i=$((i+1))
	done
}

echo '###############################################################################'
echo '# BASIC NETWORK                                                               #'
echo '###############################################################################'
configure_lan
add_public_network
add_switch_vlan
configure_wifi

echo '###############################################################################'
echo '# NETWORK                                                                     #'
echo '###############################################################################'
echo '#set hostname'
uci set system.@system[0].hostname="${HOSTNAME}"

echo '#create firewall zone'
uci add firewall zone
uci set firewall.@zone[-1].name='public'
uci add_list firewall.@zone[-1].network='public'
uci set firewall.@zone[-1].input='ACCEPT'
uci set firewall.@zone[-1].output='ACCEPT'
uci set firewall.@zone[-1].forward='REJECT'

echo '#redirect any http traffic from public network to local http server'
#TODO check for correctnes.
uci add firewall redirect
uci set firewall.@redirect[-1].name='Redirect-public-HTTP'
uci set firewall.@redirect[-1].src='public'
uci set firewall.@redirect[-1].proto='tcp'
uci set firewall.@redirect[-1].src_dport='80'
uci set firewall.@redirect[-1].dest_ip='10.42.0.1'
echo '#block any incomming traffic from public network to lan ipaddresses'
uci add firewall rule
uci set firewall.@redirect[-1].name='Drop-public-lan-Input'
uci set firewall.@rule[-1].src='public'
uci set firewall.@rule[-1].dest_ip='192.168.1.0/24'
uci set firewall.@rule[-1].target='DROP'

echo '#configure dhcp'
#increase limit of leases
uci set dhcp.@dnsmasq[0].dhcpeasemax='2000'
#add iprange for lease on public network
tmp=`uci add dhcp dhcp`
uci rename dhcp.$tmp='public'
uci set dhcp.public.start='100'
uci set dhcp.public.leasetime='3h'
uci set dhcp.public.interface='public'
uci set dhcp.public.limit='2000'
uci set dhcp.public.dhcpv6='server'
uci set dhcp.public.ra='server'

echo '#add admin.turnierinfo.lan Domain'
uci add dhcp domain
uci set dhcp.@domain[-1].name='admin.turnierinfo.lan'
uci set dhcp.@domain[-1].ip='192.168.1.2'

echo '#add dns catchall'
echo 'address=/#/10.42.0.1' >> /etc/dnsmasq.conf

echo '###############################################################################'
echo '# SERVICES                                                                    #'
echo '###############################################################################'
echo '#configure uhttpd main instance to listen only on local ip address'
uci del uhttpd.main.listen_http
uci del uhttpd.main.listen_https
uci add_list uhttpd.main.listen_http='192.168.1.2:80'
uci add_list uhttpd.main.listen_https='192.168.1.2:443'

echo '#configure uhttpd turnierinfo instance to serve judoshiai website'
turnierinfo=`uci add uhttpd uhttpd`
uci rename uhttpd.$turnierinfo='turnierinfo'
uci add_list uhttpd.turnierinfo.listen_http='10.42.0.1:80'
uci add_list uhttpd.turnierinfo.listen_http='192.168.1.1:80'
uci add_list uhttpd.turnierinfo.listen_https='10.42.0.1:443'
uci add_list uhttpd.turnierinfo.listen_https='192.168.1.1:443'
uci set uhttpd.turnierinfo.home='/tmp/turnierinfo'
uci set uhttpd.turnierinfo.error_page='/error.html'

echo '#enable turnierinfo Service'
#turnierinfo service creates temporary directory /tmp/turnierinfo on every boot
chmod 755 /etc/init.d/turnierinfo
/etc/init.d/turnierinfo enable

echo '#configure dropbear ssh to only listen on lan'
uci set dropbear.@dropbear[0].Interface='lan'

echo '#configure vsftpd'
#TODO stop vsftpd from binding to any interface, should be lan only
#create user judoshiai with empty string as password
echo 'judoshiai:x:142:142:judoshiai:/tmp/turnierinfo:/bin/false' >> /etc/passwd
echo 'judoshiai:x:142:' >> /etc/group
echo 'judoshiai:$1$y36WrFY7$/psY2cByxRLCXsVHF7rvD.:17797:0:99999:7:::' >> /etc/shadow

#TODO set root password to 1234 to enable ssh

echo '###############################################################################'
echo '# COMMIT AND REBOOT                                                           #'
echo '###############################################################################'
uci commit


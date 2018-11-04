# What is TurnierInfo
TurnierInfo is a custom openWRT based firmware for your WLAN router. With this firmware image installed, your router will provide two securely separeted networks:
* one for the public audience with a Captive Portal where guests can download all information provided by [JudoShiai](http://www.judoshiai.fi/index-en.php).
* another network for communication of the different JudoShiai programms (JudoWeight, JudoTimer ...) among each other.

Further it contains a preconfigured Webserver and FTP-server, to upload and host the JudoShiai webcontent directly on the router, so you do not need to set up a webserver yourself.
# How to Install
See [openWRT installation instructions via OEM Firmware](https://openwrt.org/docs/guide-user/installation/generic.flashing#method_1via_oem_firmware) for more info about how to install openWRT images on your router.
Currently 2 router models are supported by TurnierInfo, support for most devices with openWRT support is expected to be added soon.
# Supported Devices
[TP-Link TL-WR1043ND](https://openwrt.org/toh/tp-link/tl-wr1043nd)  
[TP-Link Archer C7 AC1750](https://openwrt.org/toh/tp-link/archer-c7-1750)

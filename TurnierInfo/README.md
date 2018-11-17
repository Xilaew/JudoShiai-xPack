# What is TurnierInfo
TurnierInfo makes it easy to setup the Network for a Judo Tournament with JudoShiai. With TurnierInfo everything you need to publish tournament results live in a local WiFi network is included inside a WiFi Router. And you do not need to worry about any network details, everything is secure and easy to use.

TurnierInfo provides two securely separeted WiFi networks:

* one for the public audience with a Captive Portal where guests can download all information provided by [JudoShiai](http://www.judoshiai.fi/index-en.php).
* another network for communication of the different JudoShiai programms (JudoWeight, JudoTimer ...) among each other, from this network JudoShiai can upload the results via ftp.

# How to Install
On many WiFi Routers/AccessPoints you can simply install a custom firmware image via the routers configuration website. Often this function is hidden under Advanvced, System or similarly named menu entries.

See [openWRT installation instructions via OEM Firmware](https://openwrt.org/docs/guide-user/installation/generic.flashing#method_1via_oem_firmware) for more info about how to install openWRT images on your router.

# Tested Devices
Since TurnierInfo Router Firmware is OpenWRT based all devices Supported by openWRT are supported by TurnierInfo. For the sake of testing the following devices are explicitly tested and confirmed to work without any quirks. If you have any other WiFi Router/AccessPoint model please check the [OpenWRT Table of Hardware](https://openwrt.org/toh/start?dataflt%5B0%5D=supported%20current%20rel_%3D18.06.1) wether it is supported by the current OpenWRT release. If Yes, you should look in the [Release Download Folder](https://drive.google.com/drive/folders/1wYkKo8YWp7PzV1h_YngpsM0xW7-nsOsU?usp=sharing) for a ready built TurnierInfo firmware image for your router.

Brand | Model | Version | OpenWRT Device Page | TurnierInfo Firmware Image
--- | --- | --- | --- | ---
TP-Link | WR1043N(D) | 1.x | [TP-Link TL-WR1043ND](https://openwrt.org/toh/tp-link/tl-wr1043nd) | [https://drive.google.com/file/d/1Ub9yEyrrYBdpsLnabhPn2-Lx08AqQlEU/view?usp=sharing](https://drive.google.com/file/d/1Ub9yEyrrYBdpsLnabhPn2-Lx08AqQlEU/view?usp=sharing)
TP-Link | WR1043N(D) | 2.x | [TP-Link TL-WR1043ND](https://openwrt.org/toh/tp-link/tl-wr1043nd) | [https://drive.google.com/file/d/1Ub9yEyrrYBdpsLnabhPn2-Lx08AqQlEU/view?usp=sharing](https://drive.google.com/file/d/1Ub9yEyrrYBdpsLnabhPn2-Lx08AqQlEU/view?usp=sharing)
TP-Link | Archer C7 | 2.x | [TP-Link Archer C7 AC1750](https://openwrt.org/toh/tp-link/archer-c7-1750) | [https://drive.google.com/file/d/1a4ZZ-o0xwQ0Q27jMYKNapmXKgTZeBoi_/view?usp=sharing](https://drive.google.com/file/d/1a4ZZ-o0xwQ0Q27jMYKNapmXKgTZeBoi_/view?usp=sharing)
TP-Link | Archer C60 | 2.x | [TP-Link Archer C60](https://openwrt.org/toh/hwdata/tp-link/tp-link_archer_c60_v2) | [https://drive.google.com/file/d/1OXyMqSw7qBxpnMvth10IgeoLkDxmN4pJ/view?usp=sharing](https://drive.google.com/file/d/1OXyMqSw7qBxpnMvth10IgeoLkDxmN4pJ/view?usp=sharing)


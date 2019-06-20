# How to Install

In order to turn your WiFi Device into a TurnierInfo Router you first need to identify and download the appropriate TurnierInfo firmware image for your device and then install it onto your device.

## Find Firmware Image

for a selection of tested devices prebuild images are provided in the [github releases](https://github.com/Xilaew/JudoShiai-xPack/releases).
If you have any other WiFi Router/AccessPoint model except those mentioned in the section "Tested Devices" please check the [OpenWRT Table of Hardware](https://openwrt.org/toh/start?dataflt%5B0%5D=supported%20current%20rel_%3D18.06.1) wether it is supported by the current OpenWRT release. If Yes, you can eighter [build the image yourslef](./build.md), or concact me via the email address in my github profile. I am always happy to hear from someone willing to test a prebuild image on another Device.

## Install

### The Easy Way

On many WiFi Routers/AccessPoints you can simply install a custom firmware image via the routers configuration website. Often this function is hidden under Advanvced, System or similarly named menu entries.

### A little more complicated

See [openWRT installation instructions via OEM Firmware](https://openwrt.org/docs/guide-user/installation/generic.flashing#method_1via_oem_firmware) for more info about how to install openWRT images on your router.

# Tested Devices

Since TurnierInfo Router Firmware is OpenWRT based all devices Supported by openWRT are supported by TurnierInfo. For the sake of testing the following devices are explicitly tested and confirmed to work without any quirks.

Brand | Model | Version | OpenWRT Device Page | TurnierInfo Firmware Image
--- | --- | --- | --- | ---
TP-Link | WR841N(D) | 7.x | [TP-Link TL-WR841ND](https://openwrt.org/toh/tp-link/tl-wr841nd) | [openwrt-18.06.1-turnierinfo-ar71xx-tiny-tl-wr841-v7-squashfs-factory.bin](https://github.com/Xilaew/JudoShiai-xPack/releases/download/v1.0.1/openwrt-18.06.1-turnierinfo-ar71xx-tiny-tl-wr841-v7-squashfs-factory.bin)
TP-Link | WR1043N(D) | 1.x | [TP-Link TL-WR1043ND](https://openwrt.org/toh/tp-link/tl-wr1043nd) | [openwrt-18.06.1-turnierinfo-ar71xx-generic-tl-wr1043nd-v1-squashfs-factory.bin](https://github.com/Xilaew/JudoShiai-xPack/releases/download/v1.0.1/openwrt-18.06.1-turnierinfo-ar71xx-generic-tl-wr1043nd-v1-squashfs-factory.bin)
TP-Link | WR1043N(D) | 2.x | [TP-Link TL-WR1043ND](https://openwrt.org/toh/tp-link/tl-wr1043nd) | [openwrt-18.06.1-turnierinfo-ar71xx-generic-tl-wr1043nd-v2-squashfs-factory.bin](https://github.com/Xilaew/JudoShiai-xPack/releases/download/v1.0.1/openwrt-18.06.1-turnierinfo-ar71xx-generic-tl-wr1043nd-v2-squashfs-factory.bin)
TP-Link | Archer C7 | 2.x | [TP-Link Archer C7 AC1750](https://openwrt.org/toh/tp-link/archer-c7-1750) | [openwrt-18.06.1-turnierinfo-ar71xx-generic-archer-c7-v2-squashfs-factory-eu.bin](https://github.com/Xilaew/JudoShiai-xPack/releases/download/v1.0.1/openwrt-18.06.1-turnierinfo-ar71xx-generic-archer-c7-v2-squashfs-factory-eu.bin)
TP-Link | Archer C60 | 2.x | [TP-Link Archer C60](https://openwrt.org/toh/hwdata/tp-link/tp-link_archer_c60_v2) | [openwrt-18.06.1-turnierinfo-ar71xx-generic-archer-c60-v2-squashfs-factory.bin](https://github.com/Xilaew/JudoShiai-xPack/releases/download/v1.0.1/openwrt-18.06.1-turnierinfo-ar71xx-generic-archer-c60-v2-squashfs-factory.bin)

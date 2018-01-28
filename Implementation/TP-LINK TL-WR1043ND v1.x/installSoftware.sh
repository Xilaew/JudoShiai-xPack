#!/bin/sh

opkg update

# HTTP Server
opkg install lighttpd lighttpd-mod-redirect

# FTP Server
opkg install pure-ftpd

# USB storage Support
opkg install kmod-usb-storage block-mount block-hotplug
# Suported File Systems
opkg install kmod-fs-ext4 kmod-fs-vfat kmod-fs-ntfs kmod-fs-msdos
# Additionally needed Files for FAT32 Mounting
opkg install kmod-nls-cp437 kmod-nls-iso8859-1
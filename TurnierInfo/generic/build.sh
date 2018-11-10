#!/bin/bash
IMAGEBUILDER_FILENAME="openwrt-imagebuilder-18.06.1-ar71xx-generic.Linux-x86_64.tar.xz"
IMAGEBUILDER="openwrt-imagebuilder-18.06.1-ar71xx-generic.Linux-x86_64"
IMAGEBUILDER_URL="https://downloads.openwrt.org/releases/18.06.1/targets/ar71xx/generic/openwrt-imagebuilder-18.06.1-ar71xx-generic.Linux-x86_64.tar.xz"
if [ ! -d "${IMAGEBUILDER}" ]; then
  wget "${IMAGEBUILDER_URL}"
  tar --xz -xf "${IMAGEBUILDER_FILENAME}"
fi
cp -r files ${IMAGEBUILDER}/
cd "${IMAGEBUILDER}"
make info
make image PROFILE="tl-wr1043nd-v1" PACKAGES="vsftpd luci" FILES="files/"
make image PROFILE="tl-wr1043nd-v2" PACKAGES="vsftpd luci" FILES="files/"
make image PROFILE="archer-c7-v2" PACKAGES="vsftpd luci" FILES="files/"
make image PROFILE="archer-c60-v2" PACKAGES="vsftpd luci" FILES="files/"

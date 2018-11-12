OPENWRT_VERSION := 18.06.1
ar71xx_target_profiles := tl-wr1043nd-v1 tl-wr1043nd-v2 archer-c7-v2 archer-c60-v2
ar71xx_targets := $(foreach target,$(ar71xx_target_profiles),release/ar71xx/generic/openwrt-$(OPENWRT_VERSION)-turnierinfo-ar71xx-generic-$(target)-squashfs-factory.bin)
files := files/etc/init.d/turnierinfo files/etc/uci-defaults/90-JudoShiai-xPack.sh files/www/turnierinfo/error.html files/www/turnierinfo/index.html

all: $(ar71xx_targets)

clean:
	rm -rf openwrt-imagebuilder*/
	rm -rf release/

.PHONY: all clean cleanall

.PRECIOUS: openwrt-imagebuilder-%.Linux-x86_64.tar.xz

.SUFFIXES:

$(ar71xx_targets): release/ar71xx/generic/openwrt-$(OPENWRT_VERSION)-turnierinfo-ar71xx-generic-%-squashfs-factory.bin : openwrt-imagebuilder-$(OPENWRT_VERSION)-ar71xx-generic.Linux-x86_64/ $(files)
	make -C $< image PROFILE="$*" PACKAGES="vsftpd luci -ppp -ppp-mod-pppoe" EXTRA_IMAGE_NAME="TurnierInfo" FILES="../files/"
	mkdir -p release/ar71xx/generic/
	cp $<bin/targets/ar71xx/generic/openwrt-$(OPENWRT_VERSION)-turnierinfo-ar71xx-generic-$*-squashfs-*.bin release/ar71xx/generic/

openwrt-imagebuilder-%.Linux-x86_64/: | openwrt-imagebuilder-%.Linux-x86_64.tar.xz
	tar --xz -xf $|

openwrt-imagebuilder-%.Linux-x86_64.tar.xz:
	@ echo $(word 1,$(subst -, ,$*))
	@ echo $(word 2,$(subst -, ,$*))
	@ echo $(word 3,$(subst -, ,$*))
	wget https://downloads.openwrt.org/releases/$(word 1,$(subst -, ,$*))/targets/$(word 2,$(subst -, ,$*))/$(word 3,$(subst -, ,$*))/openwrt-imagebuilder-$(word 1,$(subst -, ,$*))-$(word 2,$(subst -, ,$*))-$(word 3,$(subst -, ,$*)).Linux-x86_64.tar.xz

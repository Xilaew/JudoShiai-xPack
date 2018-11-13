OPENWRT_VERSION := 18.06.1
#ar71xx_generic_target_profiles := tl-wr1043nd-v1 tl-wr1043nd-v2 archer-c7-v2 archer-c60-v2
ar71xx_generic_profiles := ALFAAP120C ALFAAP96 ALFANX ALL0258N ALL0305 ALL0315N AP121_8M ap121f ap90q ap91-5g AP96 archer-c25-v1 archer-c58-v1 archer-c59-v1 archer-c5-v1 archer-c60-v1 archer-c60-v2 archer-c7-v1 archer-c7-v2 archer-c7-v2-il archer-c7-v4 archer-c7-v5 c-55 cap324 CAP4200AG cf-e316n-v2 cf-e320n-v2 cf-e355ac-v1 cf-e355ac-v2 cf-e375ac cf-e380ac-v1 cf-e380ac-v2 cf-e385ac cf-e520n cf-e530n cpe210-220-v1 cpe210-v2 cpe510-520-v1 cpe830 cpe870 cr3000-nocloud dap-2695-a1 DGL5500A1 DHP1565A1 DIR825B1 DIR825C1 DIR835A1 dir-869-a1 dLAN_Hotspot dLAN_pro_1200_ac dLAN_pro_500_wp dr342 dragino2 e558-v2-8M e558-v2-16M e750a-v4-8M e750a-v4-16M eap120-v1 EAP300V2 EAP7660D el-mini EPG5000 ESR1750 ESR900 F9K1115V2 fritz300e fritz4020 gl-ar300 gl-usb150 hiwifi-hc6361 JA76PF2 JWAP003 jwap230 koala lan-turtle mc-mac1200r mr12 mr16 MR1750 MR600 MR900 mw4530r-v1 mynet-n600 mynet-n750 MYNETREXT MZKW04NU MZKW300NH n5q OM2P OM5P OM5PAC omy-g1 omy-x1 pqi-air-pen qihoo-c301 r36a rut900 rw2458n sr3200 t830 TEW673GRU TEW732BR TEW823DRU tl-mr6400-v1 tl-wdr3500-v1 tl-wdr3600-v1 tl-wdr4300-v1 tl-wdr4310-v1 tl-wdr4900-v2 tl-wdr6500-v2 tl-wdr7500-v3 tl-wr1043nd-v1 tl-wr1043nd-v2 tl-wr1043nd-v3 tl-wr1043nd-v4 tl-wr1043n-v5 tl-wr2543-v1 tl-wr710n-v2.1 tl-wr842n-v1 tl-wr842n-v2 tl-wr842n-v3 tl-wr902ac-v1 tl-wr942n-v1 TUBE2H16M TUBE2H8M ubnt-air-gateway-pro ubnt-air-gateway ubnt-airrouter ubnt-bullet-m ubnt-loco-m-xw ubnt-nano-m ubnt-nano-m-xw ubnt-rs ubnt-rspro ubnt-uap-pro ubnt-unifi ubnt-unifiac-lite ubnt-unifiac-mesh ubnt-unifiac-pro ubnt-unifi-outdoor ubnt-unifi-outdoor-plus wbs210-v1 wbs510-v1 wifi-pineapple-nano wlr8100 wndr3700 wndr3700v2 wndr3800 wndr3800ch WNR2200 WRT160NL WZR450HP2 WZR600DHP WZRHPAG300H WZRHPG300NH WZRHPG300NH2 WZRHPG450H xd3200 zbt-we1526 ZCN1523H28 ZCN1523H516
brcm63xx_generic_profiles := 96328avng-generic 96358VW2-generic A226M A4001N A4001N1 AD1018-SPI_flash AGPF-S0 AR1004G AR5315u AR5381u AR5387un CPA-ZNTE60T CPVA502PLUS CT-5365 CT-6373 DVAG3810BN EVG2000 FAST2404 FAST2604 FAST2704N GW6000 GW6200 HG556a-A HG556a-B HG556a-C HG622 HG655b livebox NEUFBOX6 R5010UNv2 SPW303V USR9108 VR-3025u VR-3025un
files := $(wildcard files/* ) $(wildcard files/*/* ) $(wildcard files/*/*/* ) $(wildcard files/*/*/*/* )

all:
	make target=ar71xx subtarget=generic release/ar71xx/generic/ar71xx
	make target=brcm63xx subtarget=generic release/brcm63xx/generic/brcm63xx

clean:
	rm -rf openwrt-imagebuilder*/
	rm -rf release/

.PHONY: all clean cleanall

.PRECIOUS: openwrt-imagebuilder-%.Linux-x86_64.tar.xz

.SUFFIXES:

release/$(target)/$(subtarget)/$(target): $(foreach profile,$($(target)_$(subtarget)_profiles),release/$(target)/$(subtarget)/$(profile))
	cp -u openwrt-imagebuilder-$(OPENWRT_VERSION)-$(target)-$(subtarget).Linux-x86_64/bin/targets/$(target)/$(subtarget)/openwrt-$(OPENWRT_VERSION)-turnierinfo-$(target)-$(subtarget)-*-squashfs-*.bin release/$(target)/$(subtarget)/

release/$(target)/$(subtarget)/% : openwrt-imagebuilder-$(OPENWRT_VERSION)-$(target)-$(subtarget).Linux-x86_64/ $(files)
	make -C $< image PROFILE="$*" PACKAGES="vsftpd luci -ppp -ppp-mod-pppoe" EXTRA_IMAGE_NAME="TurnierInfo" FILES="../files/"
	mkdir -p release/$(target)/$(subtarget)/
	touch $@

openwrt-imagebuilder-%.Linux-x86_64/: | openwrt-imagebuilder-%.Linux-x86_64.tar.xz
	tar --xz -xf $|

openwrt-imagebuilder-%.Linux-x86_64.tar.xz:
	wget https://downloads.openwrt.org/releases/$(word 1,$(subst -, ,$*))/targets/$(word 2,$(subst -, ,$*))/$(word 3,$(subst -, ,$*))/openwrt-imagebuilder-$(word 1,$(subst -, ,$*))-$(word 2,$(subst -, ,$*))-$(word 3,$(subst -, ,$*)).Linux-x86_64.tar.xz

gmsl:
	wget https://netcologne.dl.sourceforge.net/project/gmsl/GNU%20Make%20Standard%20Library/v1.1.8/gmsl-1.1.8.tar.gz
	tar -xzf gmsl-1.1.8.tar.gz


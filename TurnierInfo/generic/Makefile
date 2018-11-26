OPENWRT_VERSION := 18.06.1

apm821xx_nand_profiles := meraki_mr24 meraki_mx60 netgear_wndr4700

#ar71xx_generic_target_profiles := tl-wr1043nd-v1 tl-wr1043nd-v2 archer-c7-v2 archer-c60-v2
ar71xx_generic_profiles := ALFAAP120C ALFAAP96 ALFANX ALL0258N ALL0305 ALL0315N AP121_8M ap121f ap90q ap91-5g AP96 archer-c25-v1 archer-c58-v1 archer-c59-v1 archer-c5-v1 archer-c60-v1 archer-c60-v2 archer-c7-v1 archer-c7-v2 archer-c7-v2-il archer-c7-v4 archer-c7-v5 c-55 cap324 CAP4200AG cf-e316n-v2 cf-e320n-v2 cf-e355ac-v1 cf-e355ac-v2 cf-e375ac cf-e380ac-v1 cf-e380ac-v2 cf-e385ac cf-e520n cf-e530n cpe210-220-v1 cpe210-v2 cpe510-520-v1 cpe830 cpe870 cr3000-nocloud dap-2695-a1 DGL5500A1 DHP1565A1 DIR825B1 DIR825C1 DIR835A1 dir-869-a1 dLAN_Hotspot dLAN_pro_1200_ac dLAN_pro_500_wp dr342 dragino2 e558-v2-8M e558-v2-16M e750a-v4-8M e750a-v4-16M eap120-v1 EAP300V2 EAP7660D el-mini EPG5000 ESR1750 ESR900 F9K1115V2 fritz300e fritz4020 gl-ar300 gl-usb150 hiwifi-hc6361 JA76PF2 JWAP003 jwap230 koala lan-turtle mc-mac1200r mr12 mr16 MR1750 MR600 MR900 mw4530r-v1 mynet-n600 mynet-n750 MYNETREXT MZKW04NU MZKW300NH n5q OM2P OM5P OM5PAC omy-g1 omy-x1 pqi-air-pen qihoo-c301 r36a rut900 rw2458n sr3200 t830 TEW673GRU TEW732BR TEW823DRU tl-mr6400-v1 tl-wdr3500-v1 tl-wdr3600-v1 tl-wdr4300-v1 tl-wdr4310-v1 tl-wdr4900-v2 tl-wdr6500-v2 tl-wdr7500-v3 tl-wr1043nd-v1 tl-wr1043nd-v2 tl-wr1043nd-v3 tl-wr1043nd-v4 tl-wr1043n-v5 tl-wr2543-v1 tl-wr710n-v2.1 tl-wr842n-v1 tl-wr842n-v2 tl-wr842n-v3 tl-wr902ac-v1 tl-wr942n-v1 TUBE2H16M TUBE2H8M ubnt-air-gateway-pro ubnt-air-gateway ubnt-airrouter ubnt-bullet-m ubnt-loco-m-xw ubnt-nano-m ubnt-nano-m-xw ubnt-rs ubnt-rspro ubnt-uap-pro ubnt-unifi ubnt-unifiac-lite ubnt-unifiac-mesh ubnt-unifiac-pro ubnt-unifi-outdoor ubnt-unifi-outdoor-plus wbs210-v1 wbs510-v1 wifi-pineapple-nano wlr8100 wndr3700 wndr3700v2 wndr3800 wndr3800ch WNR2200 WRT160NL WZR450HP2 WZR600DHP WZRHPAG300H WZRHPG300NH WZRHPG300NH2 WZRHPG450H xd3200 zbt-we1526 ZCN1523H28 ZCN1523H516
ar71xx_mikrotik_profiles := nand-64m nand-large nand-large-ac rb-nor-flash-16M rb-nor-flash-16M-ac
ar71xx_nand_profiles := c-60 domywifi-dw33d hiveap-121 mr18 NBG6716 R6100 rambutan wi2a-ac200i WNDR3700V4 WNDR4300V1 z1
ar71xx_tiny_profiles := A02RBW300N DIR600A1 DIR601A1 DIR601B1 DIR615C1 DIR615E1 DIR615E4 DIR615I1 DIR615I3 EBR2310C1 FR54RTR N150R NBG_460N_550N_550NH REALWNR1000V2 REALWNR612V2 rnx-n360rt TEW632BRP TEW652BRP_FW TEW652BRP_RECOVERY TEW712BR tl-mr10u-v1 tl-mr11u-v1 tl-mr11u-v2 tl-mr12u-v1 tl-mr13u-v1 tl-mr3020-v1 tl-mr3040-v1 tl-mr3040-v2 tl-mr3220-v1 tl-mr3220-v2 tl-mr3420-v1 tl-mr3420-v2 tl-wa701nd-v1 tl-wa701nd-v2 tl-wa7210n-v2 tl-wa730re-v1 tl-wa750re-v1 tl-wa7510n-v1 tl-wa801nd-v1 tl-wa801nd-v2 tl-wa801nd-v3 tl-wa830re-v1 tl-wa830re-v2 tl-wa850re-v1 tl-wa850re-v2 tl-wa855re-v1 tl-wa860re-v1 tl-wa901nd-v1 tl-wa901nd-v2 tl-wa901nd-v3 tl-wa901nd-v4 tl-wa901nd-v5 tl-wdr3320-v2 tl-wr1041n-v2 tl-wr703n-v1 tl-wr710n-v2 tl-wr720n-v3 tl-wr720n-v4 tl-wr740n-v1 tl-wr740n-v3 tl-wr740n-v4 tl-wr740n-v5 tl-wr740n-v6 tl-wr741nd-v1 tl-wr741nd-v2 tl-wr741nd-v4 tl-wr741nd-v5 tl-wr743nd-v1 tl-wr743nd-v2 tl-wr802n-v1 tl-wr802n-v2 tl-wr840n-v2 tl-wr840n-v3 tl-wr841-v10 tl-wr841-v11 tl-wr841-v12 tl-wr841-v1.5tl-wr841-v3 tl-wr841-v5 tl-wr841-v7 tl-wr841-v8 tl-wr841-v9 tl-wr843nd-v1 tl-wr847n-v8 tl-wr940n-v4 tl-wr940n-v6 tl-wr941nd-v2 tl-wr941nd-v3 tl-wr941nd-v4 tl-wr941nd-v5 tl-wr941nd-v6 tl-wr941nd-v6-cn WHRG301N WHRHPG300N WHRHPGN WLAEAG300N WNR1000V2_VC WNR2000 WNR2000V3 WNR2000V4 WP543_4M WPE72_4M WPN824N

bcm53xx_generic_profiles :=
brcm2708_bcm2708_profiles := rpi
brcm2708_bcm2709_profiles := rpi-2
brcm2708_bcm2710_profiles := rpi-3
brcm47xx_generic_profiles :=
brcm47xx_legacy_profiles :=
brcm47xx_mips74k_profiles :=
#brcm63xx_generic_profiles := 96328avng-generic
brcm63xx_generic_profiles := 96328avng-generic 96358VW2-generic A226M A4001N A4001N1 AD1018-SPI_flash AGPF-S0 AR1004G AR5315u AR5381u AR5387un CPA-ZNTE60T CPVA502PLUS CT-5365 CT-6373 DVAG3810BN EVG2000 FAST2404 FAST2604 FAST2704N GW6000 GW6200 HG556a-A HG556a-B HG556a-C HG622 HG655b livebox NEUFBOX6 R5010UNv2 SPW303V USR9108 VR-3025u VR-3025un
brcm63xx_smp_profiles := P870HW-51a_v2 HG655b FAST2704N FAST2704V2 AV4202N R1000H VH4032N

cns3xxx_generic_profiles :=

gemini_generic_profiles := 

imx6_generic_profiles :=

ipq40xx_generic_profiles :=

ipq806x_generic_profiles :=

ixp4xx_generic_profiles :=

kirkwood_generic_profiles :=

lantiq_xrx200_profiles :=arcadyan_arv7519rw22 arcadyan_vg3503j arcadyan_vgv7510kw22-brn arcadyan_vgv7510kw22-nor arcadyan_vgv7519-brn arcadyan_vgv7519-nor avm_fritz3370 avm_fritz7360sl bt_homehub-v5a buffalo_wbmr-300hpd lantiq_easy80920-nand lantiq_easy80920-nor tplink_tdw8970 tplink_tdw8980 tplink_vr200v zyxel_p-2812hnu-f1 zyxel_p-2812hnu-f3
lantiq_xway_profiles := arcadyan_arv4510pw arcadyan_arv4519pw arcadyan_arv7506pw11 arcadyan_arv7510pw22 arcadyan_arv7518pw arcadyan_arv7519pw arcadyan_arv7525pw arcadyan_arv752dpw arcadyan_arv752dpw22 arcadyan_arv8539pw22 audiocodes_mp-252 avm_fritz7320 bt_homehub-v2b bt_homehub-v3a lantiq_easy50712 netgear_dgn3500 netgear_dgn3500b zte_h201l zyxel_p-2601hn

mediatek_mt7623_profiles :=

mvebu_cortexa9_profiles := linksys-wrt1200ac linksys-wrt1900ac linksys-wrt1900acs linksys-wrt1900acv2 linksys-wrt3200acm linksys-wrt32x turris-omnia

ramips_mt7620_profiles := alfa-network_ac1200rm ArcherC20i ArcherC50v1 ArcherMR200 c108 cf-wr800n cs-qr10 d240 db-wrt01 dch-m225 dir-810l dlink_dwr-116-a1 dlink_dwr-921-c1 dlink_dwr-921-c3 e1700 ex2700 ex3700-ex3800 gl-mt300a gl-mt300n gl-mt750 hc5661 hc5761 hc5861 kng_rc kn_rc kn_rf microwrt miwifi-mini mlw221 mlwg2 mzk-750dhp mzk-ex300np mzk-ex750np na930 phicomm_k2g psg1208 psg1218a psg1218b ravpower_wd03 rp-n53 rt-ac51u rt-n12p rt-n14u tiny-ac tplink_c20-v1 u25awf-h1 vonets_var11n-300 we1026-5g-16m whr-1166d whr-300hp2 whr-600d wmr-300 wn3000rpv3 wrh-300cr wrtnode wt3020-4M wt3020-8M y1s youku-yk1 zbt-ape522ii zbt-cpe102 zbt-wa05 zbt-we2026 zbt-we826-16M zbt-we826-32M zbt-wr8305rt zte-q7
ramips_mt7621_profiles := d-team_newifi-d2 dir-860l-b1 elecom_wrc-1167ghbk2-s ew1200 firewrt gnubee_gb-pc1 gnubee_gb-pc2 hc5962 iodata_wn-gx300gr k2p mikrotik_rbm33g mir3g mqmaker_witi-256m mqmaker_witi-512m newifi-d1 r6220 rb750gr3 re350-v1 re6500 sap-g3200u3 sk-wb8 u7621-06-256M-16M ubnt-erx-sfp ubnt-erx vr500 w2914nsv2 wf-2881 wndr3700v5 wsr-1166 youhua_wr1200js zbt-we1326 zbt-wg2626 zbt-wg3526-16M zbt-wg3526-32M zbtlink_zbt-we3526
ramips_mt76x8_profiles := alfa-network_awusfree1 duzun-dm06 gl-mt300n-v2 hc5661a LinkIt7688 mac1200r-v2 miwifi-nano mt7628 pbr-d1 tama_w06 tl-wr840n-v4 tl-wr840n-v5 tl-wr841n-v13 tplink_c20-v4 tplink_c50-v3 tplink_tl-mr3420-v5 tplink_tl-wr842n-v5 tplink_tl-wr902ac-v3 u7628-01-128M-16M wcr-1166ds wl-wn575a3 zbtlink_zbt-we1226
ramips_rt288x_profiles := ar670w ar725w dlink_dap-1522-a1 f5d8235-v1 rt-n15 wli-tx4-ag300n wzr-agl300nh
ramips_rt305x_profiles := 3g150b 3g300m 3g-6200n 3g-6200nl a5-v11 air3gii ALL02393G all0256n-4M all0256n-8M asl26555-16M asl26555-8M atp-52b awapn2403 awm002-evb-4M awm002-evb-8M bc2 broadway d105 dap-1350 dir-300-b1 dir-300-b7 dir-320-b1 dir-600-b1 dir-610-a1 dir-615-d dir-615-h1 dir-620-a1 dir-620-d1 dwr-512-b esr-9753 f5d8235-v2 fonera20n freestation5 hg255d hlk-rm04 ht-tm02 hw550-3g ip2202 jhr-n805r jhr-n825r jhr-n926r kn m3 m4-4M m4-8M mofi3500-3gn mpr-a1 mpr-a2 mr-102n mzk-dp150n mzk-w300nh2 mzk-wdpr nbg-419n nbg-419n2 nw718 psr-680w pwh2004 px-4885-4M px-4885-8M rt-g32-b1 rt-n10-plus rt-n13u rut5xx sl-r7205 tew-638apb-v2 tew-714tru ur-326n4g ur-336un v22rw-2x2 w150m w306r-v20 wcr-150gn whr-g300n wizard8800 wizfi630a wl-330n wl-330n3g WL-341V3 wl-351 wnce2001 wr512-3gn-4M wr512-3gn-8M wr6202 wt1520-4M wt1520-8M x5 x8 xdxrn502j zorlik_zl5900v2
ramips_rt3883_profiles :=

sunxi_cortexa53_profiles :=
sunxi_cortexa7_profiles :=
sunxi_cortexa8_profiles :=

files := $(wildcard files/* ) $(wildcard files/*/* ) $(wildcard files/*/*/* ) $(wildcard files/*/*/*/* )

all:
	make target=apm821xx subtarget=nand release/apm821xx-nand
	make target=ar71xx subtarget=generic release/ar71xx-generic
	make target=ar71xx subtarget=mikrotik release/ar71xx-mikrotik
	make target=ar71xx subtarget=nand release/ar71xx-nand
	make target=ar71xx subtarget=tiny release/ar71xx-tiny
	make target=bcm53xx subtarget=generic release/bcm53xx-generic
	make target=brcm2708 subtarget=bcm2708 release/brcm2708-bcm2708
	make target=brcm2708 subtarget=bcm2709 release/brcm2708-bcm2709
	make target=brcm2708 subtarget=bcm2710 release/brcm2708-bcm2710
	make target=brcm47xx subtarget=generic release/brcm47xx-generic
	make target=brcm47xx subtarget=legacy release/brcm47xx-legacy
	make target=brcm47xx subtarget=mips74k release/brcm47xx-mips74k
	make target=brcm63xx subtarget=generic release/brcm63xx-generic
	make target=brcm63xx subtarget=smp release/brcm63xx-smp
	make target=cns3xxx subtarget=generic release/cns3xxx-generic
	make target=gemini subtarget=generic  release/gemini-generic
	make target=imx6 subtarget=generic release/imx6-generic
	make target=ipq40xx subtarget=generic release/ipq40xx-generic
	make target=ipq806x subtarget=generic release/ipq806x-generic
	make target=ixp4xx subtarget=generic release/ixp4xx-generic
	make target=kirkwood subtarget=generic release/kirkwood-generic
	make target=lantiq subtarget=xrx200 release/lantiq-xrx200
	make target=lantiq subtarget=xway release/lantiq-xway
	make target=mediatek subtarget=mt7623 release/mediatek-mt7623
	make target=mvebu subtarget=cortexa9 release/mvebu-cortexa9
	make target=ramips subtarget=mt7620 release/ramips-mt7620
	make target=ramips subtarget=mt7621 release/ramips-mt7621
	make target=ramips subtarget=mt76x8 release/ramips-mt76x8
	make target=ramips subtarget=rt288x release/ramips-rt288x
	make target=ramips subtarget=rt305x release/ramips-rt305x
	make target=ramips subtarget=rt3883 release/ramips-rt3883
	make target=sunxi subtarget=cortexa53 release/sunxi-cortexa53
	make target=sunxi subtarget=cortexa7  release/sunxi-cortexa7
	make target=sunxi subtarget=cortexa8  release/sunxi-cortexa8

clean:
	rm -rf openwrt-imagebuilder*/
	rm -rf release/

.PHONY: all clean cleanall

.PRECIOUS: openwrt-imagebuilder-%.Linux-x86_64.tar.xz

.SUFFIXES:

release/$(target)-$(subtarget): $(foreach profile,$($(target)_$(subtarget)_profiles),release/$(target)-$(subtarget)-$(profile)) release/$(target)_$(subtarget)_00EXCLUDED release
	mkdir -p release/$(target)/$(subtarget)
	cp -uR openwrt-imagebuilder-$(OPENWRT_VERSION)-$(target)-$(subtarget).Linux-x86_64/bin/targets/$(target)/$(subtarget)/* release/$(target)/$(subtarget) \
	|| test "$($(target)_$(subtarget)_profiles)" = ""

release/$(target)-$(subtarget)-%: openwrt-imagebuilder-$(OPENWRT_VERSION)-$(target)-$(subtarget).Linux-x86_64/ $(files) release
	echo "Building Image for $(target) $(subtarget) $*"
	make -C $< image PROFILE="$*" PACKAGES="vsftpd luci -ppp -ppp-mod-pppoe" EXTRA_IMAGE_NAME="TurnierInfo" FILES="../files/" >$@ 2>&1
	
release/$(target)_$(subtarget)_00EXCLUDED: openwrt-imagebuilder-$(OPENWRT_VERSION)-$(target)-$(subtarget).Linux-x86_64/ release
	make -C $< info | grep :$$ | tr -d : | sort > release/$(target)_$(subtarget)_00ALL
	echo $($(target)_$(subtarget)_profiles)| tr ' ' \\n | sort > release/$(target)_$(subtarget)_00BUILT
	diff release/$(target)_$(subtarget)_00ALL release/$(target)_$(subtarget)_00BUILT > $@ ; true

release:
	mkdir -p release

openwrt-imagebuilder-%.Linux-x86_64/: | openwrt-imagebuilder-%.Linux-x86_64.tar.xz
	echo "Unpacking $|"
	tar --xz -xf $|
	{ test -d $@ && echo "$@ ist ein Verzeichnis" ; } \
	|| { ln -s -f openwrt-imagebuilder-$(word 1,$(subst -, ,$*))-$(word 2,$(subst -, ,$*)).Linux-x86_64 $(@:/=) ; echo "$@ ist ein symbolischer Link" ; }

openwrt-imagebuilder-%.Linux-x86_64.tar.xz:
	echo "Downloading $@"
	wget -nv --show-progress https://downloads.openwrt.org/releases/$(word 1,$(subst -, ,$*))/targets/$(word 2,$(subst -, ,$*))/$(word 3,$(subst -, ,$*))/openwrt-imagebuilder-$(word 1,$(subst -, ,$*))-$(word 2,$(subst -, ,$*))-$(word 3,$(subst -, ,$*)).Linux-x86_64.tar.xz \
	|| { wget -nv --show-progress https://downloads.openwrt.org/releases/$(word 1,$(subst -, ,$*))/targets/$(word 2,$(subst -, ,$*))/$(word 3,$(subst -, ,$*))/openwrt-imagebuilder-$(word 1,$(subst -, ,$*))-$(word 2,$(subst -, ,$*)).Linux-x86_64.tar.xz \
	; ln -s -f openwrt-imagebuilder-$(word 1,$(subst -, ,$*))-$(word 2,$(subst -, ,$*)).Linux-x86_64.tar.xz $@ ; }

gmsl:
	wget -nv --show-progress https://netcologne.dl.sourceforge.net/project/gmsl/GNU%20Make%20Standard%20Library/v1.1.8/gmsl-1.1.8.tar.gz
	tar -xzf gmsl-1.1.8.tar.gz


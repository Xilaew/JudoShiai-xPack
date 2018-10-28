#!/bin/bash
COPYRIGHTHOLDER='Felix von Poblotzki'
EMAIL='xilaew@gmail.com'
VERSION='0.1'

XGETTEXT=xgettext
MSGMERGE=msgmerge
MSGFMT=msgfmt
SOURCES='index.php lib.php rest.php'
LOCALE=locale
TEMPLATE=template
MESSAGES_PATH=LC_MESSAGES/messages
TEMPLATE_PATH=$TEMPLATE/$MESSAGES_PATH

echo $XGETTEXT --from-code=UTF-8 --output="${LOCALE}/${TEMPLATE_PATH}.po" --add-location=file --language=php \
	--package-name="judoshiai-xPack" --package-version="${VERSION}" --copyright-holder="${COPYRIGHTHOLDER}" --msgid-bugs-address="${EMAIL}" \
	${SOURCES}
$XGETTEXT --from-code=UTF-8 --output="${LOCALE}/${TEMPLATE_PATH}.po" --add-location=file --language=php \
	--package-name="judoshiai-xPack" --package-version="${VERSION}" --copyright-holder="${COPYRIGHTHOLDER}" --msgid-bugs-address="${EMAIL}" \
	${SOURCES}

cd ${LOCALE}
for D in *; do
	if [ -d "${D}" ] && [ "${D}" != "${TEMPLATE}" ]; then
		echo $MSGMERGE -U --no-fuzzy-matching --backup=none "${D}/${MESSAGES_PATH}.po" "${TEMPLATE_PATH}.po"
		$MSGMERGE -U --no-fuzzy-matching --backup=none "${D}/${MESSAGES_PATH}.po" "${TEMPLATE_PATH}.po"
		echo $MSGFMT -o "${D}/${MESSAGES_PATH}.mo" "${D}/${MESSAGES_PATH}.po"
		$MSGFMT -o "${D}/${MESSAGES_PATH}.mo" "${D}/${MESSAGES_PATH}.po"
	fi
done
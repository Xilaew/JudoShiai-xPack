#!/usr/bin/env bash
COPYRIGHTHOLDER='Felix von Poblotzki'
EMAIL='xilaew@gmail.com'
VERSION=`git describe --tags`

XGETTEXT=xgettext
MSGMERGE=msgmerge
MSGFMT=msgfmt
SOURCES=`ls *.php | sort`
LOCALE=locale
TEMPLATE=template
MESSAGES_PATH=LC_MESSAGES/messages
TEMPLATE_PATH=$TEMPLATE/$MESSAGES_PATH
ZIP=zip

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null && pwd )"

function updateLocalisation {
  cd ${DIR}
  ${XGETTEXT} --version
  echo ${XGETTEXT} --from-code=UTF-8 --output="${LOCALE}/${TEMPLATE_PATH}.po" --add-location=file --language=php --package-name="judoshiai-xPack" --package-version="${VERSION}" --copyright-holder="${COPYRIGHTHOLDER}" --msgid-bugs-address="${EMAIL}" ${SOURCES}
  ${XGETTEXT} --from-code=UTF-8 --output="${LOCALE}/${TEMPLATE_PATH}.po" --add-location=file --language=php --package-name="judoshiai-xPack" --package-version="${VERSION}" --copyright-holder="${COPYRIGHTHOLDER}" --msgid-bugs-address="${EMAIL}" ${SOURCES}
  sed -i '/POT-Creation-Date/d' ${LOCALE}/${TEMPLATE_PATH}.po

  cd ${LOCALE}
  for D in *; do
    if [ -d "${D}" ] && [ "${D}" != "${TEMPLATE}" ]; then
      echo $MSGMERGE -U --no-fuzzy-matching --backup=none "${D}/${MESSAGES_PATH}.po" "${TEMPLATE_PATH}.po"
      $MSGMERGE -U --no-fuzzy-matching --backup=none "${D}/${MESSAGES_PATH}.po" "${TEMPLATE_PATH}.po"
      echo $MSGFMT -o "${D}/${MESSAGES_PATH}.mo" "${D}/${MESSAGES_PATH}.po"
      $MSGFMT -o "${D}/${MESSAGES_PATH}.mo" "${D}/${MESSAGES_PATH}.po"
    fi
  done
}

function release {
  cd ${DIR}
  cp ../JudoShiai-Templates/template_*.shi ./
  cp ../JudoShiai-Templates/clubs_*.txt ./
  ${ZIP} -u ./JudoSignUp-${VERSION}.zip ./*.php ./template*.shi ./README.md ./loading.gif ./clubs_*.txt ./locale/*/*/*.mo
}

updateLocalisation
release

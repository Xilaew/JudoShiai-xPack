#!/usr/bin/env python3
import requests
import re

url = 'https://www.hamburg-judo.de/suche'
website = requests.get(url)
text = website.text.replace('src="/', 'src="https://www.hamburg-judo.de/').replace('href="/',
                                                                                   'href="https://www.hamburg-judo.de/')
with open('index.php', 'r', encoding='utf-8') as indexFile:
    index = indexFile.read()
text = re.sub('<!--TYPO3SEARCH_begin-->.*?<!--TYPO3SEARCH_end-->',
              '<!--TYPO3SEARCH_begin-->\n' + index + '\n<!--TYPO3SEARCH_end-->',
              text, flags=re.DOTALL)

with open('index_custom.php', 'w') as outFile:
    outFile.write(text)

import requests
from bs4 import BeautifulSoup

def events_spider():
        url = 'http://www.eventsinnepal.com/'
        source_code = requests.get(url)
        plain_text = source_code.text
        soup = BeautifulSoup(plain_text, "html.parser")

        for link in soup.findAll('span'):
            if link.parent.name == 'div':
                span = link.string
                print(span)

        # for sink in soup.findAll('cite'):
        #     if link.parent.name == 'div':
        #         cite = sink.string
        #         print(cite)

events_spider()

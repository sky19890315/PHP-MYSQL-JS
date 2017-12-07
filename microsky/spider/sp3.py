import re
import requests
import json
from requests.exceptions import RequestException
from bs4 import BeautifulSoup
import lxml

def get_page(url):
    try:
        headers = {'user-agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'}
        response = requests.get(url, headers=headers)
        if response.status_code == 200:
            return response.text
        return None
    except RequestException:
        return 'Error ' + response.reason


def parse_page(html):
    # print(html)
    # pattern = re.compile('<div.*?class="tpc_content do_not_catch"><img.*?>(.*?)</div>', re.S)
    # pattern = re.compile('<div class="tpc_content do_not_catch"><img.*?>(.*?)</div>', re.S)
    total_img = 0
    soup = BeautifulSoup(html, 'lxml')
    img = soup.find_all(['img'])
    for myimg in img:
        link = myimg.get('src')
        total_img += 1
        # print(link)
        dimg = requests.get(link)
        with open('myimg', 'wb') as code:
            code.write(dimg)
        # print(dimg.content)


    # print(img)
    # items = re.findall(pattern, html)
    # for item in items:
    #     print(item)


def main():
    url = 'https://www.t66y.com/htm_data/7/1712/2816615.html'
    html = get_page(url)
    items = parse_page(html)



main()
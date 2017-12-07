import re
import requests
import json
from requests.exceptions import RequestException
import time


def get_page(url):
    headers = {'user-agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'}
    response = requests.get(url, headers=headers)
    try:
        if response.status_code == 200:
            return response.text
        return None
    except RequestException:
        return 'No real content!'


def parse_page(html):
    print(html)
    try:
        # pattern = re.compile('<div.*?class="author.*?>.*?<a.*?</a>.*?<a.*?>(.*?)</a>.*?<div.*?class'
                             # + '="content".*?title="(.*?)">(.*?)</div>(.*?)<div class="stats.*?class="number">(.*?)</i>', re.S)
        pattern = re.compile('<div.*?class="author.*?>.*?<a.*?</a>.*?<a.*?>(.*?)</a>.*?<div.*?class'
                              + '="content".*?title="(.*?)">(.*?)</div>(.*?)', re.S)
        items = re.findall(pattern, html)
        print(items)
        for item in items:
            yield {
                'index': item[0],
                'title': item[1],
                'content': item[2],
                'img': item[3],
                'detail': item[4]
            }
    except RequestException:
        return 'Not parse_page!'


def write_to_json(content):
    with open('baike.txt', 'a', encoding='utf-8') as f:
        f.write(json.dumps(content, ensure_ascii=False) + '\n')


def main():
    page = 1
    url = 'http://www.qiushibaike.com/hot/page/' + str(page)
    html = get_page(url)
    items = parse_page(html)
    # print(parse_page(html))
    # for item in parse_page(html):
    #     write_to_json(item)


# if __name__ == '__main__':
#     main(page=1)
    # for i in range(10):
    #     main(page=i*10)
    #     time.sleep(1)

main()































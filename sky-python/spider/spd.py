# -*- coding:utf-8 -*-
import requests

page = 1
headers = {'user-agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'}
url = 'https://www.qiushibaike.com/hot/page/' + str(page)
r = requests.get(url, headers=headers)
print(r.status_code)
print(r.text)


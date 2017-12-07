# -*- coding: utf-8 -*-
import scrapy


class QiushibaikeSpider(scrapy.Spider):
    name = 'qiushibaike'
    allowed_domains = ['https://www.qiushibaike.com']
    start_urls = ['http://https://www.qiushibaike.com/']

    def parse(self, response):
        pass

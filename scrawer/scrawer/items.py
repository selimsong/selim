# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

from scrapy.item import Item, Field

class JdShoe(Item):
    title  = Field()
    buyurl = Field()
    imgurl = Field()
    imgurlLazy = Field()
    price  = Field()

class JdShoeOrder(Item):
    title   = Field()
    orderurl= Field()

class ShoeBrand(Item):
    title  = Field()
    link   = Field()


class ScrawerItem(Item):
    # define the fields for your item here like:
    # name = Field()
    pass

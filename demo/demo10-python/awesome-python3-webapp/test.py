import orm

from models import User, Blog, Comment

def test(loop):
    yield from orm.create_pool(loop=loop,user='root', password='root', database='awesome')

    u = User(name='Test', email='Test@example.com', passwd='123qwe', image='about:blank')

    yield from u.save()

    for x in test():
        pass
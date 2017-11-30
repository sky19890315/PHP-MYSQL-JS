import os
basedir = os.path.abspath(os.path.dirname(__file__))
SQLALCHEMY_DATABASE_URI = 'sqlite:///' + os.path.join(basedir, 'sky.db')
SQLALCHEMY_MIGRATE_REPO = os.path.join(basedir, 'db_sky_repository')

CSRF_ENABLED = True
SECRET_KEY = 'this is * can % try ^!'
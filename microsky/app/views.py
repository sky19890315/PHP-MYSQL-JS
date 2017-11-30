from app import app
from flask import render_template

@app.route('/')
@app.route('/index')
def index():
    user = { 'nickname': 'ken' }
    posts = [
        {
            'author': { 'nickname': 'John' },
            'body': 'Beautiful php in here!'
        },
        {
            'author': { 'nickname': 'susan' },
            'body': 'Python is better then php!'
        }
    ]
    return render_template('index.html',title='Home', user=user, posts=posts)
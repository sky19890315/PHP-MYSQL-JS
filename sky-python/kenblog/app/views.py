# from flask import render_tmplate
from app import app


@app.route('/')
def index():
    return 'Hello world'


@app.route('/about')
def about():
    return 'about ken!'


@app.route('/contact')
def contact():
    return 'contact me!'


@app.route('/home')
def home():
    return 'Home'


@app.route('/login')
def login():
    return 'Login!'
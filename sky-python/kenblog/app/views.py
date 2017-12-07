from flask import render_template
from app import app, login_manager


@app.route('/')
@app.route('/home')
def index():
    return render_template('index.html')


@app.route('/about')
def about():
    return 'about ken!'


@app.route('/contact')
def contact():
    return 'contact me!'


@app.route('/login',  methods=['GET', 'POST'])
def login():
    return 'Login!'


@login_manager.user_loader
def load_user(user_id):
    return User.get(user_id)

















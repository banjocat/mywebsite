from flask import Flask
from flask import render_template
app = Flask(__name__)


@app.route('/')
def home():
    return render_template('index.html')


@app.route('/conway')
def conway():
    return render_template('conway.html')


@app.route('/biglife')
def bigconway():
    return render_template('biglife.html')


@app.route('/boxinvader')
def boxinvader():
    return render_template('boxinvader.html')

if __name__ == '__main__':
    app.debug = True
    app.run()


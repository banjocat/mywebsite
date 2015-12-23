from flask import Flask
app = Flask(__name__)




@app.route('/')
def home():
    return 'Home'

@app.route('/boxinvader')
def boxinvader():
    return 'Demos'

@app.route('/conway')
def conway():
    return 'Conway'



if __name__ == '__main__':
    app.debug = True
    app.run()



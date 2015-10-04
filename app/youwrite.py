from flask import Flask, jsonify, render_template, request
import requests
import re
import MySQLdb


app = Flask(__name__)

app.config['DEBUG'] = True

PAGE_NOT_FOUND=404

@app.route('/profile')
def profile():
	return render_template('MyProfile.html')


@app.route('/essays')
def essays():
	return render_template('MyEssays.html')
	usr=request.form["username"]
	db = MySQLdb.connect(host="localhost", user="root", passwd="77884747", db="youwrite")
	cur = db.cursor() 
	cur.execute("SELECT * FROM essays WHERE username=%s",(usr))
	for row in cur.fetchall():
		print row[1]



@app.route('/public')
def public():
	return render_template('PublicEssays.html')

@app.route('/edits')
def edits():
	return render_template('MyEdits.html')


@app.route('/upload', methods=["GET","POST"])
def upload():
	if request.method == "POST":
		usr=request.form["username"]
		fname=request.form["fname"]
		file_id=request.form["doc"]
		file_id = re.sub(r'\/edit.*', '', file_id)
		file_id = re.sub(r'.+\/', '', file_id)
		url =  "https://docs.google.com/a/columbia.edu/document/d/" + file_id
		db = MySQLdb.connect(host="localhost", user="root", passwd="77884747", db="youwrite")
		cur = db.cursor() 
		cur.execute("INSERT INTO essays VALUES(%s,%s,%s)",(usr,fname,url))
		return render_template('MyEssays.html')
	else: #request.method=="GET"
		usr=request.form["username"]
		fname=request.form["fname"]
		file_id=request.form["doc"]
		file_id = re.sub(r'\/edit.*', '', file_id)
		file_id = re.sub(r'.+\/', '', file_id)
		url =  "https://docs.google.com/a/columbia.edu/document/d/" + file_id
		db = MySQLdb.connect(host="localhost", user="root", passwd="77884747", db="youwrite")
		cur = db.cursor() 
		cur.execute("INSERT INTO essays VALUES(%s,%s,%s)",(usr,fname,url))
		return render_template('MyEssays.html')


@app.errorhandler(PAGE_NOT_FOUND)
def not_found(error):
	return ("What are you doing?! That page doesn't exist!!"), PAGE_NOT_FOUND


@app.route('/login')
def login():
	return render_template('user.html')

@app.route('/')
def index():
	return render_template('index.html')


@app.route('/load')
def load():
	return render_template('youwrite.html')


if __name__ == '__main__':
	app.run(host="0.0.0.0")
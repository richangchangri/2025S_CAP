from flask import Flask, render_template, request, redirect, url_for, flash, jsonify
from flask_sqlalchemy import SQLAlchemy
from datetime import datetime

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///booking.db'
app.config['SECRET_KEY'] = 'your_secret_key'
db = SQLAlchemy(app)

# database model
class Facility(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(100), nullable=False)
    capacity = db.Column(db.Integer, nullable=False)
    available = db.Column(db.Boolean, default=True)

class Booking(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    user_name = db.Column(db.String(100), nullable=False)
    facility_id = db.Column(db.Integer, db.ForeignKey('facility.id'))
    booking_time = db.Column(db.DateTime, default=datetime.utcnow)
    purpose = db.Column(db.String(200), nullable=False)

@app.route('/')
def index():
    facilities = Facility.query.all()
    return render_template('index.html', facilities=facilities)

@app.route('/book', methods=['POST'])
def book():
    user_name = request.form['user_name']
    facility_id = request.form['facility_id']
    purpose = request.form['purpose']
    new_booking = Booking(user_name=user_name, facility_id=facility_id, purpose=purpose)
    db.session.add(new_booking)
    db.session.commit()
    flash("Booking Success！")
    return redirect(url_for('index'))


@app.route('/dashboard')
def dashboard():
    bookings = Booking.query.all()
    return render_template('dashboard.html', bookings=bookings)

if __name__ == '__main__':
    db.create_all()  # only create DB 1st.
    app.run(debug=True)


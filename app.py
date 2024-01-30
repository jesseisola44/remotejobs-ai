from flask import Flask, render_template, request
from werkzeug.utils import secure_filename
import os
import tensorflow as tf

app = Flask(__name__)

# Set the path where uploaded resumes will be stored
UPLOAD_FOLDER = 'uploads'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

model = tf.keras.models.load_model('remotejobslk.h5')

def process_resume(resume_path):
    # Implement your AI-driven analysis here using the loaded model
    # This is a placeholder; replace it with your actual model prediction logic
    # For example, you might preprocess the resume (e.g., convert to text) and use the model for classification.

    # For illustration purposes, just returning a dummy result
    return "Resume analysis result: Positive"

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/submit', methods=['POST'])
def submit():
    # Handle the submitted form data
    name = request.form.get('name')
    email = request.form.get('email')

    # Check if the post request has the file part
    if 'resume' not in request.files:
        return "No resume file provided"

    resume_file = request.files['resume']

    # If the user does not select a file, browser submits an empty file
    if resume_file.filename == '':
        return "No selected file"

    # Save the resume file to the specified folder
    if resume_file:
        filename = secure_filename(resume_file.filename)
        resume_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        resume_file.save(resume_path)

        # Process the resume using your AI analysis function
        result = process_resume(resume_path)

        return f"Application submitted successfully! {result}"

if __name__ == '__main__':
    app.run(debug=True)

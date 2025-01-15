@extends('home.main')

@section('title', 'Contact Us')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }

    .form-container {
      width: 80%;
      max-width: 900px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      color: #333;
    }

    .form-group {
      display: flex;
      flex-wrap: wrap;
      gap: 20px; /* Increased gap to separate fields */
      margin-bottom: 20px;
    }

    .form-group > div {
      flex: 1;
      min-width: 100px;
    }

    .form-group input, 
    .form-group textarea {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group textarea {
      resize: none;
      height: 100px;
    }

    .form-group.single {
      flex: 100%;
    }

    .submit-btn {
      width: 100%;
      padding: 15px;
      background-color: #28a745;
      color: #fff;
      font-size: 16px;
      text-transform: uppercase;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #218838;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .required {
      color: red;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Contact Us</h1>
    <form>
      <div class="form-group">
        <div>
          <label for="first-name">First Name <span class="required">*</span></label>
          <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
        </div>
        <div>
          <label for="last-name">Last Name <span class="required">*</span></label>
          <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
        </div>
      </div>
      <div class="form-group single">
        <label for="email">Email <span class="required">*</span></label>
        <input type="email" id="email" name="email" placeholder="Email" required>
      </div>
      <div class="form-group single">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" placeholder="Subject">
      </div>
      <div class="form-group single">
        <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Message"></textarea>
      </div>
      <button type="submit" class="submit-btn">Send Message</button>
    </form>
  </div>
</body>
</html>

@endsection

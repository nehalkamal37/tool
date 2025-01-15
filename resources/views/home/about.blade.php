@extends('home.main')

@section('title', 'About')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Pharmative</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .hero-section {
      position: relative;
      width: 100%;
      height: 100vh; /* Adjust height as needed */
      background: url('https://via.placeholder.com/1920x1080') no-repeat center center/cover;
      background-image: url('{{ asset('home/about.jpg') }}'); /* Replace with your image path */

      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
    }

    .hero-content {
      position: relative;
      z-index: 1;
      color: #fff;
    }

    .hero-content h1 {
      font-size: 3rem;
      margin-bottom: 20px;
    }

    .hero-content h1 span {
      color: #28a745; /* Green text for "Pharmative" */
    }

    .hero-content p {
      font-size: 1.25rem;
      margin-bottom: 30px;
      line-height: 1.6;
    }

    .hero-content .btn {
      display: inline-block;
      padding: 15px 30px;
      background-color: #fff;
      color: #28a745;
      font-size: 1rem;
      font-weight: bold;
      text-transform: uppercase;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s, color 0.3s;
    }

    .hero-content .btn:hover {
      background-color: #28a745;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>About <span>Pharmative</span></h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>
        Facilis ex perspiciatis non quibusdam vel quidem.</p>
      <a href="#" class="btn">Shop Now</a>
    </div>
  </div>
</body>
</html>



@endsection
@extends('home.main')

@section('title', 'Home')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pharmative Template</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
    }
    .site-blocks-cover {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      height: 100vh;
      background-image: url('{{ asset('home/hero_bg.jpg') }}'); /* Replace with your image path */
      background-size: cover;
      background-position: center;
      color: #fff;
      position: relative;
    }
    .overlay {
      background: rgba(0, 0, 0, 0.5);
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
    }
    .content {
      position: relative;
      z-index: 2;
    }
    .content h1 {
      font-size: 3rem;
      margin-bottom: 1rem;
    }
    .content p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
    }
    .btn {
      display: inline-block;
      padding: 0.8rem 2rem;
      background-color: #28a745;
      color: #fff;
      text-decoration: none;
      font-size: 1rem;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .btn:hover {
      background-color: #218838;
    }

    .btn {
      display: inline-block;
      padding: 15px 40px;
      font-size: 22px;
      color: #fff;
      background-color: transparent;
      border: 2px solid #28a745; /* Border color */
    /*  text-transform: uppercase;*/
      text-decoration: none;
      font-weight: bold;
      border-radius: 30px; /* Rounded corners */
      transition: all 0.3s ease;
      position: relative;
    }
    .btn:hover {
      background-color: #28a745; /* Background color on hover */
      color: #fff; /* Text color on hover */
      transform: scale(1.05); /* Slightly increase size */
    }
    .btn:hover::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(40, 167, 69, 0.1); /* Subtle green overlay */
      border-radius: 30px;
      z-index: -1;
      transform: scale(1.2); /* Slightly larger than the button */
      transition: all 0.3s ease;
    }
  </style>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Basic Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    /* Navbar Styling */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .navbar a {
      text-decoration: none;
      color: #333;
      font-size: 16px;
      margin: 0 10px;
      transition: color 0.3s ease;
    }

    .navbar a:hover {
      color: #28a745;
    }

    .navbar-logo {
      font-size: 24px;
      font-weight: bold;
      color: #28a745;
    }

    .navbar-menu {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .navbar-menu li {
      margin: 0 10px;
    }

    .navbar-icons {
      display: flex;
      align-items: center;
    }

    .navbar-icons i {
      margin-left: 20px;
      font-size: 20px;
      cursor: pointer;
    }

    .navbar-icons .cart {
      position: relative;
    }

    .navbar-icons .cart::after {
      content: "2"; /* Example notification number */
      position: absolute;
      top: -5px;
      right: -10px;
      background-color: #28a745;
      color: #fff;
      font-size: 12px;
      width: 18px;
      height: 18px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
    }

    .navbar-menu .active {
      color: #28a745;
      font-weight: bold;
    }
  </style>
</head>
<body>
 

  <div class="site-blocks-cover">
    <div class="overlay"></div>
    <div class="content">
      <h1>New Medicine <span style="color: #28a745;">Everyday</span></h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Facilis ex perspiciatis non quibusdam vel quidem.</p>
      <a href="{{ route('login')}}" class="btn">Sign In</a>
    </div>
  </div>
</body>
</html>
@endsection
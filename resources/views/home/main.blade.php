

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
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
      position: relative;
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

    .navbar-menu a {
      text-decoration: none;
      color: #333;
      font-size: 16px;
      transition: color 0.3s ease;
    }

    .navbar-menu a:hover {
      color: #28a745;
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

    /* Responsive Design */
    @media (max-width: 768px) {
      .navbar {
        flex-wrap: wrap;
        justify-content: space-between;
      }

      .navbar-menu {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
      }

      .navbar-menu li {
        margin: 10px 0;
        text-align: center;
      }

      .navbar-menu a {
        font-size: 18px;
      }

      .navbar-menu.show {
        display: flex;
      }

      .navbar-icons {
        order: 1;
      }

      .navbar-toggle {
        display: block;
        font-size: 24px;
        cursor: pointer;
      }
    }

    @media (min-width: 769px) {
      .navbar-toggle {
        display: none;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="navbar-logo">PHARMATIVE</div>
    <ul class="navbar-menu">
      <li><a href="{{ route('welcome')}}" class="active">Home</a></li>
      <li><a href="#">Store</a></li>
      <li><a href="#">Products</a></li>
      <li><a href="{{route('about')}}">About</a></li>
      <li><a href="{{route('contact')}}">Contact</a></li>
    </ul>
    <div class="navbar-icons">
   <!--   <i class="search">🔍</i>
      <i class="cart">🛒</i>-->
    </div>
    <div class="navbar-toggle" onclick="toggleMenu()">☰</div>
  </nav>

  <script>
    function toggleMenu() {
      const menu = document.querySelector('.navbar-menu');
      menu.classList.toggle('show');
    }
  </script>
</body>
</html>

@yield('content')


    <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; padding: 0 15px;">
      
      <!-- About Section -->
      <div style="flex: 1; min-width: 250px; margin-bottom: 20px;">
        <h3 style="color: #28a745; margin-bottom: 15px;">About <span style="color: #000;">Pharmative</span></h3>
        <p style="color: #666; line-height: 1.6;">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio
          voluptates sed dolorem excepturi iure eaque, aut unde.
        </p>
      </div>
      
      <!-- Navigation Section -->
      <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
        <h3 style="color: #000; margin-bottom: 15px;">Navigation</h3>
        <ul style="list-style: none; padding: 0; margin: 0; color: #666;">
          <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #666;">Supplements</a></li>
          <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #666;">Vitamins</a></li>
          <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #666;">Diet & Nutrition</a></li>
          <li><a href="#" style="text-decoration: none; color: #666;">Tea & Coffee</a></li>
        </ul>
      </div>
      
   
  </footer>
  
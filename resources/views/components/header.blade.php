<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Header Styles */
        header {
            background-color: #2c3e50;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            gap: 1.5rem;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover {
            color: #3498db;
        }

        /* Hamburger Menu for Mobile */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 2px 0;
            transition: all 0.3s ease;
        }

        /* Mobile Menu */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: #2c3e50;
                padding: 1rem;
            }

            .nav-menu.active {
                display: flex;
            }

            .hamburger {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <a href="/" class="logo">MyApp</a>
            <nav class="nav-menu" id="navMenu">
                <a href="{{ route('dashboard') }}">Home</a>
                <a href="{{ route('dashboard') }}">About</a>
                <a href="{{ route('dashboard') }}">Services</a>
                <a href="{{ route('dashboard') }}">Contact</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                <button type="submit">Logout</button>
                </form>
            </nav>
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <script>
        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        }
    </script>
</body>
</html>
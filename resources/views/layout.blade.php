<!DOCTYPE html>
<html>

<head>
    <title>Laravel SQLite CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Moul&family=Siemreap&display=swap" rel="stylesheet">

</head>
<style>

.moul-regular {
  font-family: "Moul", serif;
  font-weight: 400;
  font-style: normal;
}

.siemreap-regular {
  font-family: "Siemreap", sans-serif;
  font-weight: 400;
  font-style: normal;
}

.battambang-thin {
  font-family: "Battambang", system-ui;
  font-weight: 100;
  font-style: normal;
}

.battambang-light {
  font-family: "Battambang", system-ui;
  font-weight: 300;
  font-style: normal;
}

.battambang-regular {
  font-family: "Battambang", system-ui;
  font-weight: 400;
  font-style: normal;
}

.battambang-bold {
  font-family: "Battambang", system-ui;
  font-weight: 700;
  font-style: normal;
}

.battambang-black {
  font-family: "Battambang", system-ui;
  font-weight: 900;
  font-style: normal;
}




    .navbar {
        background-color: #f8f9fa;
        -webkit-box-shadow: 7px 22px 29px -25px rgba(61,57,61,0.62);
-moz-box-shadow: 7px 22px 29px -25px rgba(61,57,61,0.62);
box-shadow: 7px 22px 29px -25px rgba(61,57,61,0.62);

border-radius: 4px
    }

    .navbar-nav {
        margin: 0 auto;
    }

    .nav-link {
        font-size: 1.1rem;
        padding: 0.5rem 1rem;
    }

    .nav-link:hover {
        color: #ffffff;
        background-color: #0d6efd;
        border-radius: 4px
                
    }
</style>

<body>

    <div class="container mt-4">

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="/tasks">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tasks/create">Create</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <br>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>

</html>

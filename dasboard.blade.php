<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Website</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-q4cxLYjYG7ujfg0sDwxFyOjvIaO7OtAZ+Vu0ETKjTzxi4QkhzGByNrRVFzfu8wTcv/nUC7RJ9lQ2XBSRvymBmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Basic styles for demonstration */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-links li {
            margin-right: 20px;
        }
        .nav-links li:last-child {
            margin-right: 0;
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        .nav-links a i {
            margin-right: 5px;
        }
        /* Responsive styles */
        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                align-items: flex-start;
            }
            .nav-links li {
                margin: 10px 0;
            }
        }
        /* Table Styles */
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        .table-bordered th {
            background-color: #007bff;
            color: white;
        }
        .table-bordered tbody tr:nth-of-type(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <ul class="nav-links">
                <li><a href="#" id="home-link"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="#" id="deposit-link"><i class="fas fa-university"></i> Deposit</a></li>
                <li><a href="#" id="withdraw-link"><i class="fas fa-money-bill-wave"></i> Withdraw</a></li>
                <li><a href="#" id="transfar-link"><i class="fas fa-exchange-alt"></i> Transfer</a></li>
                <form id="statement-form" action="{{ route('statement') }}" method="post">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <li><a href="{{ route('statement') }}" id="statement-link" onclick="document.getElementById('statement-form').submit(); return false;"><i class="fas fa-file-invoice-dollar"></i> Statement</a></li>
</form>
                <li><a href="{{ route('login') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Deposit Section -->
    <div class="container mt-5" id="deposit-section" style="display: none;">
        <h2>Deposit</h2>
        <div class="table-responsive">
            <form action="{{ route('deposit') }}" method="post">
                @csrf
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Amount</th>
                            <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="balance" value="{{ $balance }}">
                            <td><input type="text" name="amount" class="form-control" placeholder="Enter amount"></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Deposit</button>
            </form>
        </div>
    </div>

    <!-- Transfar Section -->
    <div class="container mt-5" id="transfar-section" style="display: none;">
        <h2>Deposit</h2>
        <div class="table-responsive">
            <form action="{{ route('transfar') }}" method="post">
                @csrf
                <table class="table table-bordered">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="balance" value="{{ $balance }}">
                    <tbody>
                        <tr>
                            
                            <th>Email</th>
                          
                            <td><input type="email" name="emailtr" class="form-control" placeholder="Enter email"></td>
                        </tr>
                        <tr>
                            
                            <th>Amount</th>
                          
                            <td><input type="text" name="amount" class="form-control" placeholder="Enter amount"></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Deposit</button>
            </form>
        </div>
    </div>
    
     <!-- Withdraw Section -->
    <div class="container mt-5" id="withdraw-section" style="display: none;">
        <h2>Withdraw</h2>
    

        <div class="table-responsive">
            <form action="{{ route('withdraw') }}" method="post">
            @csrf
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Amount</th>
                            <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="balance" value="{{ $balance }}">
                            <td><input type="text" name="amount" class="form-control" placeholder="Enter amount"></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Withdraw</button>
            </form>
        </div>
    </div>
      



   




















    <!-- Your content goes here -->
    <div class="container mt-5" id="previous-section">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                    <tr>
                        <th style="width: 200px;">Welcome</th>
                        <td>{{$name}}</td>
                    </tr>
                    <tr>
                        <th>User ID</th>
                        <td>{{$id}}</td>
                    </tr>
                    <tr>
                        <th>Your Balance</th>
                        <td>{{$balance}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('deposit-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.getElementById('deposit-section').style.display = 'block'; // Show the deposit section
            document.getElementById('withdraw-section').style.display = 'none'; // Hide the withdraw section
            document.getElementById('previous-section').style.display = 'none'; // Hide the previous section
            document.getElementById('transfar-section').style.display = 'none'; // Hide the previous section
            document.getElementById('statement-section').style.display = 'none'; // Hide the previous section
        });

        document.getElementById('withdraw-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.getElementById('withdraw-section').style.display = 'block'; // Show the withdraw section
            document.getElementById('deposit-section').style.display = 'none'; // Hide the deposit section
            document.getElementById('previous-section').style.display = 'none'; // Hide the previous section
            document.getElementById('transfar-section').style.display = 'none'; // Hide the previous section
            document.getElementById('statement-section').style.display = 'none'; // Hide 
        });

        document.getElementById('home-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.getElementById('previous-section').style.display = 'block'; // Show the content section
            document.getElementById('deposit-section').style.display = 'none'; // Hide the deposit section
            document.getElementById('withdraw-section').style.display = 'none'; // Hide the withdraw section
            document.getElementById('transfar-section').style.display = 'none'; // Hide the previous section
            document.getElementById('statement-section').style.display = 'none'; // Hide 
        });
        document.getElementById('transfar-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.getElementById('transfar-section').style.display = 'block'; // Hide the previous section
            document.getElementById('previous-section').style.display = 'none'; // Show the content section
            document.getElementById('deposit-section').style.display = 'none'; // Hide the deposit section
            document.getElementById('withdraw-section').style.display = 'none'; // Hide the withdraw section
            document.getElementById('statement-section').style.display = 'none'; // Hide 
          
        });
        document.getElementById('statement-link').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    document.getElementById('statement-section').style.display = 'block'; // Show the statement section
    document.getElementById('deposit-section').style.display = 'none'; // Hide the deposit section
    document.getElementById('withdraw-section').style.display = 'none'; // Hide the withdraw section
    document.getElementById('previous-section').style.display = 'none'; // Hide the previous section
    document.getElementById('transfar-section').style.display = 'none'; // Hide the transfer section
});
    </script>
</body>
</html>

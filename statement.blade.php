<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Statement</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>type</th>
                        <th>details</th>
                        <th>balance</th>
                        <th>date and time</th>
                        
                        <!-- Add more column headers as needed -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through $userData to populate table rows -->
                    @foreach ($userData as $user)
                <tr>
                    <td>{{ $user->amount }}</td>
                    <td>{{ $user->type }}</td>
                    <td>{{ $user->details }}</td>
                    <td>{{ $user->balance}}</td>
                    <td>{{ $user->updated_at }}</td>
                    
                    <!-- Add more columns as needed -->
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
     
    </div>
</body>
</html>

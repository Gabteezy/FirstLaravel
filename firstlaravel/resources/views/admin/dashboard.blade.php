<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <!-- Other form fields if needed -->
        <button type="submit">Logout</button>
    </form>
    
    
</body>
</html>

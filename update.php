<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blacklist Status</title>
</head>
<body>
    <form method="POST" action="blacklist_update.php">
        <input type="hidden" name="user_id" value="500"> <!-- Verander dit naar de juiste user_id -->
        <label for="blacklist">Blacklist:</label>
        <input type="checkbox" id="blacklist" name="blacklist" value="1">
        <button type="submit">Update Status</button>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sortable Table without DB</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div id="app" class="container mt-4">
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Table without DB</h5>
      <p class="card-text">
      <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#addEntryModal">Add Entry</button>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th onclick="sortTable(0)">ID</th>
            <th onclick="sortTable(1)">Name</th>
            <th>Image</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Table data will be inserted here -->
        </tbody>
        </table>
      </p>
    </div>
  </div>
</div>

</body>
</html>
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
<script>
    var data = [
    { id: 1, name: 'Tester', image: 'Test.jpg', address: 'Test Address', gender: 'Male' },
    // Add more data as needed
  ];

  displayData(data);
  function displayData(dataArray) {
    var tableBody = $('#tableBody');
    dataArray.forEach(item => {
      var row = $('<tr>').html(`
        <td>${item.id}</td>
        <td>${item.name}</td>
        <td><img data-src="${item.image}" alt="Image Preview" class="img-fluid lazyload"></td>
        <td>${item.addrwss}</td>
        <td>${item.gender}</td>
        <td>
          <button class="btn btn-primary btn-sm" onclick="editEntry(${item.id})" data-toggle="modal" data-target="#editEntryModal">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteEntry(${item.id})" data-toggle="modal" data-target="#deleteEntryModal">Delete</button>
          <button class="btn btn-info btn-sm" onclick="viewEntry(${item.id})" data-toggle="modal" data-target="#viewEntryModal">View</button>
        </td>
      `);
    });
  }
</script>
</body>
</html>
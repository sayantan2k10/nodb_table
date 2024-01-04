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
<!-- Modal for Add Entry Form -->
<div class="modal" id="addEntryModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">+ Entry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <form id="addEntryForm">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" required>
            </div>
            <div class="form-group">
              <label for="image">Image URL:</label>
              <input type="text" class="form-control" id="image" required>
            </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <input type="text" class="form-control" id="address" required>
            </div>
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select class="form-control" id="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <button type="button" class="btn btn-primary" onclick="addEntry()">Add Entry</button>
          </form>
        </div>

      </div>
    </div>
  </div>

<!-- Modal for Edit Entry -->
<div class="modal" id="editEntryModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Entry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <form id="editEntryForm">
            <div class="form-group">
              <label for="editName">New Name:</label>
              <input type="text" class="form-control" id="editName" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="saveEditedEntry()">Save Changes</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal for Delete Entry -->
  <div class="modal" id="deleteEntryModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Entry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <p>Are you sure you want to delete this entry?</p>
          <button type="button" class="btn btn-danger" onclick="confirmDeleteEntry()">Delete</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal for View Entry -->
  <div class="modal" id="viewEntryModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">View Entry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body" id="viewEntryBody">
          <!-- View Entry content will be inserted here using JavaScript -->
        </div>
      </div>
    </div>
  </div>
</div>
<script>
      document.addEventListener("DOMContentLoaded", function() {
        let lazyloadImages = document.querySelectorAll("img.lazy-load");
        let lazyloadThrottleTimeout;

        function lazyload() {
          if(lazyloadThrottleTimeout) {
            clearTimeout(lazyloadThrottleTimeout);
          }
          lazyloadThrottleTimeout = setTimeout(function() {
            let scrollTop = window.pageYOffset;
            lazyloadImages.forEach(function(img) {
              if(img.offsetTop < (window.innerHeight + scrollTop)) {
                img.src = img.dataset.src;
                img.classList.remove('lazy');
              }
            });
            if(lazyloadImages.length == 0) {
              document.removeEventListener("scroll", lazyload);
              window.removeEventListener("resize", lazyload);
              window.removeEventListener("orientationChange", lazyload);
            }
          }, 20);
        }
        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("orientationChange", lazyload);
      });
    </script>
<script>
    function sortTable(columnIndex) {
    data.sort((a, b) => {
      const keyA = Object.values(a)[columnIndex];
      const keyB = Object.values(b)[columnIndex];

      if (typeof keyA === 'string' && typeof keyB === 'string') {
        return keyA.localeCompare(keyB);
      } else {
        return keyA - keyB;
      }
    });

    displayData(data);
  }
</script>
<script>
    const data = [
    { id: 1, name: 'Tester', image: 'Test.jpg', address: 'Test Address', gender: 'Male' },
    { id: 2, name: 'Bhanjo', image: 'Test.jpg', address: 'Kolkata', gender: 'Male' },    
    { id: 3, name: 'Sammi', image: 'Test.jpg', address: 'Kolkata', gender: 'Female' },    
  ];

  displayData(data);
  function displayData(dataArray) {
    const tableBody = $('#tableBody');
    tableBody.empty();
    dataArray.forEach(item => {
      const row = $('<tr>').html(`
        <td>${item.id}</td>
        <td>${item.name}</td>
        <td><img data-src="${item.image}" alt="Image Preview" class="img-fluid"></td>
        <td>${item.address}</td>
        <td>${item.gender}</td>
        <td>
          <button class="btn btn-primary btn-sm" onclick="editEntry(${item.id})" data-toggle="modal" data-target="#editEntryModal">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteEntry(${item.id})" data-toggle="modal" data-target="#deleteEntryModal">Delete</button>
          <button class="btn btn-info btn-sm" onclick="viewEntry(${item.id})" data-toggle="modal" data-target="#viewEntryModal">View</button>
        </td>
      `);
      tableBody.append(row);
    });
  }
</script>
<script>
    function editEntry(id) {
    const index = data.findIndex(item => item.id === id);
    if (index !== -1) {
      $('#editName').val(data[index].name);
    }
  }
  function saveEditedEntry() {
    const newName = $('#editName').val();
    const id = data.findIndex(item => item.name === newName);

    if (id !== -1) {
      data[id].name = newName;
      displayData(data);
      $('#editEntryModal').modal('hide');
    }
  } 
</script>
<script>
    function deleteEntry(id) {
    // Set the id to be deleted
    $('#deleteEntryModal').data('entryId', id);
  }

  function confirmDeleteEntry() {
    const id = $('#deleteEntryModal').data('entryId');
    const index = data.findIndex(item => item.id === id);

    if (index !== -1) {
      data.splice(index, 1);
      displayData(data);
      $('#deleteEntryModal').modal('hide');
    }
  }
</script>
<script>
    function viewEntry(id) {
    const index = data.findIndex(item => item.id === id);
    if (index !== -1) {
      const viewContent = `
        <p><strong>ID:</strong> ${data[index].id}</p>
        <p><strong>Name:</strong> ${data[index].name}</p>
        <p><strong>Image:</strong> <img data-src="${data[index].image}" alt="Image" class="img-fluid"></p>
        <p><strong>Address:</strong> ${data[index].address}</p>
        <p><strong>Gender:</strong> ${data[index].gender}</p>
      `;
      $('#viewEntryBody').html(viewContent);
    }
  }

  function addEntry() {
    const name = $('#name').val();
    const image = $('#image').val();
    const address = $('#address').val();
    const gender = $('#gender').val();

    const newEntry = {
      id: data.length + 1,
      name: name,
      image: image,
      address: address,
      gender: gender
    };

    data.push(newEntry);
    displayData(data);

    // Clear the form fields
    $('#name').val('');
    $('#image').val('');
    $('#address').val('');
    $('#gender').val('');

    // Close the modal
    $('#addEntryModal').modal('hide');
  }
</script>
</body>
</html>
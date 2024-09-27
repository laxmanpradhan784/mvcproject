<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Slider Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .slider-card {
            margin-top: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            background-color: white;
            transition: box-shadow 0.3s;
        }
        .slider-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .slider-img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .status-active {
            color: green;
            font-weight: bold;
        }
        .status-inactive {
            color: red;
            font-weight: bold;
        }
        .btn-group {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h3 class="text-center">Manage Sliders</h3>

        <div class="card p-4 mb-4">
            <h5 class="mb-3">Add New Slider</h5>
            <form id="sliderForm">
                <div class="mb-3">
                    <label for="slider-title" class="form-label">Slider Title</label>
                    <input type="text" class="form-control" id="slider-title" placeholder="Enter slider title" required>
                </div>
                <div class="mb-3">
                    <label for="slider-image" class="form-label">Slider Image</label>
                    <input type="file" class="form-control" id="slider-image" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Add Slider</button>
            </form>
        </div>

        <div class="card p-4">
            <h5 class="mb-3">Existing Sliders</h5>
            <div id="slidersContainer" class="row"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fetch sliders from the database
        function fetchSliders() {
            fetch('fetch_sliders.php')
                .then(response => response.json())
                .then(sliders => {
                    const container = document.getElementById('slidersContainer');
                    container.innerHTML = '';
                    sliders.forEach(slider => {
                        container.innerHTML += `
                        <div class="col-md-4">
                            <div class="slider-card" id="slider-${slider.id}">
                                <img src="${slider.image}" alt="${slider.title}" class="slider-img">
                                <h5 class="mt-2">${slider.title}</h5>
                                <p>Status: <span class="${slider.status === 'active' ? 'status-active' : 'status-inactive'}">${slider.status}</span></p>
                                <div class="btn-group">
                                    <button class="btn btn-warning" onclick="editSlider(${slider.id}, '${slider.title}', '${slider.status}')">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteSlider(${slider.id})">Delete</button>
                                    <button class="btn btn-info" onclick="toggleStatus(${slider.id}, '${slider.status}')">${slider.status === 'active' ? 'Deactivate' : 'Activate'}</button>
                                </div>
                            </div>
                        </div>`;
                    });
                });
        }

        // Add a new slider
        document.getElementById('sliderForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData();
            const title = document.getElementById('slider-title').value;
            const image = document.getElementById('slider-image').files[0];

            formData.append('title', title);
            formData.append('image', image);

            fetch('add_slider.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchSliders(); // Refresh the slider list
                this.reset(); // Reset the form
            })
            .catch(error => console.error('Error:', error));
        });

        // Delete a slider
        function deleteSlider(id) {
            if (confirm("Are you sure you want to delete this slider?")) {
                fetch('delete_slider.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    fetchSliders(); // Refresh the slider list
                })
                .catch(error => console.error('Error:', error));
            }
        }

        // Edit a slider
        function editSlider(id, title, status) {
            const newTitle = prompt("Edit Slider Title:", title);
            const newStatus = prompt("Edit Slider Status (active/inactive):", status);
            if (newTitle && (newStatus === 'active' || newStatus === 'inactive')) {
                fetch('update_slider.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id, title: newTitle, status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    fetchSliders(); // Refresh the slider list
                })
                .catch(error => console.error('Error:', error));
            } else {
                alert("Invalid input.");
            }
        }

        // Toggle status of a slider
        function toggleStatus(id, currentStatus) {
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            fetch('update_slider.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id, title: document.getElementById(`slider-${id}`).getElementsByTagName("h5")[0].innerText, status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchSliders(); // Refresh the slider list
            })
            .catch(error => console.error('Error:', error));
        }

        // Initial fetch of sliders
        fetchSliders();
    </script>
</body>
</html>

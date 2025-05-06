<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
body {
    background: #f7f7ff;
    margin-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full viewport height */
}

.container {
    max-width: 1200px; /* Adjust the max-width as needed */
    width: 100%;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}

.main-body {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.row {
    display: flex;
    justify-content: center;
}

.col-lg-4,
.col-lg-8 {
    display: flex;
    justify-content: center;
}

.col-lg-4 {
    flex: 0 0 30%; /* Adjust the size of the profile card */
}

.col-lg-8 {
    flex: 0 0 60%; /* Adjust the size of the main content */
}

.card-body {
    padding: 20px;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px;
    color: #000;
    cursor: pointer;
}

.close-btn:hover {
    color: red;
}
    </style>
</head>
<body>
    <!-- Profile content wrapped in a container -->
    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="main-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <!-- Profile Picture Section -->
                                                <div class="row mb-3">
                                                    <div class="col-sm-12 text-center">
                                                        <!-- Display current image or default image if none exists -->
                                                        <img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : 'https://i.pinimg.com/474x/07/1a/32/071a32648a9ca4aebad44fa4eb43c276.jpg' }}" class="rounded-circle" width="140" height="140" alt="Profile Image">
                                                        <h4>{{ Auth::user()->name }}</h4>

                                                        <!-- Profile Picture Upload Form -->
                                                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="file" name="profile_picture" class="form-control mt-2">
                                                            <button type="submit" class="btn btn-primary mt-3">Upload</button>
                                                        </form>
                                                    </div>
                                                    @error('profile_picture')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <p class="text-muted font-size-sm">{{ Auth::user()->location }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('profile.update') }}">
                                                @csrf
                                                @method('PATCH')

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Full Name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Email</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>

                                                <!-- Password Change Form -->
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">New Password</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="password" name="new_password" class="form-control" placeholder="Enter new password">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Confirm Password</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm password">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Close Button (X) -->
    <span class="close-btn" onclick="window.location.href='/dash'">&times;</span>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showRatingModal(appointmentId) {
            Swal.fire({
                title: 'Rate and Review Your Service',
                html: `
                    <div class="stars">
                        <input type="radio" id="star5-${appointmentId}" name="rating" value="5" required>
                        <label for="star5-${appointmentId}">⭐</label>

                        <input type="radio" id="star4-${appointmentId}" name="rating" value="4" required>
                        <label for="star4-${appointmentId}">⭐</label>

                        <input type="radio" id="star3-${appointmentId}" name="rating" value="3" required>
                        <label for="star3-${appointmentId}">⭐</label>

                        <input type="radio" id="star2-${appointmentId}" name="rating" value="2" required>
                        <label for="star2-${appointmentId}">⭐</label>

                        <input type="radio" id="star1-${appointmentId}" name="rating" value="1" required>
                        <label for="star1-${appointmentId}">⭐</label>
                    </div>
                    <textarea id="review-${appointmentId}" class="form-control" rows="4" placeholder="Leave a review"></textarea>
                `,
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    const rating = document.querySelector(`input[name="rating"]:checked`)?.value;
                    const review = document.querySelector(`#review-${appointmentId}`).value;
                    if (!rating || !review) {
                        Swal.showValidationMessage('Please select a rating and enter a review');
                        return false;
                    }
                    return { rating: rating, review: review };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the rating and review to the server using axios
                    const rating = result.value.rating;
                    const review = result.value.review;

                    axios.put(`/appointments/${appointmentId}/rate`, { rating, review })
                        .then(response => {
                            Swal.fire('Success!', 'Your rating and review have been submitted.', 'success');
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire('Error!', 'There was an issue submitting your review.', 'error');
                        });
                }
            });
        }
    </script>
</body>
</html>

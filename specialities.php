<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specialties</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/Care Compass.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        @media (max-width: 768px) {
            .d-flex {
                flex-direction: column;
                align-items: center;
            }

            .breadcrumb {
                font-size: 14px;
            }

            .doctor-name {
                font-size: 20px;
            }

            .excard-button {
                font-size: 14px;
                padding: 8px;
            }
            .speciality-card {
                width: 100%;
                min-width: 280px;
            }
        }

        @media (max-width: 480px) {
            .breadcrumb {
                padding: 10px;
            }

            .doctor-name {
                font-size: 18px;
            }

            .speciality-card {
                max-width: 280px;
            }

            .excard-button {
                font-size: 13px;
                padding: 6px;
            }
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>
    <!-- Breadcrumb -->
    <div class="breadcrumb bg">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-items"><a href="home.html">Home > </a></li>
                    <li class="breadcrumb-items active" aria-current="page">Specialties</li>
                </ol>
            </nav>
            <h3 class="doctor-name">Specialties</h3>
        </div>
    </div>

    <div class="container mb-5">

        <div class="d-flex flex-wrap justify-content-center mt-md-5">
            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence.png" class="card-img-top" alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Cardiology Center of Excellence</button>
                    </div>
                </a>
            </div>

            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence8.Webp" class="card-img-top"
                            alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">General Surgery Center of Excellence</button>
                    </div>
                </a>
            </div>

            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence7.Webp" class="card-img-top"
                            alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Paediatric Center of Excellence</button>
                    </div>
                </a>
            </div>

            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence.png" class="card-img-top" alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Neurology Center of Excellence</button>
                    </div>
                </a>
            </div>

            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence5.Webp" class="card-img-top"
                            alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Pulmonology Center of Excellence</button>
                    </div>
                </a>
            </div>

            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence2.png" class="card-img-top"
                            alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Endocrinology Center of Excellence</button>
                    </div>
                </a>
            </div>

            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence3.png" class="card-img-top" alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Nephrology Center of Excellence</button>
                    </div>
                </a>
            </div>

            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence4.Webp" class="card-img-top"
                            alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Orthopedic Center of Excellence</button>
                    </div>
                </a>
            </div>

            <div class="speciality-card">
                <a href="#">
                    <div class="card">
                        <img src="assets/images/excellence6.Webp" class="card-img-top"
                            alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Gastroenterology Center of Excellence</button>
                    </div>
                </a>
            </div>
        </div>

        <!-- <div class="d-flex justify-content-center mt-3 mb-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="doctors.html?page=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="/doctors.html/2">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div> -->
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>
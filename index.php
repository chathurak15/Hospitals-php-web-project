<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospitals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include("header.php"); ?>
    <!-- hero section -->
    <section class="hero">
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-7 col-sm-12 align-self-center">
                    <h3 class="hero-title">We Care <br />
                        <span class="hero-sub-title">about your health</span>
                    </h3>
                    <p class="hero-description mt-4">Good health is the state of mental, physical and social well being
                        and it does not just mean absence of diseases.
                    </p>
                    <div class="row mt-5 align-items-center ">
                        <div class="col-md-6 col-sm-12 mb-3 mb-md-0">
                            <a href="appointment.php"> <button type="button" class="hero-button">
                                Book an appointment
                                <img src="assets/images/Vector.png" class="ms-3" alt="arrow">
                            </button></a>
                        </div>
                    </div>

                    <!-- find a doctor section -->
                    <div class="container search-card mt-5">
                        <h4 class="mb-4">Find a doctor</h4>
                        <form method="get" class="row g-3 align-items-center" action="doctors.php">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Name of Doctor" name="doctor" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Speciality" name="specialityName">
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="availabilitySwitch"> Availability</label>
                                    <input class="form-check-input" type="checkbox" id="availabilitySwitch" name="availability" value="1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" name="submit" value="Submit" class="search-btn w-100">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-5 col-sm-12 text-center">
                    <img src="assets/images/hero circle.png" alt="hero image">
                </div>
            </div>
        </div>
    </section>

    <!-- OUR CENTRES OF EXCELLENCE section -->
    <section class="excellence mt-5">
        <div class="container pt-5">
            <h3 class="section-title text-center">OUR CENTRES OF <span class="second-word"> EXCELLENCE</span></h3>
            <div class="col-md-8 offset-md-2 my-3">
                <p class="section-description text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Semper ultrices sed adipiscing malesuada aliquam nisl fusce sit. Scelerisque suspendisse feugiat
                    lectus nulla ullamcorper porttitor purus enim.
                    Volutpat mattis amet semper volutpat odio. Risus faucibus interdum volutpat nibh venenatis.
                </p>

            </div>
            <div class="row ex-row mt-5">
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <img src="assets/images/excellence.png" class="card-img-top"
                            alt="Cardiology Center of Excellence">
                        <button type="button" class="excard-button">Cardiology Center of Excellence</button>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <img src="assets/images/excellence2.png" class="card-img-top"
                            alt="General Surgery Center of Excellence">
                        <button type="button" class="excard-button">General Surgery Center of Excellence</button>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <img src="assets/images/excellence3.png" class="card-img-top"
                            alt="Paediatric Center of Excellence">
                        <button type="button" class="excard-button">Paediatric Center of Excellence</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- welcome & about us section -->
    <section class="welcome">
        <div class="container mt-5">
            <div class="row ">
                <div class="col-md-6 col-sm-12 p-md-4 d-flex flex-column justify-content-center">
                    <h3 class="welcome-title">Welcome to <span class="welcome-sub">Care Compass Hospitals</span></h3>
                    <p class="welcome-description mt-2">Care Compass employs, consults, and partners with the most
                        dedicated,
                        skilled, and experienced healthcare professionals to offer some of the country’s most advanced,
                        evidence based clinical programmes for treating complex diseases, through our Centres of
                        Excellence.
                        We have a sound record for offering outstanding outcomes.
                        <br />
                        <br />
                        Care Compass also offers treatment for increasingly common lifestyle-based diseases, preventive
                        healthcare,
                        and the most complete menu of diagnostic tests.
                        <br />
                        <br />
                        All Care Compass Hospitals have international accreditation.
                    </p>

                    <div class="mt-3 d-flex align-items-center">
                        <a href="appointment.php" class="appointment-link">
                            <i class="fas fa-calendar-alt me-1" title="Schedule your appointment"></i> Online
                            Appointment

                        </a>
                        <a href="specialities.php" class="appointment-link ms-md-5 ms-2">
                            <i class="fas fa-info-circle me-1" title="More information"></i>Our Specialities
                        </a>
                    </div>
                    <button type="button" class="welcome-button mt-4 ">Read More</button>
                </div>
                <div class="welcome-img col-md-6 col-sm-12 p-5">
                    <img src="assets/images/welcome.png" alt="welcome image">
                </div>

            </div>
        </div>
    </section>

    <!-- book Appointment section -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-12 p-0">
                <img src="assets/images/book.jpg" alt="Medical Team" class="doctor-image w-100 h-100 object-fit-cover">
            </div>
            <div class="col-md-6 col-sm-12 appointment-section p-md-5 p-3 text-center text-md-start">
                <div class="appointment-content mb-4">
                    <h2 class="appoinment-title fw-bold">Book an <span class="welcome-sub">Appointment</span></h2>
                    <p class="appointment-description mt-3">
                        To reach out to our <strong>Care Compass Hospital</strong> Team, please fill in the form below.
                        Our team members will get back to you shortly.
                    </p>
                    <a href="appointment.php"><button type="button" class="btn btn-primary mt-3 w-100 w-md-auto">Book an Appointment Now</button></a>
                </div>
                <div>
                    <a href="contactus.php#feedback" class="btn btn-info w-100 w-md-auto mb-4">Give Feedback</a>
                </div>

                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center justify-content-md-start">
                    <a href="checkAppointment.php" class="btn btn-success w-100 w-md-auto">Check Appointment Status</a>
                    <a href="#" class="btn btn-success w-100 w-md-auto">View Medical Reports</a>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>

    <!-- doctors slider -->
    <div class="container doctor-slider mt-5">
        <h3 class="slider-title">OUR <span>DOCTORS</span></h3>

        <div class="carousel-container">
            <div class="carousel-track">
                <?php
                include 'functions/doctors.php';
                include 'db/config.php';

                // Fetch all doctors at once since pagination is handled by JS
                $doctors = getDoctorsWithPagination($conn, 0, getDoctorsCount($conn));

                foreach ($doctors as $doctor):
                    if ($doctor['image'] == null) {
                        $doctor['image'] = 'profile.png';
                    }
                ?>
                    <div class="col-md-3 col-sm-12 doctor-card p-4">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 p-0 ">
                                <img src="assets/images/uploads/<?= $doctor['image'] ?>" alt="Doctor" class="doctor-img">
                            </div>
                            <div class="col-md-8 col-sm-12 p-2 ps-3">
                                <h3 class="doctor-name p-0 mt-2">Dr.<?= $doctor['name'] ?></h3>
                                <p class="doctor-specialty">Doctor Speciality</p>
                                <p class="doctor-info">
                                    <i class="fa fa-stethoscope me-1"></i><?= $doctor['experience'] ?> Experience
                                </p>
                                <p class="doctor-info">
                                    <i class="fa fa-language me-1"></i><?= $doctor['language'] ?>
                                </p>
                            </div>
                        </div>
                        <hr class="line" />
                        <p class="doctor-info">
                            <i class="fa fa-map-marker-alt me-1"></i> Care Compass Hospital
                        </p>
                        <p class="doctor-info">
                            <i class="fa fa-graduation-cap me-1"></i> <?= $doctor['certificates'] ?>
                        </p>
                        <div class="mt-3 d-flex justify-content-center">
                            <a href="doctor.php?id=<?= $doctor['id'] ?>"><button class="btn btn-profile">Doctor Profile</button></a>
                            <form action="appointment.php" method="post">
                                <input type="hidden" name="doctor" value="<?= $doctor['id'] ?>">
                                <button class="btn btn-appointment" name="search" value="Search">Book Appointment</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="slider-dots mb-5">
            <?php
            include 'db/config.php';
            for ($i = 0; $i < ceil(getDoctorsCount($conn) / 3); $i++): ?>
                <span class="dot <?= $i === 0 ? 'active' : '' ?>"></span>
            <?php endfor; ?>
        </div>
    </div>
    
    <!-- Contact us section -->
    <section>
        <div class="container">
            <div class="row contact-section">
                <div class="col-md-7 col-sm-12 p-0">
                    <video src="assets/images/1.mp4" class="contact-video w-100 h-100 object-fit-cover" controls
                        title="video"></video>

                </div>
                <div class="col-md-5 col-sm-12 contact-details py-5 ps-md-5">
                    <div class="contact-content me-md-5">
                        <h3 class="contact-title">Contact
                            <span class="contact-sub">Information</span>
                        </h3>

                        <div class="contact-info d-flex mt-4 ">
                            <div class="col-md-4 col-sm-12 me-1 contact-card">
                                <p class="contact-description mt-3"> <span>Colombo</span><br />
                                    1234 Main Street<br />
                                    Colombo,<br /> Sri Lanka<br />
                                    123-456-7890<br />
                                </p>
                                <a href=""><button type="button" class="direction-btn"><i
                                            class="fa fa-map-marker me-1"></i>Location</button></a>
                            </div>

                            <div class="col-md-4 col-sm-12 me-1 contact-card">
                                <p class="contact-description mt-3"><span>Kandy </span><br />
                                    1234 Main Street<br />
                                    Kandy,<br /> Sri Lanka<br />
                                    123-456-7890<br />
                                </p>
                                <a href=""><button type="button" class="direction-btn"><i
                                            class="fa fa-map-marker me-1"></i>Location</button></a>
                            </div>
                            <div class="col-md-4 col-sm-12 me-1 contact-card">
                                <p class="contact-description mt-3"><span>Kurunagala </span><br />
                                    1234 Main Street<br />
                                    Kurunagala,<br /> Sri Lanka<br />
                                    123-456-7890<br />
                                </p>
                                <a href=""><button type="button" class="direction-btn"><i
                                            class="fa fa-map-marker me-1"></i>Location</button></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- feedback section  -->
    <section class="feedback mt-5">
        <div class="container mt-5">
            <h3 class="feedback-title text-center">Inspiring <span class="feedback-sub">Stories!</span></h3>
            <div class="carousel-container">
                <div class="carousel-tracker">

                    <?php
                    include 'db/config.php';
                    include 'functions/patients.php';
                    $feedbacks = getAllApprovedFeedbacks($conn, 0, getFeedbacksCount($conn));
                    foreach ($feedbacks as $feedback):
                        if ($feedback['image'] == null) {
                            $feedback['image'] = 'profile.png';
                        }
                    ?>
                        <!-- feedback Card 1 -->
                        <div class="col-md-5 col-sm-12 feedback-card p-4 mx-4">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-sm-6 p-0 ps-3">
                                    <img src="assets/images/uploads/patients/<?= $feedback['image'] ?>" alt="Doctor" class="feedback-img">
                                </div>
                                <div class="col-md-9 col-sm-6 p-4">
                                    <h3 class="pname m-0"><?= $feedback['name'] ?></h3>
                                    <p class="pBranch mt-1"><?= $feedback['location'] ?? 'Care Compass ' ?> Hospital - <?= $feedback['date'] ?></p>

                                </div>
                            </div>
                            <div class="feedback-info">
                                <p class="feedback-description mt-0"><?= $feedback['message'] ?></p>

                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- <div class="col-md-5 col-sm-12 feedback-card p-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 col-sm-6 p-0 ps-3">
                                <img src="assets/images/doctor2.jpg" alt="Doctor" class="feedback-img">
                            </div>
                            <div class="col-md-9 col-sm-6 p-4">
                                <h3 class="pname m-0">Chathura kavindu</h3>
                                <p class="pBranch mt-1">Colombo Hospital</p>
                            </div>
                        </div>
                        <div class="feedback-info">
                            <p class="feedback-description mt-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at amet eu, non vel
                                netus duis enim quis. Arcu nibh nam eget lectus lacus mauris.
                                Tellus in ut aliquam neque mi enim. Accumsan eget adipiscing lacinia
                                lacus viverra tortor, feugiat. In amet, morbi tincidunt bibendum.
                                In urna consectetur elementum id malesuada molestie.
                            </p>
                        </div>
                    </div> -->

                </div>
            </div>

            <div class="slider-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>

        </div>
    </section>

    <!-- news section -->
    <section class="news-section mt-5">
        <div class="container news py-5">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <h3 class="news-section-title">CARE COMPASS <span class="news-sub">NEWS</span></h3>
                    <P class="news-section-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Lectus in mauris facilisis semper sapien. Risus aliquam egestas non duis lacus at.
                        Eu sapien consectetur mattis aliquet ipsum etiam scelerisque a.
                        Sed elementum pulvinar porta eleifend elit diam mattis iaculis.
                        Ac vitae pellentesque aliquam augue.
                    </P>
                    <a><button type="button" class="read-all">READ ALL NEWS</button></a>
                </div>
                <div class="col-md-8 col-sm-12 m-0">
                    <div class="d-flex">
                        <div class="col-md-4 col-sm-12 news-card p-4 me-2">
                            <h3 class="news-title">
                                Helping Seniors Learn New Hobbies
                            </h3>
                            <p class="news-date">
                                05 September 2025
                            </p>
                            <p class="news-descrition">Lorem ipsum dolor sit amet, vel te doming repudiare, eum nihil
                                voluptatum ne, tollit.</p>
                            <button type="button" class="read-more">READ MORE</button>
                        </div>
                        <div class="col-md-4 col-sm-12 news-card p-4 me-2">
                            <h3 class="news-title">
                                Helping Seniors Learn New Hobbies
                            </h3>
                            <p class="news-date">
                                05 September 2025
                            </p>
                            <p class="news-descrition">Lorem ipsum dolor sit amet, vel te doming repudiare, eum nihil
                                voluptatum ne, tollit.</p>
                            <button type="button" class="read-more">READ MORE</button>
                        </div>
                        <div class="col-md-4 col-sm-12 news-card p-4 me-2">
                            <h3 class="news-title">
                                Helping Seniors Learn New Hobbies
                            </h3>
                            <p class="news-date">
                                05 September 2025
                            </p>
                            <p class="news-descrition">Lorem ipsum dolor sit amet, vel te doming repudiare, eum nihil
                                voluptatum ne, tollit.</p>
                            <button type="button" class="read-more">READ MORE</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <?php include("footer.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const track = document.querySelector(".carousel-track");
            const cards = document.querySelectorAll(".doctor-card");
            const dots = document.querySelectorAll(".dot");
            let currentIndex = 0;
            const cardWidth = cards[0].offsetWidth + 20;
            const totalSlides = Math.ceil(cards.length / 3);
            let start = 0;
            let end = 3;

            function updateStartEnd() {
                start = currentIndex * 3;
                end = start + 3;
            }

            function moveSlide(index) {
                currentIndex = index;
                updateStartEnd();
                track.style.transform = `translateX(-${index * cardWidth * 3}px)`;
                dots.forEach(dot => dot.classList.remove("active"));
                dots[index].classList.add("active");
            }

            function autoSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                moveSlide(currentIndex);
            }

            let slideInterval = setInterval(autoSlide, 6000);

            dots.forEach((dot, index) => {
                dot.addEventListener("click", () => {
                    clearInterval(slideInterval);
                    moveSlide(index);
                    slideInterval = setInterval(autoSlide, 5000); // Restart auto-slide
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const track = document.querySelector(".carousel-tracker");
            const cards = document.querySelectorAll(".feedback-card");
            const dots = document.querySelectorAll(".dot");
            let currentIndex = 0;
            const cardWidth = cards[0].offsetWidth + 20;
            const totalSlides = Math.ceil(cards.length / 2);
            let start = 0;
            let end = 2;

            function updateStartEnd() {
                start = currentIndex * 2;
                end = start + 2;
            }

            function moveSlide(index) {
                currentIndex = index;
                updateStartEnd();
                track.style.transform = `translateX(-${index * cardWidth }px)`;
                dots.forEach(dot => dot.classList.remove("active"));
                dots[index].classList.add("active");
            }

            function autoSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                moveSlide(currentIndex);
            }

            let slideInterval = setInterval(autoSlide, 6000);

            dots.forEach((dot, index) => {
                dot.addEventListener("click", () => {
                    clearInterval(slideInterval);
                    moveSlide(index);
                    slideInterval = setInterval(autoSlide, 5000); // Restart auto-slide
                });
            });
        });
    </script>


</body>

</html>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inquiry'])) {
    include 'functions/patients.php';
    include 'db/config.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $message = $_POST['message'];

    $response = addInquiry($conn, $name, $email, $phone, $message);
    echo "<script>alert('$response'); window.location.href='contactus.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['feedback'])) {
    include 'functions/patients.php';
    include 'db/config.php';
    include 'functions/image.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $location = $_POST['location'];
    $image;
    $traget_dir = 'assets/images/uploads/patients/';

    if (($_FILES['file'])['name'] == '') {
        $image = '';
    } else {
        $imageUpdate = image($_FILES['file'], $traget_dir);
        if ($imageUpdate == '') {
            echo "<script>alert('Failed to upload image! Image already exited. Please rename and try again')</script>";
        } else {
            $image = $imageUpdate;
        }
    }
    $response = addFeedback($conn, $name, $email, $image, $message, $location);
    echo "<script>alert('$response'); window.location.href='contactus.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospitals</title>
    <sc src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
        <style>
            :root {
                --primary: #222F66;
                --secondary: #DEAA4E;
                font-family: 'Poppins', sans-serif;
            }

            .hero {
                background-image: url('assets/images/bg1.jpg');
                background-size: cover;
                background-position: center;
                margin-top: 1rem;

                color: white;
                padding: 1.5rem 0rem;
                text-align: center;
                margin-bottom: 3rem;
            }

            .hero h1 {
                font-size: 2.1rem;
                margin-bottom: 0.5rem;
                font-weight: 700;
            }

            .section {
                margin-bottom: 3rem;
            }

            .card {
                background: linear-gradient(to right, #f8f9fa, #e4f2fc);
                border-radius: 8px;
                padding: 1.5rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 2rem;
            }

            .sub-title {
                color: var(--primary);
                font-size: 1.4rem;
                margin-top: 1rem;
            }

            .card p {
                font-size: 1.1rem;
            }

            .contact-info {
                display: flex;
                gap: 2rem;
                width: 100%;
                justify-content: space-between;
                margin-top: 1rem;
            }

            .contact-card {
                width: 33%;
                text-align: center;
                padding: 1.5rem;
                border: 2px solid var(--primary);
                border-radius: 15px;
            }


            .contact-description {
                color: var(--primary);
                font-weight: 500;
                font-size: 17px;
            }

            .contact {
                background-image: url('assets/images/doc_bg.png');
                background-size: cover;
                background-position: center;
                margin-top: 1rem;
                padding: 4rem 0rem;
            }

            .contact-form {
                max-width: 650px;
                margin: 0;
                padding: 1rem 2rem 2rem 2rem;
                border-radius: 15px;
                background: white;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.653);
                margin-bottom: 3rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            input,
            textarea {
                width: 98%;
                padding: 0.8rem;
                border: 1px solid #ddd;
                border-radius: 15px;
                font-size: 1rem;
                font-weight: 500;
            }

            button {
                background: var(--primary);
                color: white;
                padding: 0.8rem 2rem;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                font-size: 1rem;
                transition: background 0.3s;
            }

            button:hover {
                background: var(--secondary);
            }

            .feedback-section {
                background: rgba(204, 230, 255, 0.6);
                padding: 2rem 0rem;
            }

            .feedback {

                display: grid;
                align-items: center;
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
                margin-top: 0rem;
                padding: 1.5rem 0rem;
                text-align: center;
                padding-top: 50px;
                padding-bottom: 40px;

            }

            .feedback img {
                margin: 0;
                width: 95%;
                border-radius: 15px;
                align-content: center;
            }

            .feedback-form {
                justify-self: end;
                margin: 0;
                padding: 1rem 2rem 2rem 2rem;
                border-radius: 15px;
                background: white;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.653);
            }

            @media (max-width: 768px) {
                .hero h1 {
                    font-size: 1.7rem;
                    margin-bottom: 1rem;
                }

                .card {
                    background: linear-gradient(to right, #f8f9fa, #e4f2fc);
                    padding: 0.5rem;
                    margin-top: 0.2rem;

                }

                .sub-title {
                    text-align: center;
                    color: var(--primary);
                    font-size: 1.4rem;
                    margin-top: 1rem;
                }

                .card p {
                    text-align: justify;
                    font-size: 1rem;
                }

                .location-title {
                    text-align: center;
                    font-size: 1.5rem;
                    margin-top: 1rem;
                }

                .contact-info {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    align-content: center;
                }

                .contact-card {
                    width: 90%;
                    text-align: center;
                    padding: 1.5rem;
                    border: 1px solid #ddd;
                    border-radius: 15px;
                }

                .contact {
                    padding: 0.8rem 0;
                }

                .contact-form {
                    max-width: 100%;
                    padding: 1rem 1rem 1rem 1rem;
                    margin-bottom: 3rem;
                }

                input,
                textarea {
                    width: 100%;
                    padding: 0.8rem;
                    border: 1px solid #ddd;
                    border-radius: 15px;
                    font-size: 0.9rem;
                    font-weight: 400;
                }

                .container {
                    padding: 15px;
                }

                .feedback {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }

                .feedback img {
                    max-width: 100%;
                    height: auto;
                    margin-bottom: 15px;
                }

                .feedback-form {
                    width: 100%;
                }

                .feedback-form h2 {
                    font-size: 24px;
                }

                .feedback-form p {
                    font-size: 16px;
                }

                .form-group {
                    width: 100%;
                    margin-bottom: 10px;
                }

                .form-group input,
                .form-group select,
                .form-group textarea {
                    width: 100%;
                    padding: 10px;
                    font-size: 16px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                button[type="submit"] {
                    width: 100%;
                    padding: 12px;
                    font-size: 18px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }

                button[type="submit"]:hover {
                    background-color: #0056b3;
                }

            }
        </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <!-- About Us Page -->
    <section id="about">
        <div class="hero">
            <h1>About Care Compass Hospitals</h1>
            <p>Leading Healthcare Provider in Sri Lanka</p>
        </div>

        <div class="container">
            <div class="section">
                <div class="card">
                    <h3 class="sub-title">Our Story</h3>
                    <p>Care Compass Hospitals is a well-reputed private hospital network registered under the Ministry
                        of Health (MoH). We are committed to providing exceptional healthcare services through our
                        state-of-the-art facilities and experienced medical professionals.</p>

                    <h3 class="sub-title">Our Vision</h3>
                    <p>To be a leading healthcare provider in South Asia with the highest quality of clinical standards.
                    </p>

                    <h3 class="sub-title">Our Mission</h3>
                    <p>To care for and improve the quality of human life, through the provision of ethical healthcare
                        solutions using cutting-edge technology.</p>

                    <h3 class="sub-title">Our Values</h3>
                    <p>
                        <i class="fa-solid fa-star"></i>
                        Caring with a human touch.<br />
                        <i class="fa-solid fa-star"></i>
                        Caring for society.<br />
                        <i class="fa-solid fa-star"></i>
                        Caring for our employees.<br />
                        <i class="fa-solid fa-star"></i>
                        Innovation and forward-focus.<br />
                        <i class="fa-solid fa-star"></i>
                        Respect for all stakeholders.
                    </p>

                    <h3 class="sub-title">Quality and Safety</h3>
                    <p><i class="fa-solid fa-shield-check"></i>
                        Our commitment to quality and safety is evident through our global accreditations: Joint
                        Commission International (JCI) and Australian Council of Health Standards International
                        (ACHSI).<br /><br />
                        <i class="fa-solid fa-shield-check"></i>
                        Care Compass Laboratories holds industry-specific and quality management ISO certifications.
                    </p>

                    <h3 class="sub-title">Why Care Compass?</h3>
                    <p>
                        <i class="fa-solid fa-lightbulb"></i>
                        Our name translates to 'a blessing,' reflecting our commitment to being your beacon for health
                        and wellness.<br /><br />
                        <i class="fa-solid fa-lightbulb"></i>
                        Adhering to rigorous international standards, all our hospitals have international
                        accreditations<br /><br />
                        <i class="fa-solid fa-lightbulb"></i>
                        We offer the country’s most advanced, evidence-based clinical programs for treating extremely
                        complex diseases, with a sound record of positive outcomes. <br /><br />
                        <i class="fa-solid fa-lightbulb"></i>
                        Care Compass Health also offers treatment for increasingly common lifestyle-based diseases,
                        preventive
                        healthcare, and the most complete menu of diagnostic tests.
                    </p>
                </div>
            </div>

            <div class="section">
                <h2 class="location-title">Our Locations</h2>

                <div class="contact-info mt-4 ">
                    <div class="me-1 contact-card">
                        <h3>Colombo</h3>
                        <p>Our flagship hospital equipped with cutting-edge medical technology and specialist care.</p>
                        <p class="contact-description">
                            1234 Main Street<br />
                            Colombo,<br /> Sri Lanka<br />
                            +94112131415<br />
                        </p>
                        <a href="https://maps.app.goo.gl/kuUmoKhSCP5BxW2n7"><button type="button" class="direction-btn"><i
                                    class="fa fa-map-marker me-1"></i>Location</button></a>
                    </div>

                    <div class="me-1 contact-card">
                        <h3>Kandy</h3>
                        <p>Serving the central region with comprehensive healthcare services.</p>
                        <p class="contact-description">
                            1234 Main Street<br />
                            Kandy,<br /> Sri Lanka<br />
                            +94112131425<br />
                        </p>
                        <a href="https://maps.app.goo.gl/kuUmoKhSCP5BxW2n7"><button type="button" class="direction-btn"><i
                                    class="fa fa-map-marker me-1"></i>Location</button></a>
                    </div>
                    <div class="me-1 contact-card">
                        <h3>Kurunegala</h3>
                        <p>Providing accessible healthcare to the North Western Province.</p>
                        <p class="contact-description">
                            1234 Main Street<br />
                            Kurunagala,<br /> Sri Lanka<br />
                            +94112131420<br />
                        </p>
                        <a href="https://maps.app.goo.gl/kuUmoKhSCP5BxW2n7"><button type="button" class="direction-btn"><i
                                    class="fa fa-map-marker me-1"></i>Location</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Page -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="contact-form">
                <h2 class="location-title">Inquire Now</h2>
                <p>Have a question or need assistance? Fill out the form below and we'll get back to you as soon as
                    possible.</p>
                <form id="contactForm" method="post" onsubmit="return handleSubmit(event)">
                    <input type="hidden" name="inquiry" value="inquiry">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Name *">
                    </div>

                    <div class="form-group">
                        <input type="text" id="number" name="number" placeholder="Your Contact Number (+94789362885) *">
                    </div>

                    <div class="form-group">
                        <input type="email" id="email" placeholder="Your Email Address" name="email">
                    </div>

                    <div class="form-group">
                        <textarea id="message" rows="3" name="message" placeholder="Message *"></textarea>
                    </div>
                    <button type="submit">Send Message</button>
                </form>
            </div>


        </div>
    </section>

    <section id="feedback" class="feedback-section">
        <div class="container">
            <div class="feedback">
                <div>
                    <img src="assets/images/p.jpg" alt="Feedback">
                </div>
                <div class="feedback-form">
                    <h2 class="location-title">Feedback</h2>
                    <p>Share your feedback with us. We value your opinion and strive to provide the best service possible.
                    </p>
                    <form id="feedbackForm" method="post" enctype="multipart/form-data" onsubmit="return validateFeedbackForm(event)">
                        <input type="hidden" name="feedback" value="feedback">
                        <div class="form-group">
                            <input type="text" id="fname" name="name" placeholder="Name (Required)">
                        </div>
                        <div class="form-group">
                            <select id="flocation" name="location" class="form-select">
                                <option value="" selected>Select Location</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Kurunegala">Kurunegala</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="email" id="femail" placeholder="Your Email Address (Optional)" name="email">
                        </div>
                        <div class="form-group">
                            <input type="file" id="file" name="file" placeholder="Upload File (Optional)" accept="image/*">
                        </div>
                        <div class="form-group">
                            <textarea id="fmessage" rows="4" name="message" placeholder="FeedBack (Required)"></textarea>

                        </div>
                        <button type="submit">Send Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        function handleSubmit(event) {
            event.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            const number = document.getElementById('number').value;

            const nameRegex = /^[a-zA-Z\s]{2,50}$/;
            const phoneRegex = /^\+94[1-9][0-9]{8}$/;
            const messageRegex = /^.{6,500}$/;

            if (!name || !message || !number) {
                alert('Please fill all the requirements fields');
                return;
            }

            let errors = [];
            if (!nameRegex.test(name)) {
                errors.push("Name should only contain letters and be 2-50 characters long.");
            }
            if (!phoneRegex.test(number)) {
                errors.push("Phone number must be in +947XXXXXXXX format.");
            }
            if (!messageRegex.test(message)) {
                errors.push("Message should be 6-500 characters long.");
            }

            if (errors.length > 0) {
                alert(errors.join("\n")); // Show all errors at once
                return false;
            }
            
            document.getElementById("contactForm").submit();
        };

        function validateFeedbackForm(event) {
            event.preventDefault();
            const name = document.getElementById("fname").value;
            const location = document.getElementById("flocation").value;
            const email = document.getElementById("email").value;
            const file = document.getElementById("file").files[0];
            const message = document.getElementById("fmessage").value;

            const nameRegex = /^[a-zA-Z\s]{2,50}$/;
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const messageRegex = /^.{6,500}$/;
            const allowedFileTypes = ["image/jpeg", "image/png", "image/gif"];

            let errors = [];

            if (!name || !nameRegex.test(name)) {
                errors.push("Name should only contain letters and be 2-30 characters long.");
            }

            if (!location) {
                errors.push("Please select a location.");
            }
            // Validate Email (only if entered)
            if (email && !emailRegex.test(email)) {
                errors.push("Please enter a valid email address.");
            }
            // Validate File (only if uploaded)
            if (file && !allowedFileTypes.includes(file.type)) {
                errors.push("Only JPG, PNG, or GIF images are allowed.");
            }
            // Validate Message
            if (!message || !messageRegex.test(message)) {
                errors.push("Message should be 6-500 characters long.");
            }
            // Display errors or return true if valid
            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }

            document.getElementById("feedbackForm").submit();
        }
    </script>
</body>

</html>
<?php
include 'db/config.php';
include 'functions/appointment.php';

$appointment = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment = getAppointmentbyCondition($conn, $_POST['name'], $_POST['id'], $_POST['phoneNumber'], $_POST['nic']);
    
    if ($appointment) {
        $name = $appointment['name'];
        $nic = $appointment['nic'];
        $phone = $appointment['mobile_number'];
        $doctor = $appointment['doctor_name'];
        $date = $appointment['date'];
        $time = $appointment['time'];
        $status = $appointment['status'];
        $appointmentId = $appointment['id'];

        echo "<script>alert('$name! your Appointment Status: $status');</script>";

    } else {
        echo "<script>alert('No appointment found!');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Appointment Status Checker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css" />

    <style>
        .hidden {
            display: none;
        }

        .visible {
            display: block;
        }

        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f3f4f6;
            color: #111827;
            line-height: 1.5;
        }

        

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h2 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #6b7280;
            font-size: 0.875rem;
        } */

        .check {
            max-width: 28rem;
            margin: 0 auto;
            padding: 3rem 1rem;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            animation: fadeIn 0.5s ease-out;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            transition: border-color 0.15s ease-in-out;
        }

        input:focus {
            outline: none;
            border-color: #9b87f5;
            box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.1);
        }

        button {
            width: 100%;
            padding: 0.625rem 1.25rem;
            background-color: #9b87f5;
            color: white;
            border: none;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }

        button:hover {
            background-color: #7E69AB;
        }

        button:disabled {
            opacity: 0.75;
            cursor: not-allowed;
        }

        .spinner {
            display: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #ffffff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 0.5rem;
        }

        .loading .spinner {
            display: inline-block;
        }

        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .details-header h3 {
            font-size: 1.125rem;
            font-weight: 500;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            color: white;
        }

        .status-pending {
            background-color: #FFA500;
        }

        .status-confirmed {
            background-color: #22C55E;
        }

        .status-cancelled {
            background-color: #EF4444;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 1fr 2fr;
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row dt {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .detail-row dd {
            color: #111827;
            font-size: 0.875rem;
        }

        .hidden {
            display: none;
        }

        .toast {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            padding: 1rem;
            background-color: #22C55E;
            color: white;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .toast.show {
            opacity: 1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 1.5rem 1rem;
            }

            .detail-row {
                grid-template-columns: 1fr;
                gap: 0.25rem;
            }
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">


        <div class="check">


        <div class="appointmentForm">
                <form id="appointmentForm" method="post">
                    <div class="form-group">
                        <label for="patientName">Patient Name</label>
                        <input type="text" id="patientName" name="name" placeholder="Eg: Chathura " required>
                    </div>
                    <div class="form-group">
                        <label for="patientName">Appointment ID</label>
                        <input type="text" id="patientName" name="id" placeholder="Eg: 1" required>
                    </div>

                    <div class="form-group">
                        <label for="nic">NIC Number</label>
                        <input type="text" id="nic" name="nic" required>
                    </div>

                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="+94789362885" required>
                    </div>

                    <button type="submit" id="submitBtn" value="submit" name="submit">
                        <span id="btnText">Check Status</span>
                        <div class="spinner" id="spinner"></div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
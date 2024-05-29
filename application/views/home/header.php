<!doctype html>
<html lang="en">

<head>
    <title>Buku Tamu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        body,
        html {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            overflow-y: scroll;
            height: 100%;
        }

        .container {
            width: 100%;
            padding: 20px;
            height: auto;
            margin-bottom: 0;
            min-height: 90vh;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            margin: auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            width: 80%; /* Increased width */
            max-width: 100%;
            max-height: 95%;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            overflow-y: auto; /* Make modal content scrollable */
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-header {
            text-align: center;
        }

        .modal-title {
            font-size: 24px;
        }

        .modal-body {
            font-size: 16px;
        }

        .slideshow-container {
            max-width: 1000px;
            margin: auto;
            position: relative;
        }

        .mySlides {
            display: none;
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 20px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev {
            left: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #555;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #333;
        }

        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
            animation-fill-mode: both;
        }

        @keyframes fade {
            from {
                opacity: 0.4;
            }
            to {
                opacity: 1;
            }
        }

        .img {
            background-size: cover;
            background-position: center;
            width: 100%;
            min-height: 100%;
        }

        #exit {
            max-height: 1000px;
            width: 100%;
        }

        #exit img {
            height: 500px;
        }

        #checkbox {
            margin-top: 10px;
        }

        #save {
            padding: 8px;
            margin-top: 10px;
            border-radius: 20px;
            margin: 5px;
            width: 100%;
        }

        .login-wrap {
            width: 100%;
            padding: 20px;
        }

        .login-wrap .form-control {
            border-radius: 20px;
        }

        .login-wrap .btn {
            border-radius: 20px;
        }

        .login-wrap .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        #exitt1 {
            width: 200px;
            height: 300px;
        }

        #pintu2 {
            width: 300px;
            height: 200px;
        }

        @media (max-width: 600px) {
            .wrap .img {
                height: 175px;
            }

            #form-title {
                font-size: 20px;
                margin-top: -15px;
            }

            .form-group {
                margin-top: -15px;
            }

            #label-form {
                font-size: 12px;
            }

            #nama,
            #aslpt,
            #ygdituju {
                height: 30px;
            }

            #makkun {
                height: 50px;
            }

            #btn {
                justify-content: center;
            }

            #btn .btn {
                width: 100vh;
                margin-bottom: 15px;
            }

            .modal-title {
                font-size: 12px;
            }

            .card {
                height: 80vh;
            }

            #exitt1 {
                width: 100px;
                height: 150px;
            }

            #pintu2 {
                width: 150px;
                height: 100px;
            }

            #firstModal p,
            ul li {
                font-size: 11px;
                max-height: 300px;
            }

            #secondModal p,
            ol li {
                font-size: 11px;
                max-height: 300px;
            }
            #thirdModal p,
            ol li {
                font-size: 8px;
                max-height: 300px;
            }

            .modal-table tbody tr th,
            td {
                font-size: 6px;
            }

            .form-check .save {
                padding-left: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 8px;
                text-align: center;
                border-bottom: 1px solid #ddd;
                font-size: 5px;
            }

            th {
                background-color: #f2f2f2;
            }
        }

        #modalevakuasi {
            margin-left: 35%;
        }

        #modaltitikkumpul {
            margin-left: 20%;
        }

        #modalrahasia {
            margin-left: 10%;
        }

       
    </style>
</head>
<body>
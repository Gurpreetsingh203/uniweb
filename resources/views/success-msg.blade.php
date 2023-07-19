<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

</head>
<style>
    .succes {
        background-color: #4BB543;
    }

    .succes-animation {
        animation: succes-pulse 2s infinite;
    }

    .danger {
        background-color: #CA0B00;
    }

    .danger-animation {
        animation: danger-pulse 2s infinite;
    }

    .custom-modal {
        position: relative;
        width: 350px;
        min-height: 250px;
        background-color: #fff;
        border-radius: 30px;
        margin: 40px 10px;
    }

    .custom-modal .content {
        position: absolute;
        width: 100%;
        text-align: center;
        bottom: 0;
    }

    .custom-modal .content .type {
        font-size: 18px;
        color: #999;
    }

    .custom-modal .content .message-type {
        font-size: 24px;
        color: #000;
    }

    .custom-modal .border-bottom {
        position: absolute;
        width: 300px;
        height: 20px;
        border-radius: 0 0 30px 30px;
        bottom: -20px;
        margin: 0 25px;
    }

    .custom-modal .icon-top {
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        top: -30px;
        margin: 0 125px;
        font-size: 30px;
        color: #fff;
        line-height: 100px;
        text-align: center;
    }

    @keyframes succes-pulse {
        0% {
            box-shadow: 0px 0px 30px 20px rgba(75, 181, 67, .2);
        }

        50% {
            box-shadow: 0px 0px 30px 20px rgba(75, 181, 67, .4);
        }

        100% {
            box-shadow: 0px 0px 30px 20px rgba(75, 181, 67, .2);
        }
    }

    @keyframes danger-pulse {
        0% {
            box-shadow: 0px 0px 30px 20px rgba(202, 11, 0, .2);
        }

        50% {
            box-shadow: 0px 0px 30px 20px rgba(202, 11, 0, .4);
        }

        100% {
            box-shadow: 0px 0px 30px 20px rgba(202, 11, 0, .2);
        }
    }


    .page-wrapper {
        height: 100vh;
        background-color: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    body {
        margin: 0;
        font-family: 'Roboto';
    }

    @media only screen and (max-width: 800px) {
        .page-wrapper {
            flex-direction: column;
        }
    }

    #buttons {
        width: 80vw;
        margin: auto;
        text-align: center;
    }

    .button {
        border: none;
        color: white;
        padding: 5px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-bottom: 10px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 5%;
    }


    .button5 {
        background-color: white;
        color: black;
        border: 2px solid #4BB543;
    }

    .button5:hover {
        background-color: #4BB543;
        color: white;
    }
</style>

<body>
    <div class="page-wrapper">
        <div class="custom-modal">
            <div class="succes succes-animation icon-top"><i class="fa fa-check" style="margin-top: 35%;"></i></div>
            <div class="succes border-bottom"></div>
            <div class="content">
                <p class="type">Reset Password</p>
                <p class="message-type">Succesfully</p>
                <a href="{{ url('login') }}"><button class="button button5">Sign in</button></a>
            </div>

        </div>


    </div>


</body>

</html>

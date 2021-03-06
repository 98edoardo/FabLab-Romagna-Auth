<?php
header("HTTP/1.1 429 Too Many Requests");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lemonade Firewall</title>
        <meta charset="utf-8">
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
            }

            body {
                font-family: sans-serif;
                font-size: 15px;
                background: rgb(228, 41, 40);
                padding: 10px;
            }

            h1 {
                font-size: 34px;
            }

            h2 {
                font-size: 25px;
                margin-top: 20px;
            }

            p {
                margin-top: 10px;
            }

            #container {
                max-width: 460px;
                margin: 40px auto;
                background: #fff;
                padding: 20px;
                border-radius: 3px;
            }

            footer {
                margin-top: 30px;
                font-size: 13px;
                color: #aaa;
                text-align: center;
                border-top: 1px dashed #aaa;
                padding-top: 10px;
            }

            footer p {
                margin-top: 0;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1>Blocked request!</h1>
            <p>Your request has been blocked by our systems or an administrator.</p>
            <h2>What can I do?</h2>
            <p>Usually our systems create a temporary rule to block fast access requests, if you think this is a mistake
                you can
                try contacting the website administrator.</p>
            <p>In case you are connecting to this website from a shared network (like schools, universities, etc) you
                should
                contact an administrator to accept all requests from your IP address.</p>
            <footer>
                <p>Firewall by Lemonade.</p>
                <p>Lemonade is a FabLab Management System develeped with a lot of ☕ by FabLab Romagna.</p>
            </footer>
        </div>
    </body>
</html>

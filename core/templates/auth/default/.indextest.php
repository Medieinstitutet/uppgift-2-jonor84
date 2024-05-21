<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonserver Cloud</title>
</head>
<!-- Override css -->
<style>
    :root {
        --brand-color-bkg: #ffffff;
        --brand-color-text: #292f51;
        --brand-title-color: #6d5ffc;
        --brand-color-link: #8b52ff;
        --brand-color-link-hover: #6d5ffc;
        --brand-color-button: #6d5ffc;
        --brand-color-button-text: #ffffff;
        --brand-color-focus: #c1bbfd;
    }
</style>

<body class="loginbkg text-center" style="background-image: url(https://myhalo.se/core/public/auth/bkg/default/15.jpg);">
    <div class="card">
        <div class="card-body form-signin">
            <!-- START -->
            <img src='https://myhalo.se/core/system/images/logos/moonbird_black.png' style='width: 100px; margin-top: -5px;margin-bottom: 15px; padding:0px;'> <span style='font-size:40px; font-family: Tilt Warp;'>	&nbsp; C L O U D &nbsp;</span><div id="message" class="alert alert-danger"></div>

            <!-- Button to simulate server response -->
            <button onclick="simulateServerResponse()">Simulate Server Response</button>
        </div>
    </div>

    <script>
        function simulateServerResponse() {
            // Simulate a successful JSON response from the server
            var jsonResponse = '{"success":true}';

            // Log the response to the console (for debugging)
            console.log('Simulated Server Response:', jsonResponse);

            // Call a function to handle the response (e.g., your xhr.onload function)
            handleServerResponse(jsonResponse);
        }

        function handleServerResponse(response) {
            // Parse the JSON response
            try {
                var parsedResponse = JSON.parse(response);
                console.log('Parsed Response:', parsedResponse);

                // Add your logic to handle the parsed response here
                // For example, update the UI based on the response data
            } catch (error) {
                console.error('Error parsing JSON:', error);
                // Handle the error (e.g., display an error message to the user)
            }
        }
    </script>
</body>
</html>

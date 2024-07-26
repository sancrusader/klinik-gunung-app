<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Information</title>
    @vite('resources/css/app.css')
    <style>
        #AccountInformation {
            max-width: 500px;
        }

        #AccountInformation .form-header .stepIndicator.active {
            font-weight: 600;
        }

        #AccountInformation .form-header .stepIndicator.finish {
            font-weight: 600;
            color: #5a67d8;
        }

        #AccountInformation .form-header .stepIndicator::before {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            z-index: 9;
            width: 20px;
            height: 20px;
            background-color: #c3dafe;
            border-radius: 50%;
            border: 3px solid #ebf4ff;
        }

        #AccountInformation .form-header .stepIndicator.active::before {
            background-color: #a3bffa;
            border: 3px solid #c3dafe;
        }

        #AccountInformation .form-header .stepIndicator.finish::before {
            background-color: #5a67d8;
            border: 3px solid #c3dafe;
        }

        #AccountInformation .form-header .stepIndicator::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 8px;
            width: 100%;
            height: 3px;
            background-color: #f3f3f3;
        }

        #AccountInformation .form-header .stepIndicator.active::after {
            background-color: #a3bffa;
        }

        #AccountInformation .form-header .stepIndicator.finish::after {
            ∂ background-color: #5a67d8;
        }

        #AccountInformation .form-header .stepIndicator:last-child:after {
            display: none;
        }

        #AccountInformation input.invalid {
            border: 2px solid #ffaba5;
        }

        #AccountInformation .step {
            display: none;
        }
    </style>
</head>

<body>
    <h1 class="text-lg font-bold text-gray-700 leading-tight text-center mt-12 mb-5">Information</h1>
    <form id="AccountInformation" class="p-12 shadow-md rounded-2xl mx-auto mb-8" method="POST"
        action="{{ route('screenings.store') }}">
        @csrf
        <!-- start step indicators -->
        <div class="form-header flex gap-3 mb-4 text-xs text-center">
            <span class="stepIndicator flex-1 pb-8 relative">Account Information</span>
            <span class="stepIndicator flex-1 pb-8 relative">Screening</span>
            <span class="stepIndicator flex-1 pb-8 relative">Informasi</span>
            <span class="stepIndicator flex-1 pb-8 relative">Payment</span>

        </div>
        <!-- end step indicators -->

        <!-- step one -->
        <div class="step">
            <p class="text-xl text-gray-700 leading-tight text-center mt-8 mb-5">Account Information</p>
            <div class="mb-6">
                <label for="full_name" class="mb-2 text-sm text-start text-grey-900">Full Name</label>
                <input type="text" id="full_name" placeholder="Full Name" name="full_name"
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'" />
            </div>
            <div class="mb-6">
                <label for="birth" class="mb-2 text-sm text-start text-grey-900">Date of Birth</label>
                <input id="birth" type="date" placeholder="Date of Birth" name="date_of_birth"
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'">
            </div>
            <div class="mb-6">
                <label for="citizenship" class="mb-2 text-sm text-start text-grey-900">Gunung</label>
                <select id="citizenship" placeholder="local" name="mountain"
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'">
                    <option selected value="rinjani">Rinjani</option>
                    <option value="simeru">simeru</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="citizenship" class="mb-2 text-sm text-start text-grey-900">Citizenship</label>
                <select id="citizenship" placeholder="local" name="citizenship"
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'">
                    <option selected>Local</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="citizenship" class="mb-2 text-sm text-start text-grey-900">Country</label>
                <select placeholder="country" name="country"
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'">
                    <option selected>Select country</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="address" class="mb-2 text-sm text-start text-grey-900">Address</label>
                <textarea placeholder="Your address" name="address" rows="4"
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'"
                    required></textarea>
            </div>
            <div class="mb-6">
                <label for="phone" class="mb-2 text-sm text-start text-grey-900">Phone</label>
                <input id="phone" type="text" placeholder="phone" name="phone"
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'" />
            </div>
            <div class="mb-6">
                <label for="citizenship" class="mb-2 text-sm text-start text-grey-900">Email</label>
                <input id="email" type="email" placeholder="email" name="email"
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'" />
            </div>

        </div>

        <!-- step two -->
        <div class="step">
            <p class="text-xl text-gray-700 leading-tight text-center mt-8 mb-5">Screening</p>
            <div class="mb-6">
                <label class="mb-2 text-sm text-start text-grey-900">1 .Are you a student?</label>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="yes" name="question1" value="1" class="mr-2">
                    <label for="yes" class="text-gray-700 mr-4">Ya</label>

                    <input type="checkbox" id="tidak" name="question1" value="0" class="mr-2">
                    <label for="tidak" class="text-gray-700">Tidak</label>
                </div>
                <label class="mb-2 text-sm text-start text-grey-900">2 .Are you a student?</label>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="yes" name="question2" value="1" class="mr-2">
                    <label for="yes" class="text-gray-700 mr-4">Ya</label>

                    <input type="checkbox" id="tidak" name="question2" value="0" class="mr-2">
                    <label for="tidak" class="text-gray-700">Tidak</label>
                </div>
                <label class="mb-2 text-sm text-start text-grey-900">2 .Are you a student?</label>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="yes" name="question3" value="1" class="mr-2">
                    <label for="yes" class="text-gray-700 mr-4">Ya</label>

                    <input type="checkbox" id="tidak" name="question3" value="0" class="mr-2">
                    <label for="tidak" class="text-gray-700">Tidak</label>
                </div>
            </div>
        </div>

        <!-- step three -->
        <!-- step three -->
        <div class="step">
            <p class="text-xl text-gray-700 leading-tight text-center mt-8 mb-5">Information</p>
            <p class="text-md text-gray-700 text-center mb-5">
                Screening berhasil. Hasil screening dan nomor antrian Anda akan dikirim melalui e-mail setelah Anda
                membayar administrasi sebesar 25.000 IDR.
            </p>
            <p class="text-md text-gray-700 text-center mb-5">
                Harap pastikan pembayaran dilakukan segera untuk mendapatkan QR code dan menyelesaikan proses screening.
            </p>
        </div>


        <!-- step for (Payment) -->
        <div class="step">
            <p class="text-md text-gray-700 leading-tight text-center mt-8 mb-5">Payment</p>
            <div class="mb-6">
                <label for="payment" class="mb-2 text-sm text-start text-grey-900">Payment Method</label>
                <select id="payment" name="payment_method" required
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'">
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="amount" class="mb-2 text-sm text-start text-grey-900">Amount</label>
                <input type="number" id="amount" name="amount" value="25000" readonly
                    class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'" />
            </div>
            <!-- Add more payment-related fields as needed -->
        </div>
        <!-- start previous / next buttons -->
        <div class="form-footer flex gap-3">
            <button type="button" id="prevBtn"
                class="flex-1 focus:outline-none border border-gray-300 py-2 px-5 rounded-lg shadow-sm text-center text-gray-700 bg-white hover:bg-gray-100 text-lg"
                onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn"
                class="flex-1 border border-transparent focus:outline-none p-3 rounded-md text-center text-white bg-indigo-600 hover:bg-indigo-700 text-lg"
                onclick="nextPrev(1)">Next</button>
        </div>
        <!-- end previous / next buttons -->
    </form>





    {{-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> --}}
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("step");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("step");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("AccountInformation").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("step");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("stepIndicator");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>
</body>

</html>

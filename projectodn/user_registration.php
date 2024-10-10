<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="border: 1px solid black; width:500px;">
        <form onsubmit="return allcheck()" action="logic.php" method="post" enctype="multipart/form-data">
            <h2>User Registration</h2>
            <label for="name">Full Name</label>
            <input type="text" id="name" name="full_name" required>
            <br><br>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
            <br><br>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <br><br>

            <label for="Gender">Gender</label><br>
            <input type="radio" name="gender" id="male" value="male" required>Male
            <input type="radio" name="gender" id="female" value="female" required>Female
            <br><br>

            <label for="hobbies">Hobbies : </label>
            <input type="checkbox" name="hobbies[]" id="sing" value="singing">Singing
            <input type="checkbox" name="hobbies[]" id="danc" value="Dancing">Dancing
            <input type="checkbox" name="hobbies[]" id="read" value="Reading Books">Reading books
            <input type="checkbox" name="hobbies[]" id="sketch" value="Sketching">Sketching
            <br><br>
            
            <input type="submit" value="submit" id="submit" name="submit">
            <br><br>

        </form>
        
    </div>

</body>

</html>

<script>
    function allcheck() {
        let name1 = document.getElementById("name").value;

        let email1 = document.getElementById("email").value;
        let emailformat = /^([a-zA-Z0-9_]{3,})@([a-zA-Z]{3,})[.]{1}[a-zA-Z.]{2,}[a-zA-Z.]{0,}$/;
        let msgemail1 = document.getElementById("msgemail");

        let pass1 = document.getElementById("password").value;

        let male1 = document.getElementById("male")
        let female1 = document.getElementById("female")

        let sing1 = document.getElementById("sing").checked;
        let danc1 = document.getElementById("danc").checked;
        let read1 = document.getElementById("read").checked;
        let sketch1 = document.getElementById("sketch").checked;

        if ((name1 == "") || (email1 == "") || (pass1 == "")) {
            alert("all fields are required");
            return false;
        }
         else if (name1.length >= 20) {
            alert("name length must be equal to or less then 20")
            return false;
        }
         else if (!emailformat.test(email1)) {
            alert("email format is incorrect");
            return false;
        } 
         else if (pass1.length <= 9) {
            alert("atleast 8 characters of password")
            return false;
        }
        
        else if (male1.checked == "") {
            if (female1.checked == true) {
                return true;
            } else {
                alert("all field is required");
                return false;
            }
        }
        
        else if (female1.checked == "") {
            if (male1.checked == true) {
                return true;
            } else {
                alert("all fields are required");
                return false;
            }
        }
        
        else if ((sing1 == "") && (danc1 == "") && (read1 == "") && (sketch1 = "")) {
            alert("all fields are required");
            return false;
        }
         else {
            return true;
        }


    }
</script>
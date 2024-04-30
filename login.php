<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
<title> 로그인</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>

</head>


<style>
        body{
  font-family: 'Montserrat', sans-serif;
  background:#dfe8ff;
}

.container{
  display:block;
  max-width:680px;
  width:80%;
  margin:120px auto;
}

h1{
  color:#182978;
  font-size:48px;
  letter-spacing:-3px;
  text-align:center;
  margin:120px 0 80px 0 ;
  display: flex;
        align-items: center;
        justify-content: center;
  transition:.2s linear;
}
h1 img{
	   width:60px;
	   margin-right:10px;
   }

.links{
  list-style-type:none;
  li{
     display:inline-block;
     margin:0 20px 0 0;
     transition:.2s linear;
     &:nth-child(2){
        opacity : .6;
        &:hover{
           opacity : 1;
        }
     }
     &:nth-child(3){
        opacity : .6;
        float:right;
         &:hover{
           opacity : 1;
         }
     }
     a{
        text-decoration:none;
        color:#0f132a;
        font-weight:bolder;
        text-align:center;
        cursor : pointer;
        font-size: 23px;
     }
   }
}


form{
  width:100%;
  max-width:680px;
  margin:40px auto 10px;
  .input__block{
     margin:20px auto;
     display:block;
     position:relative;
  
     &.first-input__block {
  &::before {
    content: "";
    position: absolute;
    top: -15px;
    left: 50px;
    display: block;
    width: 0;
    height: 0;
    background:#DBE5FD ;
    border-left: 15px  solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 15px solid rgba(#0f132a, 0.1);
    transition: 0.2s linear;
  }
}

     &.signup-input__block{
      &::before{
        content:"";
        position:absolute;
        top:-15px;
        left:150px;
        display:block;
        width:0;
        height:0;
        background:#DBE5FD;
        border-left:15px solid transparent;
        border-right:15px solid transparent;
        border-bottom:15px solid rgba(#0f132a,.1);
        transition:.2s linear;
        }
     }
     input{
        display:block;
        width:90%;
        max-width:680px;
        height:50px;
        margin:0 auto;
        border-radius:8px;
        border:none;
        background: rgba(#0f132a,.1);
        color : rgba(#0f132a,.3);
        padding:0 0 0 15px;
        font-size:14px;
        font-family: 'Montserrat', sans-serif;
        &:focus,
        &:active{
          outline:none;
          border:none;
          color : rgba(#0f132a,1);
        }
       &.repeat__password{
         opacity : 0;
         display : none;
         transition:.2s linear;
       }
     }
  }
  
  .signin__btn{
     background:#182978;
     color: #DBE5FD;
     display:block;
     width:92.5%;
     max-width:680px;
     height:50px;
     border-radius:8px;
     margin:0 auto;
     border:none;
     cursor:pointer;
     font-size:14px;
     font-family: 'Montserrat', sans-serif;
     box-shadow:0 15px 30px rgba(#e91e63,.36);
    transition:.2s linear;
    &:hover{
      box-shadow:0 0 0 rgba(#e91e63,.0);
    }
  }
}

.separator{
  display:block;
  margin:30px auto 10px;
  text-align:center;
  height:40px;
  position:relative;
  background:transparent;
  color: rgba(#0f132a,.4);
  font-size:13px;
  width:90%;
  max-width:680px;
  &::before{
    content:"";
    position:absolute;
    top:8px;
    left:0;
    background: rgba(#0f132a,.2);
    height:1px;
    width:45%;
  }
  &::after{
    content:"";
    position:absolute;
    top:8px;
    right:0;
    background: rgba(#0f132a,.2);
    height:1px;
    width:45%;
  }
}

.Kakao__btn{
   display:block;
   width:90%;
   max-width:680px;
   margin:20px auto;
   height:50px;
   cursor:pointer;
   font-size:14px;
   font-family: 'Montserrat', sans-serif;
   border-radius:8px;
   border:none;
   line-height:40px;
   &.Kakao__btn {
    background: #FFEB00;
    color: #8B4513;
    box-shadow: 0 15px 30px rgba(#8B4513, .36);
    transition: 0.2s linear;

    .kakao-icon {
        max-width: 30px; 
        max-height: 30px;
        vertical-align: middle; 
        margin-right: 10px;
    }

    &:hover {
        box-shadow: 0 0 0 rgba(#8B4513, .0);
    }
}

   }


footer{
  p{
    text-align:center;
    .fa{
      color: #e91e63;
    }
    a{
      text-decoration:none;
      font-size:17px;
      margin:0 5px;
      
  }
}
}
</style>
</head>

    <div class="container">
        <form action="process-signup.php" method="post"></form>
        <h1><img src="img/logo.png" class="img-fluid"/><span>집하자</span></h1>
        <!-- Links -->
        <ul class="links">
          <li>
            <a href="#" id="signin">로그인</a>
          </li>
          <li>
            <a href="signup.html">회원가입</a>
          </li>
         
        </ul>
        
        <!-- Form -->
        <form  action="" method="post">
          <!-- mail input -->
          <div class="first-input input__block first-input__block">
             <input type="email" placeholder="메일" class="input" id="mail"   />
          </div>
          <!-- password input -->
          <div class="input__block">
             <input type="password" placeholder="비밀번호" class="input" id="password"    />
          </div>
          <!-- repeat password input -->
          <div class="input__block">
             <input type="password" placeholder="비밀번호를 한번더 입력해주세요" class="input repeat__password" id="repeat__password"    />
          </div>
          <!-- sign in button -->
          <button class="signin__btn">
            로그인
          </button>
        </form>
        <!-- separator -->
        <div>
          <p>비밀번호를 잊으셨나요? <a href="forgot-password.php">여기를 클릭하세요.</a></p>
      </div>
        <div class="separator">
          <p>또는</p>
      
        
      </div>
      <!-- kakao talk button -->
      <button class="Kakao__btn" id="kakao-login-btn">
        <img src="img/kakaologo.png" alt="Kakao Logo" class="kakao-icon">
        카카오 로그인
    </button>
    <script>
      Kakao.init('YOUR_KAKAO_APP_KEY'); // Replace 'YOUR_KAKAO_APP_KEY' with your actual Kakao app key
  
      document.getElementById('kakao-login-btn').addEventListener('click', function() {
          Kakao.Auth.login({
              success: function(authObj) {
                  // Authentication successful, handle the response
                  console.log('Successful login:', authObj);
                  // Send the authObj to your server for further processing
                  // For example, you can send it via AJAX to your backend
                  /*
                  fetch('/login', {
                      method: 'POST',
                      headers: {
                          'Content-Type': 'application/json'
                      },
                      body: JSON.stringify(authObj)
                  })
                  .then(response => response.json())
                  .then(data => {
                      // Handle server response
                      console.log(data);
                  })
                  .catch(error => {
                      console.error('Error:', error);
                  });
                  */
              },
              fail: function(err) {
                  // Handle any errors that occur during the login process
                  console.error('Failed to login:', err);
              }
          });
      });
  </script>
    
      <footer>
        <p>
            켑스톤 디자인 프로재트
          <i class="fa fa-heart"></i> 
          <i class="fa fa-heart"></i> 
          <i class="fa fa-heart"></i> 
        </p>
        
      </footer>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    let signup = document.querySelector("#signup");
    let signin = document.querySelector("#signin");
    let reset = document.querySelector("#reset");
    let firstInput = document.querySelector(".first-input");
    let hiddenInput = document.querySelector("#repeat__password");
    let signinBtn = document.querySelector(".signin__btn");

    // Sign Up
    signup.addEventListener("click", function(e) {
      e.preventDefault();
      document.querySelector("h1").innerHTML = '<img src="img/logo.png" class="img-fluid"/><span>집하자</span>';
      this.parentElement.style.opacity = "1";
      Array.from(this.parentElement.parentElement.children).forEach(child => {
        if (child !== this.parentElement)
          child.style.opacity = ".6";
      });
      firstInput.classList.remove("first-input__block");
      firstInput.classList.add("signup-input__block");
      hiddenInput.style.opacity = "1";
      hiddenInput.style.display = "block";
      signinBtn.textContent = "회원가입";
    });

    // Sign In
    signin.addEventListener("click", function(e) {
      e.preventDefault();
      document.querySelector("h1").innerHTML = '<img src="img/logo.png" class="img-fluid"/><span>집하자</span>';
      this.parentElement.style.opacity = "1";
      Array.from(this.parentElement.parentElement.children).forEach(child => {
        if (child !== this.parentElement)
          child.style.opacity = ".6";
      });
      firstInput.classList.remove("signup-input__block");
      firstInput.classList.add("first-input__block");
      hiddenInput.style.opacity = "0";
      hiddenInput.style.display = "none";
      signinBtn.textContent = "로그인";
    });

    // Reset
    reset.addEventListener("click", function(e) {
      e.preventDefault();
      document.querySelector("form").reset();
    });
  });
</script>

</body>
</html>








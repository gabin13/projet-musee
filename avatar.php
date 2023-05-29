<?php require_once('_nav.php'); ?>
<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      text-align: center;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .avatar-list {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
    }

    .avatar-option {
      margin: 0 10px;
      cursor: pointer;
      position: relative;
    }

    .avatar-option img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid transparent;
    }

    .avatar-option.selected img {
      border-color: #0066ff;
    }

    .btn-validate {
      margin-top: 20px;
    }

    .btn-validate button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #0066ff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-validate button:hover {
      background-color: #0052cc;
    }
  </style>
</head>
<body>
    <br><br><br>
  <h1>Choisir un nouvel avatar</h1>
  <br>
  <div class="avatar-list">
    <div class="avatar-option">
      <img src="Images/avatar1.jpg" alt="Avatar 1" onclick="selectAvatar(1)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar2.jpg" alt="Avatar 2" onclick="selectAvatar(2)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar3.jpg" alt="Avatar 3" onclick="selectAvatar(3)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar4.jpg" alt="Avatar 4" onclick="selectAvatar(4)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar5.jpg" alt="Avatar 5" onclick="selectAvatar(5)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar6.jpg" alt="Avatar 6" onclick="selectAvatar(6)">
    </div>
  </div>

  <div class="btn-validate">
    <button onclick="validateAvatar()">Valider</button>
  </div>

  <script>
    var selectedAvatar = null;
        
    function selectAvatar(avatarIndex) {
      var avatarOptions = document.getElementsByClassName('avatar-option');
      for (var i = 0; i < avatarOptions.length; i++) {
        avatarOptions[i].classList.remove('selected');
      }

      var selectedOption = document.getElementsByClassName('avatar-option')[avatarIndex - 1];
      selectedOption.classList.add('selected');
      selectedAvatar = avatarIndex;
    }

    function validateAvatar() {
      if (selectedAvatar !== null) {
        window.location.href = 'account.php?avatar=' + selectedAvatar;
      } else {
        alert('Veuillez sélectionner un avatar avant de valider.');
      }
    }
  </script>
</body>
</html>
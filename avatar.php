<?php require_once('_nav.php'); ?>
<?php require_once('functions.php'); ?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles/avatar.css" />
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
    </div>
    <br>
    <div class="avatar-list">
    <div class="avatar-option">
      <img src="Images/avatar6.jpg" alt="Avatar 6" onclick="selectAvatar(6)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar7.jpg" alt="Avatar 7" onclick="selectAvatar(7)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar8.jpg" alt="Avatar 8" onclick="selectAvatar(8)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar9.jpg" alt="Avatar 9" onclick="selectAvatar(9)">
    </div>
    <div class="avatar-option">
      <img src="Images/avatar10.jpg" alt="Avatar 10" onclick="selectAvatar(10)">
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

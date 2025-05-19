// Preview profile image
document.getElementById('avatar-upload').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function (event) {
        document.getElementById('avatar').src = event.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
  
  // Save profile info
  document.getElementById('profile-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;
  
    alert(`Profile updated:\nName: ${name}\nEmail: ${email}\nPhone: ${phone}\nAddress: ${address}`);
  });
  
  // Change password
  document.getElementById('password-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const newPass = document.getElementById('new-pass').value;
    const confirmPass = document.getElementById('confirm-pass').value;
  
    if (newPass !== confirmPass) {
      alert('❌ Passwords do not match.');
    } else {
      alert('✅ Password updated successfully!');
      // Clear fields
      document.getElementById('current-pass').value = '';
      document.getElementById('new-pass').value = '';
      document.getElementById('confirm-pass').value = '';
    }
  });
  
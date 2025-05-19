function updateUI() {
    const selectedRole = document.getElementById('role').value;
    const navItems = document.querySelectorAll("#navigation li");
  
    navItems.forEach(item => {
      const itemRole = item.getAttribute("data-role");
      if (
        itemRole === "All" ||
        itemRole === selectedRole
      ) {
        item.style.display = "inline-block";
      } else {
        item.style.display = "none";
      }
    });
  
    const adminPanel = document.getElementById("admin-panel");
    adminPanel.style.display = selectedRole === "Admin" ? "block" : "none";
  }
  
  // Load UI on first load
  window.onload = updateUI;
  
const rooms = [
    {
      type: "standard",
      name: "Standard Room",
      amenities: ["Queen Bed", "Free Wi-Fi", "TV"],
    },
    {
      type: "deluxe",
      name: "Deluxe Room",
      amenities: ["King Bed", "Balcony", "Minibar", "TV"],
    },
    {
      type: "suite",
      name: "Suite Room",
      amenities: ["King Bed", "Living Area", "Bathtub", "Ocean View"],
    },
  ];
  
  function renderRooms(filter) {
    const container = document.getElementById("roomGallery");
    container.innerHTML = "";
  
    const filteredRooms = filter === "all" ? rooms : rooms.filter(r => r.type === filter);
  
    filteredRooms.forEach(room => {
      const card = document.createElement("div");
      card.className = "room-card";
      card.innerHTML = `
        <h3>${room.name}</h3>
        <ul>${room.amenities.map(a => `<li>${a}</li>`).join('')}</ul>
        <button onclick="openModal('${room.name}')">360° Tour</button>
      `;
      container.appendChild(card);
    });
  }
  
  function filterRooms(type) {
    renderRooms(type);
  }
  
  function openModal(roomName) {
    document.getElementById("modalRoomTitle").innerText = roomName + " - 360° Virtual Tour";
    document.getElementById("modal").style.display = "block";
  }
  
  function closeModal() {
    document.getElementById("modal").style.display = "none";
  }
  
  // Initial render
  renderRooms("all");
  
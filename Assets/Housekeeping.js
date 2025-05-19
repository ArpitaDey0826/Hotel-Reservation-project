let rooms = [
    { id: 101, status: 'Cleaning', progress: 0 },
    { id: 102, status: 'Ready', progress: 100 },
    { id: 103, status: 'Cleaning', progress: 30 },
    { id: 104, status: 'Maintenance', progress: 0 },
    { id: 105, status: 'Cleaning', progress: 60 }
  ];
  
  function renderRooms() {
    const container = document.getElementById('room-list');
    container.innerHTML = '';
  
    rooms.forEach(room => {
      const card = document.createElement('div');
      card.className = 'room-card';
  
      const color = room.status === 'Ready' ? '#2ecc71' :
                    room.status === 'Cleaning' ? '#f1c40f' : '#e74c3c';
  
      card.innerHTML = `
        <h2>Room ${room.id}</h2>
        <p class="status">Status: <span style="color: ${color}">${room.status}</span></p>
        <div class="cleaning-progress">
          <div class="progress-bar" style="width: ${room.progress}%"></div>
        </div>
        <button class="report" onclick="openModal(${room.id})">Report Maintenance</button>
      `;
  
      container.appendChild(card);
    });
  }
  
  function openModal(roomId) {
    document.getElementById('room-number').value = `Room ${roomId}`;
    document.getElementById('maintenance-modal').classList.remove('hidden');
  }
  
  function closeModal() {
    document.getElementById('maintenance-modal').classList.add('hidden');
  }
  
  document.getElementById('maintenance-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const room = document.getElementById('room-number').value;
    const issue = document.getElementById('issue-desc').value;
    alert(`Maintenance issue reported for ${room}: ${issue}`);
    document.getElementById('issue-desc').value = '';
    closeModal();
  });
  
  // Simulate cleaning progress every 4 seconds
  setInterval(() => {
    rooms = rooms.map(room => {
      if (room.status === 'Cleaning') {
        let newProgress = room.progress + Math.floor(Math.random() * 20);
        if (newProgress >= 100) {
          return { ...room, progress: 100, status: 'Ready' };
        }
        return { ...room, progress: newProgress };
      }
      return room;
    });
    renderRooms();
  }, 4000);
  
  // Initial render
  window.onload = renderRooms;
  
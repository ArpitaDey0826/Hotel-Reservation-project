let amenities = [
    {
      id: 1,
      type: 'pool',
      name: 'Infinity Pool',
      description: 'Relax in our temperature-controlled pool with a city view.',
      img: 'https://source.unsplash.com/500x300/?hotel,pool',
      available: true
    },
    {
      id: 2,
      type: 'spa',
      name: 'Luxury Spa',
      description: 'Indulge in rejuvenating massages and spa treatments.',
      img: 'https://source.unsplash.com/500x300/?hotel,spa',
      available: false
    },
    {
      id: 3,
      type: 'gym',
      name: 'Fitness Center',
      description: 'Modern equipment and trainers available 24/7.',
      img: 'https://source.unsplash.com/500x300/?hotel,gym',
      available: true
    },
    {
      id: 4,
      type: 'spa',
      name: 'Steam Room',
      description: 'Unwind in our high-tech steam rooms.',
      img: 'https://source.unsplash.com/500x300/?steam,spa',
      available: true
    }
  ];
  
  function displayAmenities(list) {
    const container = document.getElementById('amenities-list');
    container.innerHTML = '';
  
    list.forEach(item => {
      const card = document.createElement('div');
      card.className = 'amenity-card';
      card.onclick = () => openModal(item);
  
      card.innerHTML = `
        <img src="${item.img}" alt="${item.name}">
        <div class="info">
          <h3>${item.name}</h3>
          <p>${item.description.substring(0, 50)}...</p>
          <p class="availability ${item.available ? '' : 'unavailable'}">
            ${item.available ? 'Available Now' : 'Currently Unavailable'}
          </p>
        </div>
      `;
  
      container.appendChild(card);
    });
  }
  
  function filterAmenities(type) {
    if (type === 'all') {
      displayAmenities(amenities);
    } else {
      const filtered = amenities.filter(a => a.type === type);
      displayAmenities(filtered);
    }
  }
  
  // Simulate real-time availability change
  function randomizeAvailability() {
    amenities = amenities.map(item => ({
      ...item,
      available: Math.random() > 0.3 // 70% chance to be available
    }));
    displayAmenities(amenities);
  }
  
  // Modal functions
  function openModal(item) {
    document.getElementById('modal-img').src = item.img;
    document.getElementById('modal-title').textContent = item.name;
    document.getElementById('modal-desc').textContent = item.description;
    document.getElementById('modal').classList.remove('hidden');
  }
  
  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
  }
  
  // Initial setup
  window.onload = () => {
    displayAmenities(amenities);
    setInterval(randomizeAvailability, 5000); // Update every 5 seconds
  };
  
@extends('layouts.app')

@section('content')
<div class="ridereview-container">
    <!-- Header with search -->
    <div class="map-header">
        <div class="header-content">
            <h1>🎢 RideReview</h1>
            <p>Discover honest reviews for your favorite attractions</p>
        </div>
        <div class="search-box">
            <input
                type="text"
                id="searchInput"
                placeholder="Search locations..."
                class="search-input"
            >
            <div id="searchResults" class="search-results hidden"></div>
        </div>
        @auth
        <div class="user-menu">
            <span class="user-name">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        @else
        <div class="auth-links">
            <a href="{{ route('login') }}" class="btn btn-secondary">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </div>
        @endauth
    </div>

    <div class="map-container">
        <!-- Leaflet Map -->
        <div id="map" class="map-area"></div>

        <!-- Right Sidebar -->
        <div class="sidebar">
            <div class="sidebar-content">
                <!-- Location Details -->
                <div id="locationDetails" class="location-panel hidden">
                    <button class="close-btn" onclick="closeLocationPanel()">×</button>
                    <h2 id="locationName"></h2>
                    <p id="locationAddress" class="location-address"></p>

                    <div class="ratings-summary">
                        <div class="rating-badge">
                            <span class="label">Fun</span>
                            <span id="avgFun" class="value">-</span>/10
                        </div>
                        <div class="rating-badge">
                            <span class="label">Safety</span>
                            <span id="avgSafety" class="value">-</span>/10
                        </div>
                        <div class="rating-badge">
                            <span class="label">Value</span>
                            <span id="avgValue" class="value">-</span>/10
                        </div>
                    </div>

                    <div id="attractions-list" class="attractions-list"></div>

                    <p id="locationDescription" class="location-description"></p>
                </div>

                <!-- Attraction Details -->
                <div id="attractionDetails" class="attraction-panel hidden">
                    <button class="close-btn" onclick="closeAttractionPanel()">×</button>
                    <h2 id="attractionName"></h2>
                    <p id="attractionType" class="attraction-type"></p>

                    <div class="attraction-ratings">
                        <div class="rating-item">
                            <div class="rating-label">Fun Factor</div>
                            <div class="rating-bar">
                                <div id="funBar" class="rating-fill"></div>
                                <span id="funValue" class="rating-text">-/10</span>
                            </div>
                        </div>
                        <div class="rating-item">
                            <div class="rating-label">Safety</div>
                            <div class="rating-bar">
                                <div id="safetyBar" class="rating-fill"></div>
                                <span id="safetyValue" class="rating-text">-/10</span>
                            </div>
                        </div>
                        <div class="rating-item">
                            <div class="rating-label">Value</div>
                            <div class="rating-bar">
                                <div id="valueBar" class="rating-fill"></div>
                                <span id="valueValue" class="rating-text">-/10</span>
                            </div>
                        </div>
                    </div>

                    <div id="reviewCount" class="review-count"></div>

                    <div id="reviewsList" class="reviews-list"></div>

                    @auth
                    <button id="reviewBtn" class="btn btn-primary full-width">
                        Write a Review
                    </button>
                    @else
                    <p class="auth-prompt">
                        <a href="{{ route('login') }}">Sign in</a> to write a review
                    </p>
                    @endauth
                </div>

                <!-- No Selection -->
                <div id="noSelection" class="no-selection-panel">
                    <div class="empty-state">
                        <p>👈 Click on a location to see attractions</p>
                        <p class="hint">Use the search bar above to find specific locations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />

<!-- Leaflet JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

<!-- CSS Styles -->
<style>
    :root {
        --primary: #FF6B6B;
        --secondary: #4ECDC4;
        --dark: #2C3E50;
        --light: #ECF0F1;
        --accent: #F9D56E;
        --success: #2ECC71;
        --danger: #E74C3C;
        --spacing: 1rem;
        --border-radius: 12px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: var(--light);
        color: var(--dark);
    }

    .ridereview-container {
        display: flex;
        flex-direction: column;
        height: 100vh;
        overflow: hidden;
    }

    /* Header Styles */
    .map-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: var(--spacing) 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .header-content h1 {
        font-size: 2rem;
        margin-bottom: 0.25rem;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .header-content p {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .search-box {
        flex: 1;
        max-width: 400px;
        margin: 0 2rem;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        color: #333;
        background-color: white;
    }

    .search-input::placeholder {
    color: #999;
    }

    .search-input:focus {
        outline: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-radius: var(--border-radius);
        margin-top: 0.5rem;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
    }

    .search-results.hidden {
        display: none;
    }

    .search-result-item {
        padding: var(--spacing);
        border-bottom: 1px solid var(--light);
        cursor: pointer;
        transition: background 0.2s;
        color: #333;
    }

    .search-result-item:hover {
        background: var(--light);
    }

    .search-result-item strong {
    color: #2C3E50;
    }

    .search-result-item small {
    color: #666;
    }

    .user-menu,
    .auth-links {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-name {
        font-weight: 600;
    }

    .logout-btn,
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .logout-btn {
        background: rgba(255,255,255,0.2);
        color: white;
        border: 1px solid white;
    }

    .logout-btn:hover {
        background: rgba(255,255,255,0.3);
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: #e55a5a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255,107,107,0.3);
    }

    .btn-secondary {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-secondary:hover {
        background: white;
        color: var(--primary);
    }

    /* Map Container */
    .map-container {
        display: flex;
        flex: 1;
        overflow: hidden;
        gap: 0;
    }

    .map-area {
        flex: 1;
        height: 100%;
        position: relative;
    }

    /* Leaflet customization */
    .leaflet-control-container {
        z-index: 600;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 380px;
        background: white;
        border-left: 1px solid #e0e0e0;
        box-shadow: -2px 0 8px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .sidebar-content {
        flex: 1;
        overflow-y: auto;
        padding: 0;
        position: relative;
    }

    .location-panel,
    .attraction-panel,
    .no-selection-panel {
        padding: 2rem;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hidden {
        display: none !important;
    }

    .close-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: none;
        border: none;
        font-size: 2rem;
        cursor: pointer;
        color: var(--dark);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: background 0.2s;
    }

    .close-btn:hover {
        background: var(--light);
    }

    .location-panel h2,
    .attraction-panel h2 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        margin-top: 0;
        color: var(--primary);
    }

    .location-address,
    .attraction-type {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 1.5rem;
    }

    /* Ratings Summary */
    .ratings-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--light), #f5f5f5);
        border-radius: var(--border-radius);
    }

    .rating-badge {
        text-align: center;
    }

    .rating-badge .label {
        display: block;
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        font-weight: 600;
    }

    .rating-badge .value {
        display: block;
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
    }

    /* Attractions List */
    .attractions-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 2rem;
    }

    .attraction-item {
        padding: 1rem;
        background: var(--light);
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: all 0.3s ease;
        border-left: 4px solid var(--secondary);
    }

    .attraction-item:hover {
        background: #e8e8e8;
        transform: translateX(5px);
    }

    .attraction-item-name {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .attraction-item-rating {
        font-size: 0.9rem;
        color: var(--primary);
        font-weight: 600;
    }

    /* Attraction Details */
    .attraction-ratings {
        margin: 1.5rem 0;
        padding: 1.5rem;
        background: var(--light);
        border-radius: var(--border-radius);
    }

    .rating-item {
        margin-bottom: 1.5rem;
    }

    .rating-item:last-child {
        margin-bottom: 0;
    }

    .rating-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .rating-bar {
        height: 24px;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        border: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
    }

    .rating-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        transition: width 0.4s ease;
        border-radius: 10px;
    }

    .rating-text {
        position: absolute;
        right: 0.5rem;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--dark);
        z-index: 1;
    }

    .review-count {
        text-align: center;
        color: #666;
        margin: 1rem 0;
        font-size: 0.95rem;
    }

    /* Reviews List */
    .reviews-list {
        margin: 1.5rem 0;
        max-height: 300px;
        overflow-y: auto;
    }

    .review-item {
        padding: 1rem;
        background: var(--light);
        border-radius: var(--border-radius);
        margin-bottom: 1rem;
        border-left: 4px solid var(--accent);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.5rem;
    }

    .review-author {
        font-weight: 600;
        color: var(--primary);
    }

    .review-date {
        font-size: 0.85rem;
        color: #999;
    }

    .review-ratings {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .review-rating-badge {
        background: white;
        padding: 2px 8px;
        border-radius: 6px;
        font-weight: 600;
        color: var(--primary);
    }

    .review-comment {
        font-size: 0.95rem;
        line-height: 1.4;
        color: #555;
        margin: 0.5rem 0;
    }

    .review-comment.empty {
        color: #999;
        font-style: italic;
    }

    /* Empty State */
    .no-selection-panel {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .empty-state {
        text-align: center;
        color: #999;
    }

    .empty-state p {
        font-size: 1.1rem;
        margin: 1rem 0;
    }

    .empty-state .hint {
        font-size: 0.95rem;
        color: #bbb;
    }

    .location-description {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #666;
        margin-top: 1rem;
    }

    .full-width {
        width: 100%;
        margin-top: 1rem;
    }

    .auth-prompt {
        text-align: center;
        color: #666;
        padding: 1rem;
        background: var(--light);
        border-radius: var(--border-radius);
        margin-top: 1rem;
    }

    .auth-prompt a {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .map-header {
            flex-direction: column;
            gap: 1rem;
        }

        .search-box {
            max-width: 100%;
            margin: 0;
        }

        .sidebar {
            width: 100%;
            max-height: 40vh;
            border-left: none;
            border-top: 1px solid #e0e0e0;
        }

        .map-container {
            flex-direction: column;
        }
    }

    /* Scrollbar Styling */
    .sidebar-content::-webkit-scrollbar {
        width: 8px;
    }

    .sidebar-content::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-content::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }

    .sidebar-content::-webkit-scrollbar-thumb:hover {
        background: #999;
    }
</style>

<!-- JavaScript -->
<script>
    let map;
    let markers = [];
    let currentLocation = null;
    let currentAttraction = null;

    // Initialize map
    function initMap() {
        // Create map centered on USA
        map = L.map('map').setView([39.8283, -98.5795], 4);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19,
            minZoom: 2
        }).addTo(map);

        // Load locations
        loadLocations();

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', debounce(searchLocations, 300));
    }

    // Load locations from API
    function loadLocations() {
        fetch('/api/locations')
            .then(response => response.json())
            .then(locations => {
                locations.forEach(location => addMarker(location));
            })
            .catch(error => console.error('Error loading locations:', error));
    }

    // Add marker to map
    function addMarker(location) {
        const lat = parseFloat(location.latitude);
        const lng = parseFloat(location.longitude);

        // Create custom icon
        const icon = L.divIcon({
            html: `
                <div class="custom-marker">
                    <div class="marker-inner">🎢</div>
                </div>
            `,
            iconSize: [40, 40],
            className: 'custom-marker-container'
        });

        const marker = L.marker([lat, lng], { icon: icon })
            .addTo(map)
            .on('click', () => showLocationDetails(location, marker));

        markers.push({ location: location, marker: marker });
    }

    // Show location details in sidebar
    function showLocationDetails(location, marker) {
        currentLocation = location;
        currentAttraction = null;

        // Fetch full location data
        fetch(`/api/locations/${location.id}`)
            .then(response => response.json())
            .then(data => {
                // Update sidebar
                document.getElementById('locationName').textContent = data.name;
                document.getElementById('locationAddress').textContent =
                    `${data.address || ''}, ${data.city || ''}`.trim();
                document.getElementById('locationDescription').textContent = data.description || '';

                // Calculate average ratings
                let totalFun = 0, totalSafety = 0, totalValue = 0, reviewCount = 0;
                data.attractions.forEach(attr => {
                    totalFun += parseFloat(attr.avg_fun_rating) || 0;
                    totalSafety += parseFloat(attr.avg_safety_rating) || 0;
                    totalValue += parseFloat(attr.avg_value_rating) || 0;
                    reviewCount += attr.review_count;
                });

                const count = data.attractions.length;
                document.getElementById('avgFun').textContent =
                    count > 0 ? (totalFun / count).toFixed(1) : '-';
                document.getElementById('avgSafety').textContent =
                    count > 0 ? (totalSafety / count).toFixed(1) : '-';
                document.getElementById('avgValue').textContent =
                    count > 0 ? (totalValue / count).toFixed(1) : '-';

                // Load attractions
                const attractionsList = document.getElementById('attractions-list');
                attractionsList.innerHTML = '<h3 style="margin-bottom: 1rem;">Attractions</h3>';
                data.attractions.forEach(attr => {
                    const div = document.createElement('div');
                    div.className = 'attraction-item';
                    div.innerHTML = `
                        <div class="attraction-item-name">${attr.name}</div>
                        <div class="attraction-item-rating">
                            ⭐ ${attr.avg_fun_rating}/10 • ${attr.review_count} reviews
                        </div>
                    `;
                    div.addEventListener('click', () => showAttractionDetails(attr, location));
                    attractionsList.appendChild(div);
                });

                // Show location panel
                document.getElementById('noSelection').classList.add('hidden');
                document.getElementById('attractionDetails').classList.add('hidden');
                document.getElementById('locationDetails').classList.remove('hidden');

                // Center map on marker
                map.setView(marker.getLatLng(), 12);
            });
    }

    // Show attraction details
    function showAttractionDetails(attraction, location) {
        currentAttraction = attraction;

        fetch(`/api/attractions/${attraction.id}/reviews`)
            .then(response => response.json())
            .then(data => {
                const attr = data.attraction;
                document.getElementById('attractionName').textContent = attr.name;
                document.getElementById('attractionType').textContent = attr.type || 'Attraction';
                document.getElementById('reviewCount').textContent =
                    `${attr.review_count} review${attr.review_count !== 1 ? 's' : ''}`;

                // Update rating bars
                updateRatingBar('fun', attr.avg_fun_rating);
                updateRatingBar('safety', attr.avg_safety_rating);
                updateRatingBar('value', attr.avg_value_rating);

                // Load reviews
                const reviewsList = document.getElementById('reviewsList');
                if (data.reviews.length === 0) {
                    reviewsList.innerHTML = '<p style="text-align: center; color: #999;">No reviews yet</p>';
                } else {
                    reviewsList.innerHTML = data.reviews.map(review => `
                        <div class="review-item">
                            <div class="review-header">
                                <span class="review-author">${review.user_name}</span>
                                <span class="review-date">${review.created_at}</span>
                            </div>
                            <div class="review-ratings">
                                <span class="review-rating-badge">Fun: ${review.fun_rating}</span>
                                <span class="review-rating-badge">Safety: ${review.safety_rating}</span>
                                <span class="review-rating-badge">Value: ${review.value_rating}</span>
                            </div>
                            ${review.comment ? `<div class="review-comment">"${review.comment}"</div>` : '<div class="review-comment empty">No comment provided</div>'}
                        </div>
                    `).join('');
                }

                // Setup review button
                document.getElementById('reviewBtn').onclick = () => {
                    window.location.href = `/attractions/${attraction.id}/review/create`;
                };

                // Show attraction panel
                document.getElementById('locationDetails').classList.add('hidden');
                document.getElementById('noSelection').classList.add('hidden');
                document.getElementById('attractionDetails').classList.remove('hidden');
            });
    }

    // Update rating bar
    function updateRatingBar(type, value) {
        const percentage = (value / 10) * 100;
        document.getElementById(`${type}Bar`).style.width = `${percentage}%`;
        document.getElementById(`${type}Value`).textContent = `${value}/10`;
    }

    // Search locations
    function searchLocations() {
        const query = document.getElementById('searchInput').value.trim();
        if (query.length < 2) {
            document.getElementById('searchResults').classList.add('hidden');
            return;
        }

        fetch(`/api/locations/search?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(locations => {
                const resultsDiv = document.getElementById('searchResults');
                if (locations.length === 0) {
                    resultsDiv.innerHTML = '<div style="padding: 1rem; text-align: center; color: #999;">No results found</div>';
                } else {
                    resultsDiv.innerHTML = locations.map(loc => `
                        <div class="search-result-item" onclick="selectSearchResult(${loc.id})">
                            <strong>${loc.name}</strong><br>
                            <small>${loc.city}</small>
                        </div>
                    `).join('');
                }
                resultsDiv.classList.remove('hidden');
            });
    }

    // Select search result
    function selectSearchResult(locationId) {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchResults').classList.add('hidden');

        const locationMarker = markers.find(m => m.location.id === locationId);
        if (locationMarker) {
            locationMarker.marker.fireEvent('click');
        }
    }

    // Close panels
    function closeLocationPanel() {
        currentLocation = null;
        document.getElementById('locationDetails').classList.add('hidden');
        document.getElementById('noSelection').classList.remove('hidden');
    }

    function closeAttractionPanel() {
        currentAttraction = null;
        document.getElementById('attractionDetails').classList.add('hidden');
        document.getElementById('locationDetails').classList.remove('hidden');
    }

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Custom marker styling
    const style = document.createElement('style');
    style.textContent = `
        .custom-marker-container {
            background: none !important;
            border: none !important;
        }

        .custom-marker {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
            border: 3px solid white;
            cursor: pointer;
            transition: transform 0.2s;
            font-size: 20px;
        }

        .custom-marker:hover {
            transform: scale(1.15);
        }

        .marker-inner {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .leaflet-marker-icon {
            background: none;
            border: none;
        }
    `;
    document.head.appendChild(style);

    // Initialize on page load
    window.addEventListener('load', initMap);
</script>
@endsection

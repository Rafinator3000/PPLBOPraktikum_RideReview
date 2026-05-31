@extends('layouts.app')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, {{ auth('admin')->user()->name }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon locations">📍</div>
            <div class="stat-content">
                <div class="stat-value">{{ $stats['locations_count'] }}</div>
                <div class="stat-label">Total Locations</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon attractions">🎢</div>
            <div class="stat-content">
                <div class="stat-value">{{ $stats['attractions_count'] }}</div>
                <div class="stat-label">Total Attractions</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon reviews">⭐</div>
            <div class="stat-content">
                <div class="stat-value">{{ $stats['reviews_count'] }}</div>
                <div class="stat-label">Total Reviews</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon users">👥</div>
            <div class="stat-content">
                <div class="stat-value">{{ $stats['users_count'] }}</div>
                <div class="stat-label">Registered Users</div>
            </div>
        </div>

        <div class="stat-card alert">
            <div class="stat-icon warning">⚠️</div>
            <div class="stat-content">
                <div class="stat-value">{{ $stats['unverified_locations'] }}</div>
                <div class="stat-label">Unverified Locations</div>
            </div>
        </div>
    </div>

    <div class="admin-actions">
        <a href="{{ route('admin.locations.index') }}" class="action-card">
            <h3>📍 Manage Locations</h3>
            <p>Add, edit, or verify amusement park locations</p>
        </a>

        <a href="{{ route('admin.reviews.index') }}" class="action-card">
            <h3>⭐ Moderate Reviews</h3>
            <p>Review and remove inappropriate comments</p>
        </a>
    </div>
</div>

<style>
    :root {
        --primary: #FF6B6B;
        --secondary: #4ECDC4;
        --dark: #2C3E50;
        --light: #ECF0F1;
        --warning: #F39C12;
        --spacing: 1.5rem;
        --border-radius: 12px;
    }

    .admin-container {
        padding: var(--spacing);
        max-width: 1200px;
        margin: 0 auto;
    }

    .admin-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 2rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .admin-header h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .admin-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: var(--spacing);
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .stat-card.alert {
        background: linear-gradient(135deg, #fff5e6, #fff);
        border-left: 4px solid var(--warning);
    }

    .stat-icon {
        font-size: 3rem;
        min-width: 80px;
        text-align: center;
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark);
    }

    .stat-label {
        font-size: 0.95rem;
        color: #666;
        margin-top: 0.5rem;
    }

    .admin-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: var(--spacing);
    }

    .action-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 2rem;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border-left: 5px solid transparent;
        display: block;
    }

    .action-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }

    .action-card:nth-child(1) {
        border-left-color: var(--primary);
    }

    .action-card:nth-child(1):hover {
        background: linear-gradient(to right, rgba(255,107,107,0.05), transparent);
    }

    .action-card:nth-child(2) {
        border-left-color: var(--secondary);
    }

    .action-card:nth-child(2):hover {
        background: linear-gradient(to right, rgba(78,205,196,0.05), transparent);
    }

    .action-card.logout-card {
        border-left-color: var(--warning);
    }

    .action-card.logout-card:hover {
        background: linear-gradient(to right, rgba(243,156,18,0.05), transparent);
    }

    .action-card h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .action-card p {
        color: #666;
        margin: 0;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .admin-header {
            padding: 1.5rem;
        }

        .admin-header h1 {
            font-size: 2rem;
        }

        .stats-grid,
        .admin-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

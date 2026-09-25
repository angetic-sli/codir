@extends('admin_layout.app')
@section('admin')

<style>
    .modern-dashboard {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        position: relative;
        overflow: hidden;
    }
    
    .modern-dashboard::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .page-header-modern {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        z-index: 1;
    }
    
    .page-header-modern h5 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }
    
    .page-header-modern p {
        font-size: 1.1rem;
        color: #6c757d;
    }
    
    .kpi-card {
        background: white;
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
        transition: height 0.3s ease;
    }
    
    .kpi-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 0;
    }
    
    .kpi-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
    }
    
    .kpi-card:hover::before {
        height: 100%;
    }
    
    .kpi-card:hover::after {
        opacity: 0.05;
    }
    
    .kpi-card:hover .kpi-value,
    .kpi-card:hover .kpi-label {
        position: relative;
        z-index: 1;
    }
    
    .kpi-card:hover .kpi-icon {
        opacity: 0.2;
        transform: translateY(-50%) scale(1.2) rotate(10deg);
    }
    
    .kpi-card.purple {
        --gradient-start: #667eea;
        --gradient-end: #764ba2;
    }
    
    .kpi-card.green {
        --gradient-start: #11998e;
        --gradient-end: #38ef7d;
    }
    
    .kpi-card.red {
        --gradient-start: #ee0979;
        --gradient-end: #ff6a00;
    }
    
    .kpi-card.blue {
        --gradient-start: #2196F3;
        --gradient-end: #00BCD4;
    }
    
    .kpi-value {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .kpi-label {
        color: #6c757d;
        font-size: 0.95rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        position: relative;
        z-index: 1;
    }
    
    .kpi-icon {
        position: absolute;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 4rem;
        opacity: 0.08;
        transition: all 0.4s ease;
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .status-card {
        background: white;
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border-left: 5px solid var(--status-color);
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--status-color);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .status-card:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        border-left-width: 8px;
    }
    
    .status-card:hover::before {
        opacity: 0.05;
    }
    
    .status-card h4 {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--status-color);
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
    }
    
    .status-card:hover h4 {
        transform: scale(1.1);
    }
    
    .status-card p {
        position: relative;
        z-index: 1;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .status-card.todo {
        --status-color: #6c757d;
    }
    
    .status-card.progress {
        --status-color: #ffc107;
    }
    
    .status-card.done {
        --status-color: #28a745;
    }
    
    .status-card.late {
        --status-color: #dc3545;
    }
    
    .modern-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        margin-bottom: 2rem;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .modern-card:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }
    
    .modern-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem 2.5rem;
        border: none;
        position: relative;
        overflow: hidden;
    }
    
    .modern-card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: pulse 3s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }
    
    .modern-card-header h5 {
        color: white;
        font-weight: 700;
        font-size: 1.4rem;
        margin: 0;
        position: relative;
        z-index: 1;
        letter-spacing: 0.5px;
    }
    
    .modern-card-body {
        padding: 2.5rem;
    }
    
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .modern-table thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        padding: 1.2rem 1rem;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    
    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #e9ecef;
    }
    
    .modern-table tbody tr:hover {
        background: linear-gradient(90deg, #f8f9fa 0%, #ffffff 100%);
        transform: scale(1.01);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .modern-table tbody td {
        padding: 1.3rem 1rem;
        vertical-align: middle;
        border: none;
    }
    
    .modern-table tbody td strong {
        color: #2d3748;
        font-size: 1rem;
    }
    
    .badge-modern {
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
        margin-right: 0.3rem;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    
    .badge-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }
    
    .badge-purple {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .badge-green {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }
    
    .badge-orange {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .badge-info {
        background: linear-gradient(135deg, #2196F3 0%, #00BCD4 100%);
        color: white;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-card {
        animation: fadeInUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        opacity: 0;
    }
    
    .animate-card:nth-child(1) { animation-delay: 0.1s; }
    .animate-card:nth-child(2) { animation-delay: 0.2s; }
    .animate-card:nth-child(3) { animation-delay: 0.3s; }
    .animate-card:nth-child(4) { animation-delay: 0.4s; }
    
    .modern-card {
        animation: slideInLeft 0.8s ease forwards;
    }
    
    .badge-light {
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
    }
</style>

<div class="modern-dashboard">
    <div class="container-fluid">
        <!-- En-tête moderne -->
        <div class="page-header-modern animate-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5>Tableau de bord</h5>
                    <p class="text-muted mb-0">Bienvenue dans l’espace de pilotage IPCS · Comigest</p>
                </div>
                <div class="col-md-4 text-right">
                    <span class="badge badge-light">{{ date('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Cartes KPI principales -->
        <div class="row">
            <div class="col-xl-3 col-md-6 animate-card">
                <div class="kpi-card purple">
                    <div class="kpi-value">{{ $usersCount }}</div>
                    <div class="kpi-label">Utilisateurs</div>
                    <i class="fa fa-users kpi-icon"></i>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 animate-card">
                <div class="kpi-card green">
                    <div class="kpi-value">{{ $reunionsCount }}</div>
                    <div class="kpi-label">Réunions</div>
                    <i class="fa fa-calendar kpi-icon"></i>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 animate-card">
                <div class="kpi-card red">
                    <div class="kpi-value">{{ $activitesCount }}</div>
                    <div class="kpi-label">Activités</div>
                    <i class="fa fa-list-alt kpi-icon"></i>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 animate-card">
                <div class="kpi-card blue">
                    <div class="kpi-value">{{ $tachesCount }}</div>
                    <div class="kpi-label">Tâches</div>
                    <i class="fa fa-tasks kpi-icon"></i>
                </div>
            </div>
        </div>

        <!-- Statut des tâches -->
        <div class="row">
            <div class="col-md-3">
                <div class="status-card todo">
                    <h4>{{ $tachesAFaire }}</h4>
                    <p class="mb-0 text-muted">À faire</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="status-card progress">
                    <h4>{{ $tachesEnCours }}</h4>
                    <p class="mb-0 text-muted">En cours</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="status-card done">
                    <h4>{{ $tachesTerminees }}</h4>
                    <p class="mb-0 text-muted">Terminées</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="status-card late">
                    <h4>{{ $tachesEnRetard }}</h4>
                    <p class="mb-0 text-muted">En retard</p>
                </div>
            </div>
        </div>

        <!-- Dernières réunions -->
        <div class="modern-card">
            <div class="modern-card-header">
                <h5><i class="fa fa-calendar-check-o mr-2"></i>Dernières Réunions</h5>
            </div>
            <div class="modern-card-body">
                <div class="table-responsive">
                    <table class="modern-table table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Date</th>
                                <th>Lieu</th>
                                <th>Nb Activités</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lastReunions as $reunion)
                                <tr>
                                    <td><strong>{{ $reunion->titre }}</strong></td>
                                    <td>{{ $reunion->date }}</td>
                                    <td><i class="fa fa-map-marker mr-2"></i>{{ $reunion->lieu }}</td>
                                    <td>
                                        <span class="badge-modern badge-purple">
                                            {{ $reunion->activites->count() }} activités
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Dernières tâches -->
        <div class="modern-card">
            <div class="modern-card-header">
                <h5><i class="fa fa-check-square-o mr-2"></i>Dernières Tâches</h5>
            </div>
            <div class="modern-card-body">
                <div class="table-responsive">
                    <table class="modern-table table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Statut</th>
                                <th>Responsables</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lastTaches as $tache)
                                <tr>
                                    <td><strong>{{ $tache->titre }}</strong></td>
                                    <td>
                                        <span class="badge-modern 
                                            @if($tache->statut == 'Terminée') badge-green
                                            @elseif($tache->statut == 'En cours') badge-orange
                                            @else badge-purple
                                            @endif">
                                            {{ $tache->statut }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach($tache->users as $user)
                                            <span class="badge badge-info badge-modern">
                                                <i class="fa fa-user mr-1"></i>{{ $user->nom }}
                                            </span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
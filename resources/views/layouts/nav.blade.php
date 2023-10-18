
<!-- ======= Sidebar ======= -->

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Section réservée aux Superadmins -->
        @if(auth()->check() && auth()->user()->profile_id === 1)
            <li class="nav-item">
            
                <a class="nav-link" href="superadmin-dashboard.html">
                    <i class="bi bi-person"></i>
                    <span>Dashboard Superadmin</span>
                </a>
            </li>
        @endif

        <!-- Section réservée aux Admins -->
        @if(auth()->check() && auth()->user()->profile_id === 2)
            <li class="nav-item">
                <!-- Lien ou sous-menu pour les Admins -->
                <a class="nav-link" href="admin-dashboard.html">
                    <i class="bi bi-person"></i>
                    <span>Dashboard Admin</span>
                </a>
            </li>
        @endif

        <!-- Section réservée aux Clients -->
        @if(auth()->check() && auth()->user()->profile_id === 3)
            <li class="nav-item">
                <!-- Lien ou sous-menu pour les Clients -->
                <a class="nav-link" href="client-dashboard.html">
                    <i class="bi bi-person"></i>
                    <span>Dashboard Client</span>
                </a>
            </li>
        @endif

        <!-- Section réservée aux Employés -->
        @if(auth()->check() && auth()->user()->profile_id == 4)
       
            @if(auth()->user()->employee_type_id == 4)
                <li class="nav-item">
                    <!-- Lien ou sous-menu pour les Directeurs -->

                    <a class="nav-link" href="directeur-dashboard.html">
                        <i class="bi bi-person"></i>
                        <span>Dashboard Directeur</span>
                    </a>
                </li>
            @endif

            <!-- Section pour les Agents à la Caisse -->
            @if(auth()->user()->employee_type_id == 1)
                <li class="nav-item">
                    <!-- Lien ou sous-menu pour les Agents à la Caisse -->

                    <a class="nav-link" href="agent-caisse-dashboard.html">
                        <i class="bi bi-person"></i>
                        <span>Dashboard Agent à la Caisse</span>
                    </a>
                </li>
            @endif

            <!-- Section pour les Agents de Terrain -->
            @if(auth()->user()->employee_type_id == 3)
                <li class="nav-item">
                    <!-- Lien ou sous-menu pour les Agents de Terrain -->

                    <a class="nav-link" href="agent-terrain-dashboard.html">
                        <i class="bi bi-person"></i>
                        <span>Dashboard Agent de Terrain</span>
                    </a>
                </li>
            @endif

            <!-- Section pour les Comptables -->
            @if(auth()->user()->employee_type_id == 2)
                <li class="nav-item">
                    <!-- Lien ou sous-menu pour les Comptables -->

                    <a class="nav-link" href="comptable-dashboard.html">
                        <i class="bi bi-person"></i>
                        <span>Dashboard Comptable</span>
                    </a>
                </li>

            @endif

            <!-- Section pour les Chargés de la Clientèle -->
            @if(auth()->user()->employee_type_id == 5)
                <li class="nav-item">
                    <!-- Lien ou sous-menu pour les Chargés de la Clientèle -->

                    <a class="nav-link" href="charge-clientele-dashboard.html">
                        <i class="bi bi-person"></i>
                        <span>Dashboard Chargé de la Clientèle</span>
                    </a>
                </li>
            @endif

            <!-- Section pour les Chargés des Ressources Humaines -->
            @if(auth()->user()->employee_type_id == 6)
                <li class="nav-item">
                    <!-- Lien ou sous-menu pour les Chargés des Ressources Humaines -->

                    <a class="nav-link" href="charge-ressources-humaines-dashboard.html">
                        <i class="bi bi-person"></i>
                        <span>Dashboard Chargé des Ressources Humaines</span>
                    </a>
                </li>
            @endif
        @endif <!-- Fin de la section réservée aux Employés -->

    </ul>
</aside><!-- End Sidebar-->

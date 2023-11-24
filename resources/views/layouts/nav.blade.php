<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Section réservée aux Superadmins -->
        @if(auth()->check() && auth()->user()->profile->designation === 'superadmin')
            <li class="nav-item">

                <a class="nav-link" href="superadmin-dashboard.html">
                    <i class="bi bi-person"></i>
                    <span>Dashboard Superadmin</span>
                </a>
            </li>
        @endif

        <!-- Section réservée aux Admins -->
        @if(auth()->check() && auth()->user()->profile->designation === 'admin')
            <li class="nav-item">
                <!-- Lien ou sous-menu pour les Admins -->
                <a class="nav-link" href="admin-dashboard.html">
                    <i class="bi bi-person"></i>
                    <span>Dashboard Admin</span>
                </a>
            </li>
        @endif

        <!-- Section réservée aux Clients -->
        @if(auth()->check() && auth()->user()->profile->designation === 'client')
            <li class="nav-item">
                <a class="nav-link " href="{{ url('/client-dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Tableau de bord</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/client-operations')}}">
                    <i class="bi bi-journal-text"></i>
                    <span>Gérer mes operations</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/client-loan-request')}}">
                    <i class="bi bi-journal-text"></i>
                    <span>Gérer mes prêts</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-envelope"></i>
                    <span>Demande d'assistance</span>
                </a>
            </li><!-- End Contact Page Nav -->
        @endif


        <!-- Section réservée aux Employés -->
        @if(auth()->check() && auth()->user()->profile->designation === 'employe')
            <!-- Section pour le directeur -->
            @if(auth()->user()->employee_type_id == 4)
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('/employe-dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->


                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#clientele-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Clientèle</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="clientele-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/customer-list')}}">
                        <i class="bi bi-circle"></i><span>Liste des clients </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/loan-in-progress')}}">
                        <i class="bi bi-circle"></i><span>Demandes de pret en attente</span>
                        </a>
                    </li>
                    


                    </ul>
                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#employe-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Employés</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="employe-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/employee-list')}}">
                        <i class="bi bi-circle"></i><span>Liste des employés</span>
                        </a>
                    </li>

                    </ul>
                </li><!-- End Forms Nav -->

            @endif

            <!-- Section pour les Agents à la Caisse -->
            @if(auth()->user()->employee_type_id == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/employe-dashboard')}}">
                        <i class="bi bi-person"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#operation-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Gestion des Opérations</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="operation-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ url('/operation-list')}}">
                            <i class="bi bi-circle"></i><span>Liste des operations </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/save-operation')}}">
                            <i class="bi bi-circle"></i><span>Enregistrer une operation</span>
                            </a>
                        </li>
                       
                    </ul>
                </li><!-- End Components Nav -->
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
                    <a class="nav-link" href="{{ url('/employe-dashboard')}}">
                        <i class="bi bi-person"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#compte-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Gestion des Comptes client</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="compte-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                       
                        <li>
                            <a href="{{ url('/current-accounts')}}">
                            <i class="bi bi-circle"></i><span>Comptes Courants</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/savings-accounts')}}">
                            <i class="bi bi-circle"></i><span>Compte Epargnes</span>
                            </a>
                        </li>
                       
                    </ul>

                    
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#pret-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Gestion des Prets</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="pret-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ url('/create-loan')}}">
                            <i class="bi bi-circle"></i><span>Creer un pret</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/loan-operation')}}">
                            <i class="bi bi-circle"></i><span>Demandes de pret</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/operation-list')}}">
                            <i class="bi bi-circle"></i><span>Demandes de pret en attente</span>
                            </a>
                        </li>
                    </ul>

                    
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

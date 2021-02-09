<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <inertia-link href="/home" class="brand-link">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </inertia-link>

        <div class="sidebar"> 
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <inertia-link href="/home" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </inertia-link>
                    </li> 
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-angle-down"></i>
                        <p>
                            Dropdown
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Link 1</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Link 2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Link 3</p>
                                </a>
                            </li>
                        </ul>
                    </li>           
                </ul>

                
            </nav>
        </div>
    </aside>
</template>